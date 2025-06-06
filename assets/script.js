// Auto-refresh notifikasi setiap 30 detik
function refreshNotifications() {
    fetch('get_notifications.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('notification-list').innerHTML = html;
            updateBadgeCount();
        });
}

// Hitung notifikasi belum dibaca
function updateBadgeCount() {
    const unreadItems = document.querySelectorAll('.dropdown-item.fw-bold');
    const badge = document.getElementById('notification-badge');
    const countElement = document.getElementById('notification-count');

    if (unreadItems.length > 0) {
        if (!badge) {
            const bell = document.getElementById('notification-bell');
            const newBadge = document.createElement('span');
            newBadge.id = 'notification-badge';
            newBadge.className = 'navbar-badge badge text-bg-warning';
            newBadge.textContent = unreadItems.length;
            bell.appendChild(newBadge);
        } else {
            badge.textContent = unreadItems.length;
        }
        countElement.textContent = unreadItems.length;
    } else {
        if (badge) badge.remove();
        countElement.textContent = '0';
    }
}

// Tandai sebagai dibaca saat diklik
document.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item[data-id]')) {
        const notifId = e.target.closest('.dropdown-item[data-id]').dataset.id;
        fetch(`mark_as_read.php?id=${notifId}`);
        e.target.closest('.dropdown-item').classList.remove('fw-bold');
        updateBadgeCount();
    }
});

// Jalankan pertama kali dan set interval
refreshNotifications();
setInterval(refreshNotifications, 30000);
