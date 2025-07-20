<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">

                {{-- Loop untuk menampilkan setiap postingan --}}
                @forelse ($posts as $post)
                {{-- Memanggil komponen card dan mengirimkan data $post --}}
                <x-posts.card :post="$post" />
                @empty
                {{-- Tampilan jika tidak ada postingan sama sekali --}}
                <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-600 dark:text-gray-300">Belum ada postingan untuk ditampilkan.</p>
                    <a href="{{ route('posts.create') }}" class="mt-4 inline-block">
                        <x-primary-button>
                            {{ __('Buat Postingan Pertama Anda') }}
                        </x-primary-button>
                    </a>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>