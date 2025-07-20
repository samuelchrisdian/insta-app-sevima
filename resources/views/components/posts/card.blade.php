@props(['post'])

<div class="bg-white/90 dark:bg-gray-800/90 shadow-md rounded-lg overflow-hidden backdrop-blur-sm">
    <!-- Header Kartu -->
    <div class="p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url ?? 'https://placehold.co/100x100/EBF4FF/7F9CF5?text=' . strtoupper(substr($post->user->name, 0, 1)) }}" alt="{{ $post->user->name }}">
            <div class="ml-3">
                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
            </div>
        </div>
        {{-- Tombol Opsi (misal untuk hapus) --}}
        @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-gray-500 hover:text-red-500" onclick="return confirm('Anda yakin ingin menghapus post ini?')">Hapus</button>
        </form>
        @endcan
    </div>

    <!-- Gambar Postingan -->
    <div>
        <img class="w-full h-auto" src="{{ $post->getFirstMediaUrl('images') }}" alt="{{ $post->caption }}">
    </div>

    <!-- Aksi dan Konten di Bawah Gambar -->
    <div class="p-4">
        <!-- Tombol Aksi: Like, Comment -->
        <div class="flex items-center space-x-4">
            {{-- Tombol Like --}}
            <button class="like-button flex items-center space-x-1 {{ $post->likes->contains('user_id', auth()->id()) ? 'text-red-500' : 'text-gray-600 dark:text-gray-300' }} hover:text-red-500" data-post-id="{{ $post->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.75 20.814a1.5 1.5 0 01-1.5 0C6.432 17.057 2.25 13.184 2.25 8.625 2.25 5.56 4.695 3 7.688 3c1.92 0 3.623 1.023 4.312 2.578C12.688 4.023 14.39 3 16.313 3 19.305 3 21.75 5.56 21.75 8.625c0 4.559-4.182 8.432-8.999 12.189z" />
                </svg>
            </button>
            {{-- Tombol Comment (bisa untuk fokus ke input) --}}
            <button onclick="document.getElementById('comment-input-{{ $post->id }}').focus()" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </button>
        </div>

        <!-- Jumlah Likes -->
        <div class="mt-3">
            <p id="like-count-{{ $post->id }}" class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->likes->count() }} suka</p>
        </div>

        <!-- Caption -->
        <div class="mt-1">
            <p class="text-sm text-gray-800 dark:text-gray-200">
                <a href="#" class="font-semibold">{{ $post->user->name }}</a>
                {{ $post->caption }}
            </p>
        </div>

        <!-- Daftar Komentar -->
        <div class="mt-2 space-y-2">
            @foreach($post->comments->take(2) as $comment) {{-- Ambil 2 komentar terbaru --}}
            <div class="text-sm">
                <a href="#" class="font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->name }}</a>
                <span class="text-gray-700 dark:text-gray-300">{{ $comment->body }}</span>
            </div>
            @endforeach
            @if($post->comments->count() > 2)
            <a href="#" class="text-sm text-gray-500 dark:text-gray-400">Lihat semua {{ $post->comments->count() }} komentar</a>
            @endif
        </div>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 uppercase">{{ $post->created_at->diffForHumans() }}</p>
    </div>

    <!-- Form Tambah Komentar -->
    <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-3">
        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex items-center">
            @csrf
            <input id="comment-input-{{ $post->id }}" name="body" class="w-full bg-transparent border-none focus:ring-0 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-500" placeholder="Tambahkan komentar..." required>
            <button type="submit" class="ml-4 text-sm font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200">Kirim</button>
        </form>
    </div>
</div>

