<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/teams.css">
</head>
<body>

    <div class="flex min-h-screen">
        
        <?php require_once '../app/views/components/navbar.php'?>

        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                
                <h1 class="text-[28px] font-bold text-[#222831] mb-6">Teams</h1>
                
                <div id="teams-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="card-bg rounded-2xl p-6 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 hover:border-[#2dd4bf] transition-all cursor-pointer group min-h-[210px] max-w-[440px] w-full" onclick="window.location.href='/teams-create'">
                        <div class="w-20 h-20 rounded-full border-2 border-[#2dd4bf] flex items-center justify-center mb-4 group-hover:bg-[#2dd4bf]/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 accent-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="text-gray-400 font-medium group-hover:text-white">Add New Team</span>
                    </div>

                    <?php if (!empty($data['teams'])): ?>
                        <?php foreach ($data['teams'] as $team): ?>
                            <?php 
                                // Variabel fallback untuk fitur pin (bisa disambung ke database nanti)
                                $isPinned = !empty($team['is_pinned']); // Asumsi ada kolom is_pinned
                                $fillStyle = $isPinned ? '#ffffff' : 'none';
                                $strokeStyle = $isPinned ? '#ffffff' : '#4C515F';
                            ?>

                            <div class="card-bg rounded-2xl p-6 relative flex flex-col items-center justify-start min-h-[215px] max-w-[440px] w-full hover:shadow-xl hover:shadow-black/50 transition-all group hover:ring-2 hover:scale-[1.03] hover:ring-[#2dd4bf] cursor-pointer" onclick="window.location.href='/teams-detail?id=<?= $team['id'] ?>'">
                                
                                <div class="absolute top-4 right-4">
                                    <button class="text-gray-500 hover:text-white focus:outline-none transition-colors" onclick="toggleDropdown(event, <?= $team['id'] ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                        </svg>
                                    </button>

                                    <div id="dropdown-<?= $team['id'] ?>" class="hidden absolute right-0 mt-2 w-48 bg-[#2d3142] rounded-lg shadow-xl z-50 border border-gray-700 py-2 transform origin-top-right transition-all">
                                        <button onclick="viewAnggota(event)" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                                            <i class="fa-solid fa-users w-4 text-center"></i> View Anggota
                                        </button>
                                        
                                        <button onclick="bisukanTim(event)" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                                            <i class="fa-solid fa-bell-slash w-4 text-center"></i> Bisukan
                                        </button>

                                        <div class="h-px bg-gray-700 my-1"></div> 
                                        
                                        <form action="/teams/delete" method="POST" class="m-0 p-0" onsubmit="return confirmDelete(event)">
                                            <input type="hidden" name="id" value="<?= $team['id'] ?>">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 flex items-center gap-3 transition-colors">
                                                <i class="fa-solid fa-trash w-4 text-center"></i> Hapus Tim
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <img src="<?= $team['profile_img'] ?>" alt="team" class="w-20 h-20 rounded-xl object-cover mb-2 mt-2">
                                
                                <h3 class="font-bold text-lg text-white text-center leading-tight mt-0 mb-1"><?= htmlspecialchars($team['name']) ?></h3>
                                <p class="text-gray-400 text-sm text-center leading-snug mb-0"><?= htmlspecialchars($team['description']) ?></p>
                                
                                
                                <div class="absolute bottom-2 left-4">
                                    <button class="p-1 rounded-lg hover:bg-white/10 transition-all duration-200 group-pin" onclick="togglePin(event)">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="<?= $fillStyle ?>" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.56045 14.5928L3.01904 21.1342M5.03178 9.54589L14.2834 18.7975L15.9912 17.0896L15.5957 13.2785L21.1408 8.57575L15.2535 2.68848L10.5497 8.23358L6.7396 7.83808L5.03178 9.54589Z" stroke="<?= $strokeStyle ?>" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="pin-icon transition-colors duration-200"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </main>
    </div>

<script src="/js/tim.js?v=<?= time() ?>"></script>

</body>
</html>