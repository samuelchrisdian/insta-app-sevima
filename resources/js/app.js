import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('click', function (event) {
    // Cek apakah elemen yang diklik atau parent-nya memiliki class 'like-button'
    const likeButton = event.target.closest('.like-button');

    // Jika bukan tombol like, hentikan eksekusi
    if (!likeButton) {
        return;
    }

    // Ambil data dari tombol
    const postId = likeButton.dataset.postId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Kirim request ke server
    fetch(`/posts/${postId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Update jumlah likes
            const likeCountElement = document.getElementById(`like-count-${postId}`);
            if (likeCountElement) {
                likeCountElement.textContent = `${data.likes_count} suka`;
            }

            // Update warna tombol like
            if (data.liked) {
                likeButton.classList.add('text-red-500');
                likeButton.classList.remove('text-gray-600', 'dark:text-gray-300');
            } else {
                likeButton.classList.remove('text-red-500');
                likeButton.classList.add('text-gray-600', 'dark:text-gray-300');
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
});