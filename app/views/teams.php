<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a1a2e;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card-bg {
            background-color: #1e2130;
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
    </style>
</head>
<body>

    <div class="flex min-h-screen">
        
        <?php require_once '../app/views/components/navbar.php'?>

        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="card-bg rounded-[1rem] p-8 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 hover:border-teal-400 transition-all cursor-pointer group">
                        <div class="w-16 h-16 rounded-full border-2 border-teal flex items-center justify-center mb-4 group-hover:bg-teal-500/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 accent-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            { name: 'Quality Assurance', desc: 'Testing dan debugging berkala sebelum deployment.', img: 'https://ui-avatars.com/api/?name=Q+A&background=eab308&color=fff' },
                            { name: 'DevOps Team', desc: 'Maintenance server dan CI/CD pipeline.', img: 'https://ui-avatars.com/api/?name=D+O&background=a855f7&color=fff' }
                        ];

                        document.write(teams.map(team => `
                            <div class="card-bg rounded-[1rem] p-5 relative flex items-center gap-4 hover:shadow-xl hover:shadow-black/20 transition-all group">
                                <button class="absolute top-4 right-5 text-gray-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>

                                <div class="shrink-0">
                                    <img src="${team.img}" alt="team" class="w-20 h-20 rounded-2xl object-cover">
                                </div>

                                <div class="flex flex-col pr-6">
                                    <h3 class="font-bold text-lg text-white mb-1">${team.name}</h3>
                                    <p class="text-gray-400 text-sm leading-snug">${team.desc}</p>
                                </div>

                                <div class="absolute bottom-4 left-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-yellow-400 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                            </div>
                        `).join(''));
                    </script>

                </div>
            </div>
        </main>
    </div>

</body>
</html>