@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">🐍</div>
        <h2 class="text-4xl font-bold text-text mb-4">Snake Game</h2>
        <p class="text-text/70">Eat the food and grow longer!</p>
    </div>

    <div class="card-cute p-8">
        <div class="text-center mb-6">
            <div class="text-2xl font-bold text-text mb-2">Score: <span id="score">0</span></div>
            <button id="startBtn" class="btn-cute">Start Game</button>
        </div>

        <div class="flex justify-center">
            <canvas id="gameCanvas" width="400" height="400" class="border-4 border-yellow-soft rounded-lg"></canvas>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-text/70">Use arrow keys to control the snake</p>
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

    const gridSize = 20;
    const tileCount = canvas.width / gridSize;

    let snake = [{x: 10, y: 10}];
    let food = {};
    let dx = 0;
    let dy = 0;
    let score = 0;
    let gameRunning = false;

    function randomTile() {
        return Math.floor(Math.random() * tileCount);
    }

    function generateFood() {
        food = {
            x: randomTile(),
            y: randomTile()
        };
        // Make sure food doesn't spawn on snake
        for (let segment of snake) {
            if (segment.x === food.x && segment.y === food.y) {
                generateFood();
                return;
            }
        }
    }

    function drawGame() {
        // Clear canvas
        ctx.fillStyle = '#FFF8C7';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Draw snake
        ctx.fillStyle = '#4ECDC4';
        for (let segment of snake) {
            ctx.fillRect(segment.x * gridSize, segment.y * gridSize, gridSize - 2, gridSize - 2);
        }

        // Draw food
        ctx.fillStyle = '#FF6B6B';
        ctx.fillRect(food.x * gridSize, food.y * gridSize, gridSize - 2, gridSize - 2);
    }

    function moveSnake() {
        const head = {x: snake[0].x + dx, y: snake[0].y + dy};

        // Check wall collision
        if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount) {
            gameOver();
            return;
        }

        // Check self collision
        for (let segment of snake) {
            if (head.x === segment.x && head.y === segment.y) {
                gameOver();
                return;
            }
        }

        snake.unshift(head);

        // Check food collision
        if (head.x === food.x && head.y === food.y) {
            score += 10;
            scoreElement.textContent = score;
            generateFood();
        } else {
            snake.pop();
        }
    }

    function gameOver() {
        gameRunning = false;
        alert(`Game Over! Score: ${score}`);
    }

    function gameLoop() {
        if (!gameRunning) return;
        moveSnake();
        drawGame();
    }

    function changeDirection(event) {
        if (!gameRunning) return;

        const LEFT_KEY = 37;
        const RIGHT_KEY = 39;
        const UP_KEY = 38;
        const DOWN_KEY = 40;

        const keyPressed = event.keyCode;
        const goingUp = dy === -1;
        const goingDown = dy === 1;
        const goingRight = dx === 1;
        const goingLeft = dx === -1;

        if (keyPressed === LEFT_KEY && !goingRight) {
            dx = -1;
            dy = 0;
        }
        if (keyPressed === UP_KEY && !goingDown) {
            dx = 0;
            dy = -1;
        }
        if (keyPressed === RIGHT_KEY && !goingLeft) {
            dx = 1;
            dy = 0;
        }
        if (keyPressed === DOWN_KEY && !goingUp) {
            dx = 0;
            dy = 1;
        }
    }

    document.addEventListener('keydown', changeDirection);

    let gameInterval;

    function startGame() {
        snake = [{x: 10, y: 10}];
        dx = 0;
        dy = 0;
        score = 0;
        scoreElement.textContent = score;
        gameRunning = true;
        generateFood();
        drawGame();
        if (gameInterval) clearInterval(gameInterval);
        gameInterval = setInterval(gameLoop, 150);
    }

    startBtn.addEventListener('click', startGame);

    // Initial draw
    drawGame();
</script>
@endsection