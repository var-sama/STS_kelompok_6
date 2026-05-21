<?php
// Cek apakah session sudah aktif, jika belum, aktifkan secara otomatis
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

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
    
    /* Efek Active untuk Menu Utama */
    .sidebar a.active:not(.profile-link) {
        color: #2dd4bf;
        transform: scale(1.1);
        transform-origin: left;
        background: rgba(45, 212, 191, 0.1);
        border-left: 4px solid #2dd4bf;
    }
    .sidebar a.active:not(.profile-link) iconify-icon {
        color: #2dd4bf;
    }

    /* Efek Active Khusus untuk Profile */
    .sidebar a.profile-link.active {
        background: rgba(45, 212, 191, 0.05); /* Sedikit highlight background (opsional) */
    }
    /* Tambahkan stroke/ring cyan di sekeliling avatar saat profil aktif */
    .sidebar a.profile-link.active .profile-avatar {
        outline: 2px solid #2dd4bf;
        outline-offset: 2px;
    }
</style>

<div class="sidebar group box-border w-[70px] h-screen bg-[#222831] flex flex-col pt-[100px] gap-[10px] transition-[width] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] shrink-0 sticky top-0 z-50 overflow-x-hidden font-sans" id="sidebar">
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

    <div class="flex flex-col items-center gap-[10px] w-full px-[10px] mt-auto pb-[20px]">
        
        <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['nama'])): ?>
            <?php 
                $nama_user = $_SESSION['user']['nama'];
                // Ambil huruf pertama untuk inisial
                $inisial = strtoupper(substr($nama_user, 0, 1));
            ?>
            <a href="/profile" class="profile-link w-full h-[50px] flex items-center justify-start rounded-full hover:bg-[#20c9ac]/10 transition-colors cursor-pointer overflow-hidden no-underline px-[5px]">
                <div class="profile-avatar w-[40px] h-[40px] shrink-0 rounded-full bg-[#20c9ac] text-[#064e3b] flex justify-center items-center font-bold text-[18px] transition-all duration-200">
                    <?= $inisial ?>
                </div>
                <span class="text-[#cfd8dc] opacity-0 max-w-0 overflow-hidden transition-[opacity,transform,max-width,margin] duration-200 ease-in-out font-semibold text-[14px] group-[.open]:ml-[10px] whitespace-nowrap">
                    <?= htmlspecialchars($nama_user) ?>
                </span>
            </a>

        <?php else: ?>
            <button id="loginBtn" class="w-full h-[40px] rounded-full border border-[#20c9ac]/50 text-[#20c9ac] flex justify-center items-center hover:bg-[#20c9ac]/10 transition-colors whitespace-nowrap cursor-pointer bg-transparent overflow-hidden">
                <i class="ti ti-login text-[18px] shrink-0"></i>
                <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform,max-width,margin] duration-200 ease-in-out font-medium text-[14px] group-[.open]:ml-[6px]">Login</span>
            </button>
            <button id="registerBtn" class="w-full h-[40px] rounded-full bg-[#20c9ac] text-[#064e3b] flex justify-center items-center hover:opacity-85 transition-opacity whitespace-nowrap border-none cursor-pointer overflow-hidden">
                <i class="ti ti-user-plus text-[18px] shrink-0"></i>
                <span class="opacity-0 max-w-0 overflow-hidden transition-[opacity,transform,max-width,margin] duration-200 ease-in-out font-medium text-[14px] group-[.open]:ml-[6px]">Daftar</span>
            </button>
        <?php endif; ?>

    </div>
</div>

<script>
    const sidebar = document.getElementById("sidebar");
    const links = document.querySelectorAll(".sidebar a");

    window.addEventListener("DOMContentLoaded", () => {
        const state = localStorage.getItem("sidebar");
        if (state === "open") sidebar.classList.add("open");
    });

    sidebar.addEventListener("click", (event) => {
        if (event.target === sidebar) {
            sidebar.classList.toggle("open");
            localStorage.setItem("sidebar", sidebar.classList.contains("open") ? "open" : "closed");
        }
    });

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
            if(!link.getAttribute("href")) return; 

            e.preventDefault();
            links.forEach(l => l.classList.remove("active"));
            link.classList.add("active");

            setTimeout(() => {
                window.location.href = link.getAttribute("href");
            }, 150);
        });
    });

    const loginBtn = document.getElementById("loginBtn");
    if (loginBtn) {
        loginBtn.addEventListener("click", () => window.location.href = "/login");
    }

    const registerBtn = document.getElementById("registerBtn");
    if (registerBtn) {
        registerBtn.addEventListener("click", () => window.location.href = "/register");
    }
</script>