<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Kolom Kiri: Profil & Sugesti -->
                <div class="md:col-span-1 space-y-8">
                    <!-- Profil Pengguna -->
                    <div class="bg-white/80 dark:bg-gray-800/80 p-6 rounded-lg shadow-md backdrop-blur-sm text-center">
                        <img class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-white dark:border-gray-700"
                            src="{{ $user->profile_photo_url ?? 'https://placehold.co/150x150/EBF4FF/7F9CF5?text=' . strtoupper(substr($user->name, 0, 1)) }}"
                            alt="{{ $user->name }}">
                        <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>

                        <!-- Stats -->
                        <div class="mt-6 flex justify-around border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="text-center">
                                <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $user->posts->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 block">Postingan</span>
                            </div>
                            <div class="text-center">
                                <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $user->followers->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 block">Pengikut</span>
                            </div>
                            <div class="text-center">
                                <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $user->following->count() }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 block">Mengikuti</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sugesti untuk Anda -->
                    <div class="bg-white/80 dark:bg-gray-800/80 p-6 rounded-lg shadow-md backdrop-blur-sm">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Disarankan untuk Anda</h3>
                        <div class="space-y-4">
                            @forelse($suggestions as $suggestion)
                            <x-suggestion-card :user="$suggestion" />
                            @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada saran untuk saat ini.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Feed atau Konten Lain -->
                <div class="md:col-span-2">
                    <div class="bg-white/80 dark:bg-gray-800/80 p-6 rounded-lg shadow-md backdrop-blur-sm">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Aktivitas Terbaru</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Area ini bisa digunakan untuk menampilkan feed postingan dari orang yang Anda ikuti, atau notifikasi lainnya.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>