<link rel="stylesheet" href="/css/Navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<div class="sidebar" id="sidebar">
            <!-- <button id="toggle">☰</button> -->
            <a href="#">
                <iconify-icon icon="lucide:home"></iconify-icon>
                <span>Homepage</span>
            </a>
            <a href="#">
                <iconify-icon icon="mingcute:tag-line"></iconify-icon>
                <span>Tag</span>
            </a>
            <a href="#">
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
    const toggle = document.getElementById("toggle");

    // Toggle when clicking the sidebar background (not when clicking links)
    sidebar.addEventListener("click", (event) => {
        if (event.target === sidebar || event.target === toggle) {
            sidebar.classList.toggle("open");
        }
    });
</script>