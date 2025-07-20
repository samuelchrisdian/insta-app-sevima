<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Postingan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg backdrop-blur-sm">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Form harus memiliki enctype untuk upload file --}}
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Gambar -->
                        <div>
                            <x-input-label for="image" :value="__('Gambar')" />

                            {{-- Preview Gambar --}}
                            <img id="image-preview" class="mt-2 rounded-lg max-h-80 w-full object-cover hidden" src="#" alt="Image Preview" />

                            <input accept="image/png, image/jpeg" id="image" name="image" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-2" required onchange="previewImage(event)">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Input Caption -->
                        <div class="mt-4">
                            <x-input-label for="caption" :value="__('Caption')" />
                            <textarea id="caption" name="caption" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Tulis caption Anda di sini...">{{ old('caption') }}</textarea>
                            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Unggah') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi sederhana untuk menampilkan preview gambar sebelum di-upload
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('image-preview');

            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
</x-app-layout>