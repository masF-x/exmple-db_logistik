document.addEventListener("DOMContentLoaded", function () {
    const logoutBtn = document.querySelector("a[href='logout.php']");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function (e) {
            if (!confirm("Apakah Anda yakin ingin logout?")) {
                e.preventDefault();
            }
        });
    }

    const deleteLinks = document.querySelectorAll("a[href*='delete_']");
    deleteLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                e.preventDefault();
            }
        });
    });
});
