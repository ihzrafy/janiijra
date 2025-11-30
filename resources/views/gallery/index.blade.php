@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
        <div class="text-6xl mb-4 animate-bounce-soft">📸</div>
        <h2 class="text-4xl font-bold text-text mb-4">
            Our Moments
        </h2>
        <p class="text-text/70">Collection of precious memories</p>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-12">
        @php
            $photos = [
                1 => 'mp4', 2 => 'jpg', 3 => 'mp4', 4 => 'jpg', 5 => 'jpg', 6 => 'jpg', 7 => 'jpg', 8 => 'jpg', 9 => 'jpg', 10 => 'jpg',
                11 => 'jpg', 12 => 'mp4', 13 => 'mp4', 14 => 'jpg', 15 => 'jpg', 16 => 'jpg', 17 => 'jpg', 18 => 'jpg', 19 => 'jpg', 20 => 'jpg',
                21 => 'mov', 22 => 'mov', 23 => 'mov', 24 => 'jpg', 25 => 'jpg', 26 => 'jpg', 27 => 'jpg', 28 => 'mov', 29 => 'jpg', 30 => 'jpg',
                31 => 'jpg', 32 => 'jpg', 33 => 'mp4', 34 => 'jpg', 35 => 'jpg', 36 => 'jpg', 37 => 'jpg', 38 => 'jpg', 39 => 'jpg', 40 => 'jpg',
                41 => 'mov', 42 => 'mp4', 43 => 'jpg', 44 => 'mov', 45 => 'jpg', 46 => 'mp4', 47 => 'mov', 48 => 'mp4', 49 => 'jpg', 50 => 'mp4',
                51 => 'mov', 52 => 'jpg', 53 => 'jpg', 54 => 'jpg', 55 => 'jpg', 56 => 'mov', 57 => 'jpg', 58 => 'mov', 59 => 'mp4', 60 => 'jpg',
                61 => 'mp4', 62 => 'mp4', 63 => 'jpg', 64 => 'jpg', 65 => 'jpg', 66 => 'png', 67 => 'jpg', 68 => 'jpg', 69 => 'jpg', 70 => 'jpg',
                71 => 'jpg', 72 => 'jpg', 73 => 'jpg', 74 => 'jpg', 75 => 'jpg', 76 => 'jpg', 77 => 'jpg', 78 => 'jpg', 79 => 'jpg', 80 => 'jpg',
                81 => 'jpg', 82 => 'jpg', 83 => 'jpg', 84 => 'jpg', 85 => 'jpg', 86 => 'jpg', 87 => 'jpg', 88 => 'jpg', 89 => 'jpg', 90 => 'jpg',
                91 => 'jpg', 92 => 'jpg', 93 => 'jpg', 94 => 'jpg', 95 => 'jpg', 96 => 'jpg', 97 => 'jpg', 102 => 'png', 103 => 'mov'
            ];
        @endphp
        @foreach($photos as $i => $ext)
        <div class="aspect-square bg-yellow-light/30 rounded-2xl overflow-hidden cursor-pointer hover:scale-105 transition-transform shadow-lg hover:shadow-xl relative" onclick="openLightbox({{ $i }})">
            @if(in_array($ext, ['mp4', 'mov']))
                <video class="w-full h-full object-cover" muted>
                    <source src="/images/photo{{ $i }}.{{ $ext }}" type="video/{{ $ext }}">
                </video>
                <div class="absolute inset-0 flex items-center justify-center bg-black/20 pointer-events-none">
                    <div class="text-4xl text-white">▶</div>
                </div>
            @else
                <img src="/images/photo{{ $i }}.{{ $ext }}" alt="Photo {{ $i }}" class="w-full h-full object-cover">
            @endif
        </div>
        @endforeach
    </div>

    <div class="card-cute p-6 text-center mb-8">
        <p class="text-sm text-text/80">
            <strong>✨ Gallery berisi 99 foto & video kenangan kita!</strong><br>
            📸 Foto (.jpg, .png) | 🎥 Video (.mp4, .mov)
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('home') }}" class="text-text hover:text-yellow-warm transition-colors text-sm font-medium">
            ← Back to Home
        </a>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-text/95 hidden items-center justify-center z-50" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-yellow-lightest text-3xl hover:text-yellow-pastel transition" onclick="closeLightbox()">
        ✕
    </button>
    <button class="absolute left-6 text-yellow-lightest text-3xl hover:text-yellow-pastel transition" onclick="event.stopPropagation(); previousImage()">
        ←
    </button>
    <button class="absolute right-6 text-yellow-lightest text-3xl hover:text-yellow-pastel transition" onclick="event.stopPropagation(); nextImage()">
        →
    </button>
    <div id="lightboxContent" class="max-w-4xl max-h-screen p-4">
        <!-- Image will be loaded here -->
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentImage = 1;
    const totalImages = 99;
    const photos = {
        1: 'mp4', 2: 'jpg', 3: 'mp4', 4: 'jpg', 5: 'jpg', 6: 'jpg', 7: 'jpg', 8: 'jpg', 9: 'jpg', 10: 'jpg',
        11: 'jpg', 12: 'mp4', 13: 'mp4', 14: 'jpg', 15: 'jpg', 16: 'jpg', 17: 'jpg', 18: 'jpg', 19: 'jpg', 20: 'jpg',
        21: 'mov', 22: 'mov', 23: 'mov', 24: 'jpg', 25: 'jpg', 26: 'jpg', 27: 'jpg', 28: 'mov', 29: 'jpg', 30: 'jpg',
        31: 'jpg', 32: 'jpg', 33: 'mp4', 34: 'jpg', 35: 'jpg', 36: 'jpg', 37: 'jpg', 38: 'jpg', 39: 'jpg', 40: 'jpg',
        41: 'mov', 42: 'mp4', 43: 'jpg', 44: 'mov', 45: 'jpg', 46: 'mp4', 47: 'mov', 48: 'mp4', 49: 'jpg', 50: 'mp4',
        51: 'mov', 52: 'jpg', 53: 'jpg', 54: 'jpg', 55: 'jpg', 56: 'mov', 57: 'jpg', 58: 'mov', 59: 'mp4', 60: 'jpg',
        61: 'mp4', 62: 'mp4', 63: 'jpg', 64: 'jpg', 65: 'jpg', 66: 'png', 67: 'jpg', 68: 'jpg', 69: 'jpg', 70: 'jpg',
        71: 'jpg', 72: 'jpg', 73: 'jpg', 74: 'jpg', 75: 'jpg', 76: 'jpg', 77: 'jpg', 78: 'jpg', 79: 'jpg', 80: 'jpg',
        81: 'jpg', 82: 'jpg', 83: 'jpg', 84: 'jpg', 85: 'jpg', 86: 'jpg', 87: 'jpg', 88: 'jpg', 89: 'jpg', 90: 'jpg',
        91: 'jpg', 92: 'jpg', 93: 'jpg', 94: 'jpg', 95: 'jpg', 96: 'jpg', 97: 'jpg', 102: 'png', 103: 'mov'
    };

    function openLightbox(imageNumber) {
        currentImage = imageNumber;
        showImage();
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
    }

    function showImage() {
        const content = document.getElementById('lightboxContent');
        const ext = photos[currentImage];
        const isVideo = ['mp4', 'mov'].includes(ext);
        
        if (isVideo) {
            content.innerHTML = `
                <video controls autoplay class="max-w-full max-h-screen rounded-lg">
                    <source src="/images/photo${currentImage}.${ext}" type="video/${ext}">
                    Your browser does not support the video tag.
                </video>
            `;
        } else {
            content.innerHTML = `<img src="/images/photo${currentImage}.${ext}" alt="Photo ${currentImage}" class="max-w-full max-h-screen rounded-lg">`;
        }
    }

    function previousImage() {
        currentImage = currentImage > 1 ? currentImage - 1 : totalImages;
        showImage();
    }

    function nextImage() {
        currentImage = currentImage < totalImages ? currentImage + 1 : 1;
        showImage();
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'ArrowLeft') previousImage();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'Escape') closeLightbox();
        }
    });
</script>
@endsection
