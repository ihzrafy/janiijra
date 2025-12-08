@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-bounce-soft">✍️</div>
        <h2 class="text-4xl font-bold text-text mb-2">
            Poems for Jani
        </h2>
    </div>

    <!-- Poems Container -->
    <div class="space-y-8">

        <!-- Poem 1 -->
        <div class="card-cute p-8 transform hover:scale-105 transition-transform">
            <div class="text-center mb-4">
                <span class="text-5xl">🌼</span>
            </div>
            <h3 class="text-2xl font-bold text-text text-center mb-4">My Home</h3>
            <div class="text-lg text-text/80 leading-relaxed space-y-3">
                <p class="italic">In your eyes, I found a home where all my tiredness fades.</p>
                <p class="italic">In your laughter, I found peace—one I never found anywhere else.</p>
                <p class="italic">Your warmth is like a sunset that never fails to calm the heart.</p>
                <p class="italic">And in your presence...</p>
                <p class="italic">I found a reason to believe the world is still a gentle place. 🌼</p>
            </div>
        </div>

        <!-- Poem 2 -->
        <div class="card-cute p-8 transform hover:scale-105 transition-transform">
            <div class="text-center mb-4">
                <span class="text-5xl">💛</span>
            </div>
            <h3 class="text-2xl font-bold text-text text-center mb-4">My Favorite Story</h3>
            <div class="text-lg text-text/80 leading-relaxed space-y-3">
                <p class="italic">You are the story I never grow tired of reading,</p>
                <p class="italic">even when I already know every page, every chapter, every pause by heart.</p>
                <p class="italic">Every second with you feels like a new paragraph</p>
                <p class="italic">that makes me fall in love with no explanation needed.</p>
                <p class="italic">Your presence is the book I want to carry with me until I grow old. 💛</p>
            </div>
        </div>

        <!-- Poem 3 -->
        <div class="card-cute p-8 transform hover:scale-105 transition-transform">
            <div class="text-center mb-4">
                <span class="text-5xl">🌸</span>
            </div>
            <h3 class="text-2xl font-bold text-text text-center mb-4">My Reason</h3>
            <div class="text-lg text-text/80 leading-relaxed space-y-3">
                <p class="italic">In every bright morning, I find your name in the air.</p>
                <p class="italic">In every quiet night, I find your longing tucked between the stars.</p>
                <p class="italic">You are the reason my life feels lighter,</p>
                <p class="italic">the reason my steps feel steadier,</p>
                <p class="italic">the reason I am endlessly grateful—day after day. 🌸</p>
            </div>
        </div>

        <!-- Poem 4 -->
        <div class="card-cute p-8 transform hover:scale-105 transition-transform">
            <div class="text-center mb-4">
                <span class="text-5xl">✨</span>
            </div>
            <h3 class="text-2xl font-bold text-text text-center mb-4">Your Kind of Beautiful</h3>
            <div class="text-lg text-text/80 leading-relaxed space-y-3">
                <p class="italic">Your beauty isn't just on your face,</p>
                <p class="italic">but in the way you see the world with a gentle heart.</p>
                <p class="italic">In the way you care about the little things others often overlook.</p>
                <p class="italic">In the way you make me feel valued without being asked.</p>
                <p class="italic">And in the way you simply exist...</p>
                <p class="italic">turning everything around you into something more beautiful. ✨</p>
            </div>
        </div>

        <!-- Poem 5 -->
        <div class="card-cute p-8 transform hover:scale-105 transition-transform">
            <div class="text-center mb-4">
                <span class="text-5xl">💕</span>
            </div>
            <h3 class="text-2xl font-bold text-text text-center mb-4">Forever</h3>
            <div class="text-lg text-text/80 leading-relaxed space-y-3">
                <p class="italic">If someone asked me,</p>
                <p class="italic">how long I would care for you,</p>
                <p class="italic">words wouldn’t be enough to answer it.</p>
                <p class="italic">Time wouldn’t be enough to measure it.</p>
                <p class="italic">Because this feeling...</p>
                <p class="italic">will keep growing,</p>
                <p class="italic">endlessly, without pause,</p>
                <p class="italic">forever—and even beyond that. 💕</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('home') }}" class="btn-cute inline-block">
            ← Back to Home
        </a>
    </div>
</div>

<!-- Animated Flowers -->
<div class="fixed inset-0 pointer-events-none overflow-hidden" style="z-index: 1;">
    <div class="flower-floating" style="left: 15%; animation: float 3s ease-in-out infinite; animation-delay: 0s;">🌼</div>
    <div class="flower-floating" style="right: 15%; animation: float 4s ease-in-out infinite; animation-delay: 1s;">🌸</div>
    <div class="flower-floating" style="left: 50%; top: 20%; animation: float 3.5s ease-in-out infinite; animation-delay: 0.5s;">🌻</div>
</div>
@endsection
