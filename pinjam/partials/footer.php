<footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2024&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>

<script>
// Tandai SEMUA notifikasi sebagai terbaca saat dropdown diklik
document.getElementById('notification-dropdown').addEventListener('shown.bs.dropdown', function() {
    fetch('mark_all_read.php')
        .then(() => {
            // Update tampilan tanpa reload
            document.querySelectorAll('.dropdown-item.fw-bold').forEach(item => {
                item.classList.remove('fw-bold');
            });
            document.getElementById('notification-badge')?.remove();
            document.getElementById('notification-count').textContent = '0';
        });
});

// Tandai SATU notifikasi sebagai terbaca saat diklik (opsional)
document.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-item[data-id]')) {
        const notifId = e.target.closest('.dropdown-item[data-id]').dataset.id;
        fetch(`mark_as_read.php?id=${notifId}`);
    }
});
</script>
