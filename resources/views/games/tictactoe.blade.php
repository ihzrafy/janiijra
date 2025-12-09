@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">⭕</div>
        <h2 class="text-4xl font-bold text-text mb-4">Tic Tac Toe</h2>
        <p class="text-text/70">Take turns to get three in a row!</p>
    </div>

    <div class="card-cute p-8">
        <div class="text-center mb-6">
            <div class="text-xl font-bold text-text mb-4">Current Player: <span id="currentPlayer">X</span></div>
            <div class="text-lg text-text/70 mb-4" id="status">Click a cell to start</div>
            <button id="resetBtn" class="btn-cute">Reset Game</button>
        </div>

        <div class="flex justify-center">
            <div class="grid grid-cols-3 gap-2 w-80 h-80" id="board">
                @for($i = 0; $i < 9; $i++)
                <div class="bg-yellow-light border-4 border-yellow-soft rounded-lg flex items-center justify-center text-6xl font-bold cursor-pointer hover:bg-yellow-soft transition-colors" data-cell></div>
                @endfor
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('games.index') }}" class="btn-cute inline-block">← Back to Games</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const cells = document.querySelectorAll('[data-cell]');
    const currentPlayerDisplay = document.getElementById('currentPlayer');
    const statusDisplay = document.getElementById('status');
    const resetBtn = document.getElementById('resetBtn');

    let currentPlayer = 'X';
    let gameActive = true;
    let gameState = ['', '', '', '', '', '', '', '', ''];

    const winningConditions = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6] // Diagonals
    ];

    function handleCellClick(event) {
        const cell = event.target;
        const cellIndex = Array.from(cells).indexOf(cell);

        if (gameState[cellIndex] !== '' || !gameActive) return;

        gameState[cellIndex] = currentPlayer;
        cell.textContent = currentPlayer;
        cell.classList.add(currentPlayer === 'X' ? 'text-red-500' : 'text-blue-500');

        if (checkWin()) {
            statusDisplay.textContent = `Player ${currentPlayer} wins! 🎉`;
            gameActive = false;
            return;
        }

        if (checkDraw()) {
            statusDisplay.textContent = "It's a draw! 🤝";
            gameActive = false;
            return;
        }

        currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
        currentPlayerDisplay.textContent = currentPlayer;
        statusDisplay.textContent = `Player ${currentPlayer}'s turn`;
    }

    function checkWin() {
        return winningConditions.some(condition => {
            return condition.every(index => gameState[index] === currentPlayer);
        });
    }

    function checkDraw() {
        return gameState.every(cell => cell !== '');
    }

    function resetGame() {
        gameState = ['', '', '', '', '', '', '', '', ''];
        gameActive = true;
        currentPlayer = 'X';
        currentPlayerDisplay.textContent = currentPlayer;
        statusDisplay.textContent = "Click a cell to start";
        cells.forEach(cell => {
            cell.textContent = '';
            cell.classList.remove('text-red-500', 'text-blue-500');
        });
    }

    cells.forEach(cell => cell.addEventListener('click', handleCellClick));
    resetBtn.addEventListener('click', resetGame);
</script>
@endsection