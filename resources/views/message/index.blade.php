@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto relative">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">💌</div>
        <h2 class="text-4xl font-bold text-text mb-2">
            A Message For Jani
        </h2>
    </div>

    <div class="card-cute p-8 md:p-12 relative overflow-hidden">
        <!-- Animated Message -->
        <div id="messageContainer" class="space-y-6">
            <div class="message-line opacity-0 text-xl md:text-2xl text-text text-center"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 0.5s;">
            Hey my baby honey sweety... 💛
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 1.5s;">
            I just want to say...
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 2.5s;">
            You are <strong>so sweet</strong>. 🍭
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 3.5s;">
            You make my days <strong>brighter</strong>. ☀️
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 4.5s;">
            Your smile is like flowers blooming in spring. 🌸
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 5.5s;">
            Your laughter is my favorite song. 🎵
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 6.5s;">
            And your presence? It is the <strong>best gift</strong> I've ever received. 🎁
        </div>

        <!-- Tambahan panjang -->
        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 7.5s;">
            Every moment with you feels like magic. ✨
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 8.5s;">
            You calm my storms and color my skies. 🎨
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 9.5s;">
            Sometimes I wonder... how did I get so lucky to have you? 🍀
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 10.5s;">
            You're not just special. You're my peace, my warmth, my home. 🏡
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 11.5s;">
            I don’t need perfect days… having you is already perfect enough. 💛
        </div>

        <div class="message-line opacity-0 text-lg md:text-xl text-text/80 leading-relaxed"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 12.5s;">
            And no matter where life takes us, my heart will always walk beside yours. 🌙
        </div>

        <div class="message-line opacity-0 text-2xl md:text-3xl text-text text-center font-bold mt-10"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 13.5s;">
            You mean the world to me.<br> Always, and forever. 💛
        </div>

        <!-- BAGIAN PENUTUP (dipindahkan ke paling akhir seperti permintaanmu) -->
        <div class="message-line opacity-0 text-2xl md:text-3xl text-text text-center font-bold mt-10"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 14.5s;">
            I love you,<br> more than you know. 💛
        </div>

        <div class="message-line opacity-0 text-center mt-8"
            style="animation: fadeIn 1s ease-in forwards; animation-delay: 15.5s;">
            <div class="text-6xl mb-4">🌼 💛 🌸</div>
            <p class="text-lg text-text/80 italic">Thank you for being in my life.</p>
        </div>
        </div>
    </div>

    <!-- Polaroid Photos Gallery -->
    <div class="mt-12">
        <h3 class="text-2xl font-bold text-text text-center mb-8">Our Beautiful Memories 💕</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center">
            @php
                $photos = ['/images/photo10.jpg', '/images/photo11.jpg', '/images/photo14.jpg', '/images/photo15.jpg', '/images/photo19.jpg', '/images/photo52.jpg', '/images/photo63.jpg', '/images/photo87.jpg'];
            @endphp
            @foreach($photos as $photo)
            <div class="polaroid transform rotate-{{ rand(-3, 3) }} hover:rotate-0 transition-transform duration-300">
                <img src="{{ $photo }}" alt="Memory" class="w-full h-48 object-cover rounded">
                <p class="text-center text-sm text-text/60 mt-2">💛</p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('home') }}" class="btn-cute inline-block">
            ← Back to Home
        </a>
    </div>
</div>

<!-- Falling Flowers Animation -->
<div class="falling-flowers-container fixed inset-0 pointer-events-none overflow-hidden" style="z-index: 1;">
    @for($i = 1; $i <= 15; $i++)
    <div class="falling-flower" style="left: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.3 }}s; animation-duration: {{ rand(6, 10) }}s;">
        @if($i % 3 == 0) 🌼
        @elseif($i % 3 == 1) 🌸
        @else 🌻
        @endif
    </div>
    @endfor
</div>
@endsection

@section('scripts')
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .falling-flower {
        position: absolute;
        top: -100px;
        font-size: 2rem;
        opacity: 0;
        animation: fall linear infinite;
    }
    
    @keyframes fall {
        0% {
            top: -100px;
            opacity: 0;
            transform: rotate(0deg);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            top: 100vh;
            opacity: 0;
            transform: rotate(360deg);
        }
    }

    .polaroid {
        background: white;
        padding: 10px 10px 30px 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        border-radius: 5px;
        width: 200px;
        margin: 10px;
    }

    .polaroid img {
        border-radius: 3px;
    }
</style>

<script>
    // Optional: Add interactive hearts on click
    document.addEventListener('click', (e) => {
        if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON') {
            createHeart(e.pageX, e.pageY);
        }
    });

    function createHeart(x, y) {
        const heart = document.createElement('div');
        heart.textContent = '💛';
        heart.style.position = 'fixed';
        heart.style.left = x + 'px';
        heart.style.top = y + 'px';
        heart.style.fontSize = '2rem';
        heart.style.pointerEvents = 'none';
        heart.style.zIndex = '9999';
        heart.style.animation = 'floatUp 2s ease-out forwards';
        document.body.appendChild(heart);

        setTimeout(() => heart.remove(), 2000);
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes floatUp {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-100px) scale(1.5);
            }
        }
    `;
    document.head.appendChild(style);
</script>

<!-- Background Music -->
<audio autoplay loop style="display: none;">
    <source src="/sound/The 1975 - About You (Official) - nabila.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
@endsection
