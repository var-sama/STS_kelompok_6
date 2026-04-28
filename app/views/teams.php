<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #eeeeee;
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
        .team-card:hover .pin-icon {
            stroke: #ffffff !important;
            transition: stroke 0.2s ease 0.2s;
        }
    </style>
</head>
<body>

    <div class="flex min-h-screen">
        
        <?php require_once '../app/views/components/navbar.php'?>

        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="card-bg rounded-2xl p-6 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 hover:border-[#2dd4bf] transition-all cursor-pointer group min-h-[210px] max-w-[440px] w-full">
                        <div class="w-20 h-20 rounded-full border-2 border-[#2dd4bf] flex items-center justify-center mb-4 group-hover:bg-[#2dd4bf]/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 accent-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="text-gray-400 font-medium group-hover:text-white">Add New Team</span>
                    </div>

                    <script>
                        const teams = [
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

                        document.write(teams.map(team => `
                            <div class="card-bg rounded-2xl p-6 relative flex flex-col items-center justify-start min-h-[215px] max-w-[440px] w-full hover:shadow-xl hover:shadow-black/50 transition-all group hover:ring-2 hover:scale-[1.03] hover:ring-[#2dd4bf]">
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>
                                <img src="${team.img}" alt="team" class="w-20 h-20 rounded-xl object-cover mb-2 mt-2">
                                <h3 class="font-bold text-lg text-white text-center leading-tight mt-0 mb-1">${team.name}</h3>
                                <p class="text-gray-400 text-sm text-center leading-snug mb-0">${team.desc}</p>
                                <div class="absolute bottom-2 left-4">
                                    <button class="p-1 rounded-lg hover:bg-white/10 transition-all duration-200 group-pin" style="transition-delay: 0s">
                                        <svg width="24" height="24" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.1527 15.4962L3.20605 22.4428M5.34347 10.1367L15.1681 19.9613L16.9817 18.1477L16.5617 14.1005L22.4503 9.10643L16.1983 2.85449L11.2032 8.74307L7.15707 8.32307L5.34347 10.1367Z" stroke="#4c515f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pin-icon transition-colors duration-200"/>
                                        </svg>
                                    </button>
                                </div>
                                <style>
                                    .group-pin:hover .pin-icon {
                                        stroke: #ffffff !important;
                                        transition-delay: 0s;
                                    }
                                </style>
                            </div>
                        `).join(''));
                    </script>

                </div>
            </div>
        </main>
    </div>

</body>
</html>