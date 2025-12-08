@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">🎴</div>
        <h2 class="text-4xl font-bold text-text mb-2">
            Memory Card Game
        </h2>
    </div>

    <div class="card-cute p-8">
        <!-- Game Info -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-text">
                <span class="font-bold">Pasangan:</span> <span id="matches" class="text-yellow-warm text-2xl">0</span> / <span id="totalPairs">8</span>
            </div>
            <div class="text-text">
                <span class="font-bold">Percobaan:</span> <span id="attempts" class="text-yellow-warm text-2xl">0</span>
            </div>
            <button onclick="resetGame()" class="btn-cute">
                🔄 Reset
            </button>
        </div>

        <!-- Memory Board -->
        <div id="gameBoard" class="grid grid-cols-4 gap-3 mb-6">
            <!-- Cards akan di-generate oleh JavaScript -->
        </div>

        <!-- Win Message -->
        <div id="winMessage" class="hidden text-center">
            <div class="text-6xl mb-4 animate-bounce">🎉</div>
            <h3 class="text-3xl font-bold text-text mb-2">Hebat! Kamu Menang! 💛</h3>
            <p class="text-text/70 mb-4">Total Percobaan: <span id="finalAttempts"></span></p>
            <button onclick="resetGame()" class="btn-cute">
                Main Lagi
            </button>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('games.index') }}" class="text-text hover:text-yellow-warm transition font-medium">
                ← Kembali ke Games
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const images = ['/images/photo27.jpg', '/images/photo9.jpg', '/images/photo17.jpg', '/images/photo40.jpg', '/images/photo55.jpg', '/images/photo69.jpg', '/images/photo74.jpg', '/images/photo87.jpg'];
    let cards = [];
    let flippedCards = [];
    let matchedPairs = 0;
    let attempts = 0;
    let canFlip = true;

    function initGame() {
        // Buat pairs dari images
        cards = [...images, ...images];
        shuffleArray(cards);
        
        matchedPairs = 0;
        attempts = 0;
        flippedCards = [];
        canFlip = true;
        
        updateStats();
        renderBoard();
        document.getElementById('winMessage').classList.add('hidden');
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function renderBoard() {
        const board = document.getElementById('gameBoard');
        board.innerHTML = '';

        cards.forEach((emoji, index) => {
            const card = document.createElement('div');
            card.className = 'card aspect-square bg-gradient-to-br from-yellow-soft to-yellow-warm rounded-2xl shadow-lg cursor-pointer transform transition-all duration-500 hover:scale-105';
            card.dataset.index = index;
            card.dataset.emoji = emoji;
            card.innerHTML = `
                <div class="card-inner relative w-full h-full" style="transform-style: preserve-3d; transition: transform 0.6s;">
                    <div class="card-front absolute w-full h-full flex items-center justify-center text-5xl bg-gradient-to-br from-yellow-soft to-yellow-warm rounded-2xl backface-hidden">
                        ❓
                    </div>
                    <div class="card-back absolute w-full h-full flex items-center justify-center bg-white rounded-xl backface-hidden" style="transform: rotateY(180deg);">
                        <img src="${emoji}" alt="card" class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
            `;
            
            card.addEventListener('click', () => flipCard(index));
            board.appendChild(card);
        });
    }

    function flipCard(index) {
        if (!canFlip) return;
        
        const card = document.querySelector(`[data-index="${index}"]`);
        if (card.classList.contains('flipped') || card.classList.contains('matched')) return;
        
        if (flippedCards.length >= 2) return;

        card.classList.add('flipped');
        card.querySelector('.card-inner').style.transform = 'rotateY(180deg)';
        flippedCards.push({ index, emoji: cards[index], element: card });

        if (flippedCards.length === 2) {
            attempts++;
            updateStats();
            checkMatch();
        }
    }

    function checkMatch() {
        canFlip = false;
        const [card1, card2] = flippedCards;

        if (card1.emoji === card2.emoji) {
            // Match!
            setTimeout(() => {
                card1.element.classList.add('matched');
                card2.element.classList.add('matched');
                card1.element.style.opacity = '0.6';
                card2.element.style.opacity = '0.6';
                
                matchedPairs++;
                updateStats();
                flippedCards = [];
                canFlip = true;

                if (matchedPairs === images.length) {
                    setTimeout(() => showWin(), 500);
                }
            }, 600);
        } else {
            // No match
            setTimeout(() => {
                card1.element.querySelector('.card-inner').style.transform = 'rotateY(0deg)';
                card2.element.querySelector('.card-inner').style.transform = 'rotateY(0deg)';
                card1.element.classList.remove('flipped');
                card2.element.classList.remove('flipped');
                flippedCards = [];
                canFlip = true;
            }, 1000);
        }
    }

    function updateStats() {
        document.getElementById('matches').textContent = matchedPairs;
        document.getElementById('attempts').textContent = attempts;
    }

    function showWin() {
        document.getElementById('finalAttempts').textContent = attempts;
        document.getElementById('winMessage').classList.remove('hidden');
    }

    function resetGame() {
        initGame();
    }

    // Initialize on page load
    initGame();
</script>

<style>
    .backface-hidden {
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
</style>
@endsection
