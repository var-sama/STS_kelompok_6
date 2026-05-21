<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<style>
    /* State Dinamis yang Dikontrol oleh JavaScript */
    .sidebar.open {
        width: 240px;
    }
    .sidebar.open span {
        opacity: 1;
        max-width: 150px;
    }
    .sidebar a:hover {
        color: #2dd4bf;
        background: rgba(45, 212, 191, 0.05);
    }
    .sidebar a.active {
        color: #2dd4bf;
        transform: scale(1.1);
        transform-origin: left;
        background: rgba(45, 212, 191, 0.1);
        border-left: 4px solid #2dd4bf;
    }
    .sidebar a.active iconify-icon {
        color: #2dd4bf;
    }
</style>

<div class="sidebar box-border w-[70px] h-screen bg-[#222831] flex flex-col pt-[100px] gap-[10px] transition-[width] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] shrink-0 sticky top-0 z-50 overflow-x-hidden font-sans" id="sidebar">
    <a href="/" class="active text-[#cfd8dc] no-underline flex items-center h-[50px] w-full transition-all duration-200 ease-in-out whitespace-nowrap">
        <iconify-icon icon="lucide:home" class="w-[70px] shrink-0 flex justify-center items-center text-[30px] transition-all duration-200"></iconify-icon>
        <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform] duration-200 ease-in-out font-semibold text-[16px] ml-[5px]">Homepage</span>
    </a>
    <a href="/tags" class="text-[#cfd8dc] no-underline flex items-center h-[50px] w-full transition-all duration-200 ease-in-out whitespace-nowrap">
        <iconify-icon icon="mingcute:tag-line" class="w-[70px] shrink-0 flex justify-center items-center text-[30px] transition-all duration-200"></iconify-icon>
        <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform] duration-200 ease-in-out font-semibold text-[16px] ml-[5px]">Tag</span>
    </a>
    <a href="/teams" class="text-[#cfd8dc] no-underline flex items-center h-[50px] w-full transition-all duration-200 ease-in-out whitespace-nowrap">
        <iconify-icon icon="ri:team-fill" class="w-[70px] shrink-0 flex justify-center items-center text-[30px] transition-all duration-200"></iconify-icon>
        <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform] duration-200 ease-in-out font-semibold text-[16px] ml-[5px]">Teams</span>
    </a>
    <a href="/bookmark" class="text-[#cfd8dc] no-underline flex items-center h-[50px] w-full transition-all duration-200 ease-in-out whitespace-nowrap">
        <iconify-icon icon="material-symbols:bookmark" class="w-[70px] shrink-0 flex justify-center items-center text-[30px] transition-all duration-200"></iconify-icon>
        <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform] duration-200 ease-in-out font-semibold text-[16px] ml-[5px]">Bookmark</span>
    </a>
    <a href="/profile" class="text-[#cfd8dc] no-underline flex items-center h-[50px] w-full transition-all duration-200 ease-in-out whitespace-nowrap">
        <iconify-icon icon="mingcute:user-4-line" class="w-[70px] shrink-0 flex justify-center items-center text-[30px] transition-all duration-200"></iconify-icon>
        <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform] duration-200 ease-in-out font-semibold text-[16px] ml-[5px]">Profile</span>
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

        if (href === currentPath || (currentPath === '/teams-detail' && href === '/teams') || (currentPath === '/teams-create' && href === '/teams')) {
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