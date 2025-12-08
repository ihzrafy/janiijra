<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jani Ijra</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💕</text></svg>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-yellow-lightest min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-yellow-light/20">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-serif font-semibold text-text-dark hover:text-yellow-medium transition-colors">
                    💛
                </a>
                <div class="flex gap-1 md:gap-2 text-sm">
                    <a href="{{ route('home') }}" class="px-3 py-2 text-text-dark hover:text-yellow-medium hover:bg-yellow-soft rounded-md transition-all">Home</a>
                    <a href="{{ route('games.index') }}" class="px-3 py-2 text-text-dark hover:text-yellow-medium hover:bg-yellow-soft rounded-md transition-all">Games</a>
                    <a href="{{ route('poem') }}" class="px-3 py-2 text-text-dark hover:text-yellow-medium hover:bg-yellow-soft rounded-md transition-all">Poetry</a>
                    <a href="{{ route('gallery') }}" class="px-3 py-2 text-text-dark hover:text-yellow-medium hover:bg-yellow-soft rounded-md transition-all">Gallery</a>
                    <a href="{{ route('message') }}" class="px-3 py-2 text-text-dark hover:text-yellow-medium hover:bg-yellow-soft rounded-md transition-all">Message</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Floating Polaroid Photos -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        @php
            $polaroidPhotos = [9, 5, 10, 15, 25, 74, 45, 55, 65, 75, 85];
            $positions = [
                ['top-10 left-10 rotate-[-15deg]', 'top-20 left-20'],
                ['top-32 right-10 rotate-[12deg]', 'top-40 right-20'],
                ['bottom-20 left-16 rotate-[-8deg]', 'bottom-32 left-24'],
                ['bottom-24 right-20 rotate-[15deg]', 'bottom-40 right-32'],
                ['top-1/2 left-8 -translate-y-1/2 rotate-[-20deg]', 'top-1/2 left-16'],
                ['top-1/3 right-12 rotate-[10deg]', 'top-1/3 right-20'],
                ['bottom-1/3 left-12 rotate-[8deg]', 'bottom-1/3 left-20'],
            ];
        @endphp
        @foreach($positions as $index => $position)
            @if($index < count($polaroidPhotos))
            <div class="absolute {{ $position[0] }} opacity-20 hover:opacity-40 transition-opacity duration-300 animate-float-slow hidden lg:block" style="animation-delay: {{ $index * 0.5 }}s">
                <div class="polaroid-frame bg-white p-3 shadow-2xl" style="width: 140px;">
                    <img src="/images/photo{{ $polaroidPhotos[$index] }}.jpg" alt="Memory" class="w-full h-32 object-cover">
                    <div class="text-center mt-2 text-xs text-gray-600 font-handwriting">♡</div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 relative z-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-8 mt-12 relative z-10">
        <p class="text-text/70 text-sm">Made with 💛 love</p>
    </footer>

    <style>
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(var(--rotate)); }
            50% { transform: translateY(-20px) rotate(var(--rotate)); }
        }
        .animate-float-slow {
            animation: float-slow 6s ease-in-out infinite;
        }
        .polaroid-frame {
            transform: var(--rotate);
        }
        .font-handwriting {
            font-family: 'Playfair Display', serif;
        }
    </style>

    @yield('scripts')
</body>
</html>
