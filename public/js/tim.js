// Data tim statis (Hanya untuk tampilan)
    const teamsData = [
        { name: 'Creative UI Design', desc: 'Fokus pada pengembangan interface aplikasi mobile.', img: 'https://ui-avatars.com/api/?name=C+D&background=2dd4bf&color=fff' },
        { name: 'Backend Engineer', desc: 'Optimasi database dan integrasi API sistem.', img: 'https://ui-avatars.com/api/?name=B+E&background=6366f1&color=fff' },
        { name: 'Marketing Strategy', desc: 'Analisis pasar dan kampanye media sosial.', img: 'https://ui-avatars.com/api/?name=M+S&background=f43f5e&color=fff' },
        { name: 'blackops', desc: 'the ral testing', img: 'https://i.pinimg.com/originals/d4/d3/09/d4d309ca2028d42887cdd8be49e5af53.jpg' },
        { name: 'kafuu shop', desc: 'cafelate kafuu mocha capuchino', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA-AoqV02ciq-9gk0OGqDJ3Vj8j1IhawjJiQ&s' },
        { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLZXGu4P1f1KgAX_mrEYxZAyM93S-7oQGUOQ&s' },
        { name: 'Republic of Gamer', desc: 'Memahami dan membuat teknologi', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShIloDOvVrCJ9nNhworDEONOFxP3-bYk6t9w&s' },
        { name: 'Prakarya', desc: 'Membuat dan menjual produk kerajinan', img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRcagCkaI3JgKK784HUB1ELJlOQq6fVpBkig&s' },
        { name: 'DevOps Team', desc: 'Maintenance server dan CI/CD pipeline.', img: 'https://ui-avatars.com/api/?name=D+O&background=a855f7&color=fff' }
    ];

    function renderTeams() {
        const grid = document.getElementById('teams-grid');
        if (!grid) return;

        // Tombol "Add New Team" (Tetap berfungsi)
        const addCardHtml = `
            <div class="card-bg rounded-2xl p-6 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 hover:border-[#2dd4bf] transition-all cursor-pointer group min-h-[210px] max-w-[440px] w-full" onclick="window.location.href='/teams-create'">
                <div class="w-20 h-20 rounded-full border-2 border-[#2dd4bf] flex items-center justify-center mb-4 group-hover:bg-[#2dd4bf]/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#2dd4bf]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-gray-400 font-medium group-hover:text-white">Add New Team</span>
            </div>
        `;

        // Card Tim
        const teamsHtml = teamsData.map((team, index) => `
            <div class="card-bg rounded-2xl p-6 relative flex flex-col items-center justify-start min-h-[215px] max-w-[440px] w-full hover:shadow-xl hover:shadow-black/50 transition-all group hover:ring-2 hover:scale-[1.03] hover:ring-[#2dd4bf] cursor-pointer" onclick="window.location.href='/teams-detail?id=${index}'">
                
                <div class="absolute top-4 right-4">
                    <button class="text-gray-500 hover:text-white focus:outline-none transition-colors" onclick="event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </button>
                </div>

                <img src="${team.img}" alt="team" class="w-20 h-20 rounded-xl object-cover mb-2 mt-2">
                <h3 class="font-bold text-lg text-white text-center leading-tight mt-0 mb-1">${team.name}</h3>
                <p class="text-gray-400 text-sm text-center leading-snug mb-0">${team.desc}</p>
                
                <div class="absolute bottom-2 left-4">
                    <button class="p-1 rounded-lg hover:bg-white/10 transition-all duration-200 group-pin" onclick="event.stopPropagation();">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.56045 14.5928L3.01904 21.1342M5.03178 9.54589L14.2834 18.7975L15.9912 17.0896L15.5957 13.2785L21.1408 8.57575L15.2535 2.68848L10.5497 8.23358L6.7396 7.83808L5.03178 9.54589Z" stroke="#4C515F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="pin-icon transition-colors duration-200"/>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');

        grid.innerHTML = addCardHtml + teamsHtml;
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', renderTeams);