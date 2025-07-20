@props(['user'])

<div class="flex items-center justify-between">
    <div class="flex items-center">
        <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url ?? 'https://placehold.co/100x100/EBF4FF/7F9CF5?text=' . strtoupper(substr($user->name, 0, 1)) }}" alt="{{ $user->name }}">
        <div class="ml-3">
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Disarankan untuk Anda</p>
        </div>
    </div>
    <form action="{{ route('users.follow', $user) }}" method="POST">
        @csrf
        <button type="submit" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200">
            Ikuti
        </button>
    </form>
</div>