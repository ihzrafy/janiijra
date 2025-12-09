@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">🧱</div>
        <h2 class="text-4xl font-bold text-text mb-4">Block Blast</h2>
        <p class="text-text/70">Clear blocks by matching colors!</p>
    </div>

    <div class="card-cute p-8">
        <div class="text-center mb-6">
            <div class="text-2xl font-bold text-text mb-2">Score: <span id="score">0</span></div>
            <button id="startBtn" class="btn-cute">Start Game</button>
        </div>

        <div class="flex justify-center">
            <canvas id="gameCanvas" width="400" height="600" class="border-4 border-yellow-soft rounded-lg"></canvas>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-text/70">Use mouse to select blocks of the same color</p>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('games.index') }}" class="btn-cute inline-block">← Back to Games</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const canvas = document.getElementById('gameCanvas');
    const ctx = canvas.getContext('2d');
    const startBtn = document.getElementById('startBtn');
    const scoreElement = document.getElementById('score');

    let grid = [];
    let score = 0;
    let gameRunning = false;
    const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD'];

    function initGrid() {
        grid = [];
        for (let i = 0; i < 10; i++) {
            grid[i] = [];
            for (let j = 0; j < 15; j++) {
                grid[i][j] = Math.floor(Math.random() * colors.length);
            }
        }
    }

    function drawGrid() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let i = 0; i < 10; i++) {
            for (let j = 0; j < 15; j++) {
                if (grid[i][j] !== -1) {
                    ctx.fillStyle = colors[grid[i][j]];
                    ctx.fillRect(i * 40, j * 40, 38, 38);
                    ctx.strokeStyle = '#fff';
                    ctx.lineWidth = 1;
                    ctx.strokeRect(i * 40, j * 40, 38, 38);
                }
            }
        }
    }

    function getMousePos(event) {
        const rect = canvas.getBoundingClientRect();
        return {
            x: Math.floor((event.clientX - rect.left) / 40),
            y: Math.floor((event.clientY - rect.top) / 40)
        };
    }

    function findConnectedBlocks(x, y, color, visited) {
        if (x < 0 || x >= 10 || y < 0 || y >= 15 || visited[y][x] || grid[x][y] !== color) {
            return [];
        }
        visited[y][x] = true;
        let blocks = [[x, y]];
        blocks = blocks.concat(findConnectedBlocks(x + 1, y, color, visited));
        blocks = blocks.concat(findConnectedBlocks(x - 1, y, color, visited));
        blocks = blocks.concat(findConnectedBlocks(x, y + 1, color, visited));
        blocks = blocks.concat(findConnectedBlocks(x, y - 1, color, visited));
        return blocks;
    }

    function removeBlocks(blocks) {
        blocks.forEach(([x, y]) => {
            grid[x][y] = -1;
        });
        score += blocks.length * 10;
        scoreElement.textContent = score;
    }

    function applyGravity() {
        for (let x = 0; x < 10; x++) {
            let emptySpaces = 0;
            for (let y = 14; y >= 0; y--) {
                if (grid[x][y] === -1) {
                    emptySpaces++;
                } else if (emptySpaces > 0) {
                    grid[x][y + emptySpaces] = grid[x][y];
                    grid[x][y] = -1;
                }
            }
        }
    }

    canvas.addEventListener('click', (event) => {
        if (!gameRunning) return;
        const pos = getMousePos(event);
        if (pos.x >= 0 && pos.x < 10 && pos.y >= 0 && pos.y < 15 && grid[pos.x][pos.y] !== -1) {
            const visited = Array(15).fill().map(() => Array(10).fill(false));
            const blocks = findConnectedBlocks(pos.x, pos.y, grid[pos.x][pos.y], visited);
            if (blocks.length >= 2) {
                removeBlocks(blocks);
                applyGravity();
                drawGrid();
            }
        }
    });

    startBtn.addEventListener('click', () => {
        initGrid();
        score = 0;
        scoreElement.textContent = score;
        gameRunning = true;
        drawGrid();
    });

    // Initial draw
    initGrid();
    drawGrid();
</script>
@endsection