<link rel="stylesheet" href="/css/Navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<div class="sidebar" id="sidebar">
            <!-- <button id="toggle">☰</button> -->
            <a href="/" class="active">
                <iconify-icon icon="lucide:home"></iconify-icon>
                <span>Homepage</span>
            </a>
            <a href="#">
                <iconify-icon icon="mingcute:tag-line"></iconify-icon>
                <span>Tag</span>
            </a>
            <a href="/teams">
                <iconify-icon icon="ri:team-fill"></iconify-icon>
                <span>Team</span>
            </a>
            <a href="#">
                <iconify-icon icon="material-symbols:bookmark"></iconify-icon>
                <span>Bookmark</span>
            </a>
            <a href="#">
                <iconify-icon icon="mingcute:user-4-line"></iconify-icon>
                <span>Profile</span>
            </a>
        </div>


<script>
    const sidebar = document.getElementById("sidebar");
    const links = document.querySelectorAll(".sidebar a");

    // Restore state saat load
    window.addEventListener("DOMContentLoaded", () => {
        const state = localStorage.getItem("sidebar");

        if (state === "open") {
            sidebar.classList.add("open");
        }
    });

    // Toggle + simpan state
    sidebar.addEventListener("click", (event) => {
        if (event.target === sidebar) {
            sidebar.classList.toggle("open");

            localStorage.setItem(
                "sidebar",
                sidebar.classList.contains("open") ? "open" : "closed"
            );
        }
    });

    // Active pas diklik
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.stopPropagation();

            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");
        });
    });

    // Active berdasarkan URL
    const currentPath = window.location.pathname;

    links.forEach(link => {
        const href = link.getAttribute("href");

        if (href === currentPath) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
    links.forEach(link => {
    link.addEventListener("click", (e) => {
        e.preventDefault();

        links.forEach(l => l.classList.remove("active"));
        link.classList.add("active");

        setTimeout(() => {
            window.location.href = link.getAttribute("href");
        }, 150);
    });
    });
</script>