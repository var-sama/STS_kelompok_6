<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f6f7fb;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card-bg {
            background-color: #222831;
        }

        .accent-teal {
            color: #2dd4bf; 
        }

        .border-teal {
            border-color: #2dd4bf;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a2e;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e2130;
            border-radius: 10px;
        }

        /* Pin icon hover effect */
        .group-pin:hover .pin-icon {
            stroke: #ffffff !important;
            transition-delay: 0s;
        }
    </style>
</head>
<body>

    <div class="flex min-h-screen">
        
        <?php require_once '../app/views/components/navbar.php'?>

        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                
                <h1 class="text-[28px] font-bold text-[#222831] mb-6">Teams</h1>
                
                <div id="teams-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    </div>

            </div>
        </main>
    </div>

   <script>
    // Data tim original
    const rawTeams = [
        { name: 'Creative UI Design', desc: 'Fokus pada pengembangan interface aplikasi mobile.', img: 'https://ui-avatars.com/api/?name=C+D&background=2dd4bf&color=fff' },
        { name: 'Backend Engineer', desc: 'Optimasi database dan integrasi API sistem.', img: 'https://ui-avatars.com/api/?name=B+E&background=6366f1&color=fff' },
        { name: 'Marketing Strategy', desc: 'Analisis pasar dan kampanye media sosial.', img: 'https://ui-avatars.com/api/?name=M+S&background=f43f5e&color=fff' },
        { name: 'blackops', desc: 'the ral testing', img: 'https://i.pinimg.com/originals/d4/d3/09/d4d309ca2028d42887cdd8be49e5af53.jpg' },
        { name: 'kafuu shop', desc: 'cafelate kafuu mocha capuchino', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA-AoqV02ciq-9gk0OGqDJ3Vj8j1IhawjJiQ&s' },
        { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLZXGu4P1f1KgAX_mrEYxZAyM93S-7oQGUOQ&s' },
        { name: 'Republic of Gamer', desc: 'Memahami dan membuat teknologi', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShIloDOvVrCJ9nNhworDEONOFxP3-bYk6t9w&s' },
        { name: 'Prakarya', desc: 'Membuat dan menjual produk kerajinan', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRcagCkaI3JgKK784HUB1ELJlOQq6fVpBkig&s' },
        { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://ui-avatars.com/api/?name=Q+A&background=eab308&color=fff' },
        { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://ui-avatars.com/api/?name=Q+A&background=eab308&color=fff' },
        { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://ui-avatars.com/api/?name=Q+A&background=eab308&color=fff' },
        { name: 'DevOps Team', desc: 'Maintenance server dan CI/CD pipeline.', img: 'https://ui-avatars.com/api/?name=D+O&background=a855f7&color=fff' }
    ];

   // 1. Tambahkan "rawId" ke data original agar ID-nya unik meski namanya sama
    const rawTeamsWithId = rawTeams.map((team, index) => ({
        ...team,
        isRaw: true,
        rawId: index 
    }));

    // 2. Filter rawTeams berdasarkan "rawId", bukan nama lagi
    const deletedRaw = JSON.parse(localStorage.getItem('deletedRawTeams')) || [];
    const activeRawTeams = rawTeamsWithId.filter(team => !deletedRaw.includes(team.rawId));

    // 3. Ambil data custom dari localStorage
    const customTeams = JSON.parse(localStorage.getItem('myCustomTeams')) || [];
    const formattedCustomTeams = customTeams.map((team) => {
        const initials = team.name.substring(0, 2).toUpperCase().replace(' ', '+');
        const fallbackImg = `https://ui-avatars.com/api/?name=${initials}&background=2dd4bf&color=fff`;
        
        return {
            isRaw: false,
            name: team.name,
            desc: team.description || 'Tidak ada deskripsi',
            img: team.image || fallbackImg,
            customOriginalData: team // Simpan struktur asli untuk patokan hapus
        };
    });

    // 4. Gabungkan datanya
    const allTeams = [...activeRawTeams, ...formattedCustomTeams];

    // Gunakan uiIndex sebagai patokan interaksi
    let teamsData = allTeams.map((team, index) => ({
        ...team,
        uiIndex: index,
        pinnedAt: null
    }));

    // Fungsi untuk menangani klik pin
    function togglePin(event, index) {
        event.stopPropagation();
        const team = teamsData.find(t => t.uiIndex === index);
        if (team.pinnedAt) {
            team.pinnedAt = null;
        } else {
            team.pinnedAt = Date.now();
        }
        renderTeams();
    }

    // Fungsi untuk memunculkan dropdown opsi
    function toggleDropdown(event, index) {
        event.stopPropagation();
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if(el.id !== `dropdown-${index}`) {
                el.classList.add('hidden');
            }
        });

        const dropdown = document.getElementById(`dropdown-${index}`);
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    function viewAnggota(event) {
        event.stopPropagation();
        window.location.href = '/view-anggota';
    }

    function bisukanTim(event) {
        event.stopPropagation();
        alert("Notifikasi tim ini telah dibisukan.");
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
    }

    // --- LOGIKA HAPUS YANG BARU ---
    function hapusTim(event, index) {
        event.stopPropagation();
        const confirmDelete = confirm("Apakah kamu yakin ingin menghapus tim ini?");
        
        if(confirmDelete) {
            const teamToDelete = teamsData.find(t => t.uiIndex === index);

            if (teamToDelete.isRaw) {
                // Hapus tim bawaan dengan menyimpan rawId (index aslinya)
                let deletedRawTeams = JSON.parse(localStorage.getItem('deletedRawTeams')) || [];
                if (!deletedRawTeams.includes(teamToDelete.rawId)) {
                    deletedRawTeams.push(teamToDelete.rawId);
                    localStorage.setItem('deletedRawTeams', JSON.stringify(deletedRawTeams));
                }
            } else {
                // Hapus tim buatan sendiri
                let customTeamsFromStorage = JSON.parse(localStorage.getItem('myCustomTeams')) || [];
                
                // Cari posisi tim di dalam localStorage berdasarkan nama dan deskripsi
                const indexToRemove = customTeamsFromStorage.findIndex(t => 
                    t.name === teamToDelete.customOriginalData.name && 
                    t.description === teamToDelete.customOriginalData.description
                );

                // Hapus HANYA 1 data di posisi tersebut (solusi kalau namanya sama persis)
                if (indexToRemove !== -1) {
                    customTeamsFromStorage.splice(indexToRemove, 1);
                    localStorage.setItem('myCustomTeams', JSON.stringify(customTeamsFromStorage));
                }
            }

            // Hapus dari tampilan layar saat ini
            teamsData = teamsData.filter(t => t.uiIndex !== index);
            renderTeams();
            alert("Tim berhasil dihapus");
        }
        
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
    }

    // Fungsi untuk merender ulang grid
    function renderTeams() {
        const grid = document.getElementById('teams-grid');
        
        const addCardHtml = `
            <div class="card-bg rounded-2xl p-6 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 hover:border-[#2dd4bf] transition-all cursor-pointer group min-h-[210px] max-w-[440px] w-full" onclick="window.location.href='/teams-create'">
                <div class="w-20 h-20 rounded-full border-2 border-[#2dd4bf] flex items-center justify-center mb-4 group-hover:bg-[#2dd4bf]/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 accent-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-gray-400 font-medium group-hover:text-white">Add New Team</span>
            </div>
        `;

        const sortedTeams = [...teamsData].sort((a, b) => {
            if (a.pinnedAt && b.pinnedAt) return b.pinnedAt - a.pinnedAt;
            if (a.pinnedAt) return -1;
            if (b.pinnedAt) return 1;
            return a.uiIndex - b.uiIndex;
        });

        const teamsHtml = sortedTeams.map(team => {
            const isPinned = !!team.pinnedAt;
            const fillStyle = isPinned ? '#ffffff' : 'none';
            const strokeStyle = isPinned ? '#ffffff' : '#4C515F';

            return `
                <div class="card-bg rounded-2xl p-6 relative flex flex-col items-center justify-start min-h-[215px] max-w-[440px] w-full hover:shadow-xl hover:shadow-black/50 transition-all group hover:ring-2 hover:scale-[1.03] hover:ring-[#2dd4bf] cursor-pointer" onclick="window.location.href='/teams-detail'">
                    
                    <div class="absolute top-4 right-4">
                        <button class="text-gray-500 hover:text-white focus:outline-none transition-colors" onclick="toggleDropdown(event, ${team.uiIndex})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </button>

                        <div id="dropdown-${team.uiIndex}" class="hidden absolute right-0 mt-2 w-48 bg-[#2d3142] rounded-lg shadow-xl z-50 border border-gray-700 py-2 transform origin-top-right transition-all">
                            <button onclick="viewAnggota(event)" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                                <i class="fa-solid fa-users w-4 text-center"></i> View Anggota
                            </button>
                            
                            <button onclick="bisukanTim(event)" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                                <i class="fa-solid fa-bell-slash w-4 text-center"></i> Bisukan
                            </button>

                            <div class="h-px bg-gray-700 my-1"></div> 
                            
                            <button onclick="hapusTim(event, ${team.uiIndex})" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 flex items-center gap-3 transition-colors">
                                <i class="fa-solid fa-trash w-4 text-center"></i> Hapus Tim
                            </button>
                        </div>
                    </div>

                    <img src="${team.img}" alt="team" class="w-20 h-20 rounded-xl object-cover mb-2 mt-2">
                    <h3 class="font-bold text-lg text-white text-center leading-tight mt-0 mb-1">${team.name}</h3>
                    <p class="text-gray-400 text-sm text-center leading-snug mb-0">${team.desc}</p>
                    
                    <div class="absolute bottom-2 left-4">
                        <button class="p-1 rounded-lg hover:bg-white/10 transition-all duration-200 group-pin" onclick="togglePin(event, ${team.uiIndex})">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="${fillStyle}" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.56045 14.5928L3.01904 21.1342M5.03178 9.54589L14.2834 18.7975L15.9912 17.0896L15.5957 13.2785L21.1408 8.57575L15.2535 2.68848L10.5497 8.23358L6.7396 7.83808L5.03178 9.54589Z" stroke="${strokeStyle}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="pin-icon transition-colors duration-200"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        }).join('');

        grid.innerHTML = addCardHtml + teamsHtml;
    }

    document.addEventListener('DOMContentLoaded', renderTeams);

    window.addEventListener('click', () => {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    });
</script>

</body>
</html>