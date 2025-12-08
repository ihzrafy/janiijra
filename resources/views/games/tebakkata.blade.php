@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">✏️</div>
        <h2 class="text-4xl font-bold text-text mb-2">
            Tebak Kata Tentang Kita
        </h2>
    </div>

    <div class="card-cute p-8">
        <!-- Game Info -->
        <div class="text-center mb-6">
            <div class="text-text mb-4">
                <span class="font-bold">Skor:</span> <span id="score" class="text-yellow-warm text-2xl">0</span> / <span id="total">0</span>
            </div>
            <div id="hint" class="text-lg text-text/70 italic mb-4"></div>
        </div>

        <!-- Word Display -->
        <div id="wordDisplay" class="flex justify-center gap-2 mb-8 flex-wrap">
            <!-- Letters akan di-generate oleh JavaScript -->
        </div>

        <!-- Keyboard -->
        <div id="keyboard" class="grid grid-cols-7 md:grid-cols-9 gap-2 mb-6 max-w-2xl mx-auto">
            <!-- Keyboard akan di-generate oleh JavaScript -->
        </div>

        <!-- Result Message -->
        <div id="resultMessage" class="text-center mb-4 hidden">
            <p class="text-2xl font-bold"></p>
        </div>

        <!-- Next/Reset Button -->
        <div class="text-center">
            <button id="nextBtn" onclick="nextWord()" class="btn-cute hidden">
                Kata Berikutnya →
            </button>
            <button onclick="resetGame()" class="btn-cute ml-2">
                🔄 Mulai Lagi
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
    const words = [
        { word: 'BUBUB', hint: 'Kata yang sering Ijra panggil untuk Jani 💛' },
        { word: 'CINTA', hint: 'Perasaan yang Ijra punya untuk Jani ❤️' },
        { word: 'GEMASH', hint: 'Jani itu... 😍' },
        { word: 'CANTIK', hint: 'Jani itu selalu ... ✨' },
        { word: 'BAHAGIA', hint: 'Yang Ijra rasakan saat bersamamu 😊' },
        { word: 'SELAMANYA', hint: 'Ijra ingin bersamamu... 💕' },
        { word: 'MANIS', hint: 'Senyum Jani itu... 🍭' },
        { word: 'SPESIAL', hint: 'Jani itu orang yang sangat... 🌟' }
    ];

    let currentWordIndex = 0;
    let currentWord = '';
    let guessedLetters = [];
    let wrongGuesses = 0;
    let score = 0;
    const maxWrong = 6;

    const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

    function initGame() {
        currentWordIndex = 0;
        score = 0;
        updateScore();
        loadWord();
    }

    function loadWord() {
        if (currentWordIndex >= words.length) {
            showFinalScore();
            return;
        }

        currentWord = words[currentWordIndex].word;
        document.getElementById('hint').textContent = words[currentWordIndex].hint;
        guessedLetters = [];
        wrongGuesses = 0;
        
        renderWord();
        renderKeyboard();
        document.getElementById('resultMessage').classList.add('hidden');
        document.getElementById('nextBtn').classList.add('hidden');
    }

    function renderWord() {
        const wordDisplay = document.getElementById('wordDisplay');
        wordDisplay.innerHTML = '';

        for (let letter of currentWord) {
            const letterBox = document.createElement('div');
            letterBox.className = 'w-12 h-12 md:w-16 md:h-16 bg-yellow-pastel rounded-2xl flex items-center justify-center text-2xl md:text-3xl font-bold text-text shadow-md';
            letterBox.textContent = guessedLetters.includes(letter) ? letter : '_';
            wordDisplay.appendChild(letterBox);
        }
    }

    function renderKeyboard() {
        const keyboard = document.getElementById('keyboard');
        keyboard.innerHTML = '';

        alphabet.forEach(letter => {
            const btn = document.createElement('button');
            btn.className = 'aspect-square bg-yellow-soft hover:bg-yellow-warm text-text font-bold rounded-xl shadow transition-all';
            btn.textContent = letter;
            
            if (guessedLetters.includes(letter)) {
                btn.disabled = true;
                btn.className = 'aspect-square bg-gray-300 text-gray-500 font-bold rounded-lg cursor-not-allowed';
            } else {
                btn.onclick = () => guessLetter(letter);
            }
            
            keyboard.appendChild(btn);
        });
    }

    function guessLetter(letter) {
        if (guessedLetters.includes(letter)) return;

        guessedLetters.push(letter);

        if (currentWord.includes(letter)) {
            renderWord();
            checkWin();
        } else {
            wrongGuesses++;
            if (wrongGuesses >= maxWrong) {
                showLose();
            }
        }

        renderKeyboard();
    }

    function checkWin() {
        const allGuessed = currentWord.split('').every(letter => guessedLetters.includes(letter));
        
        if (allGuessed) {
            score++;
            updateScore();
            showWin();
        }
    }

    function showWin() {
        const msgDiv = document.getElementById('resultMessage');
        msgDiv.innerHTML = '<p class="text-2xl font-bold text-green-600">🎉 Benar! Kamu Hebat! 💛</p>';
        msgDiv.classList.remove('hidden');
        document.getElementById('nextBtn').classList.remove('hidden');
    }

    function showLose() {
        const msgDiv = document.getElementById('resultMessage');
        msgDiv.innerHTML = `<p class="text-2xl font-bold text-red-600">😅 Jawabannya: ${currentWord}</p>`;
        msgDiv.classList.remove('hidden');
        document.getElementById('nextBtn').classList.remove('hidden');
    }

    function showFinalScore() {
        const msgDiv = document.getElementById('resultMessage');
        msgDiv.innerHTML = `
            <div class="text-6xl mb-4">🎊</div>
            <p class="text-3xl font-bold text-text mb-2">Game Selesai!</p>
            <p class="text-xl text-text">Skor Akhir: ${score} / ${words.length}</p>
            <p class="text-lg text-text/70 mt-2">Kamu Luar Biasa! 💛</p>
        `;
        msgDiv.classList.remove('hidden');
        document.getElementById('wordDisplay').innerHTML = '';
        document.getElementById('keyboard').innerHTML = '';
        document.getElementById('hint').textContent = '';
    }

    function nextWord() {
        currentWordIndex++;
        loadWord();
    }

    function updateScore() {
        document.getElementById('score').textContent = score;
        document.getElementById('total').textContent = words.length;
    }

    function resetGame() {
        initGame();
    }

    // Initialize on page load
    initGame();
</script>
@endsection
