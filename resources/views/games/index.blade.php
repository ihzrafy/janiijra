@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
        <div class="text-6xl mb-4 animate-bounce-soft">🎮</div>
        <h2 class="text-4xl font-bold text-text mb-4">
            Interactive Games
        </h2>
        <p class="text-text/70">Choose a game to play together</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('games.puzzle') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">🧩</div>
                <h3 class="text-xl font-bold text-text mb-2">Sliding Puzzle</h3>
                <p class="text-sm text-text/70">Classic 3x3 puzzle game</p>
            </div>
        </a>

        <a href="{{ route('games.tebakkata') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">✏️</div>
                <h3 class="text-xl font-bold text-text mb-2">Word Game</h3>
                <p class="text-sm text-text/70">Guess words about us</p>
            </div>
        </a>

        <a href="{{ route('games.memorycard') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">🃏</div>
                <h3 class="text-xl font-bold text-text mb-2">Memory Match</h3>
                <p class="text-sm text-text/70">Match the pairs</p>
            </div>
        </a>

        <a href="{{ route('games.blockblast') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">🧱</div>
                <h3 class="text-xl font-bold text-text mb-2">Block Blast</h3>
                <p class="text-sm text-text/70">Clear blocks puzzle</p>
            </div>
        </a>

        <a href="{{ route('games.tictactoe') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">⭕</div>
                <h3 class="text-xl font-bold text-text mb-2">Tic Tac Toe</h3>
                <p class="text-sm text-text/70">Classic X and O game</p>
            </div>
        </a>

        <a href="{{ route('games.snake') }}" class="group">
            <div class="card-cute p-8 text-center hover:scale-105 transition-transform">
                <div class="text-6xl mb-4 group-hover:animate-bounce-soft">🐍</div>
                <h3 class="text-xl font-bold text-text mb-2">Snake Game</h3>
                <p class="text-sm text-text/70">Eat and grow longer</p>
            </div>
        </a>
    </div>

    <div class="text-center">
        <a href="{{ route('home') }}" class="text-text hover:text-yellow-warm transition-colors text-sm font-medium">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
