<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Feed UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f6f7fb; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        .bg-sidebar { background-color: #1a1e2e; }
        .bg-action-bar { background-color: #2d3142; }
        .text-teal-custom { color: #00ced1; }
        
        .post-bottom button {
            background: none;
            color: #eeeeee;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .post-bottom button:hover {
            color: #00ADB5;
        }

        .icomment { 
            fill: currentColor; 
            vertical-align: middle; 
        }
        
        iconify-icon { 
            font-size: 20px; 
            vertical-align: middle; 
        }

        .text-gray-800,
        .user h3,
        .post-bottom .tags span,
        header h2 {
            font-weight: 600;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-[#f6f7fb] flex h-screen font-sans overflow-hidden">
    <?php require_once '../app/views/components/navbar.php'?>
    <aside class="bg-sidebar w-[320px] flex flex-col text-white shadow-2xl z-10">
        
        <div class="p-6">
            <button class="text-teal-custom font-semibold flex items-center gap-2 hover:opacity-60 mb-8 transition-all" onclick="window.location.href='/teams'">
                <i class="fa-solid fa-chevron-left text-sm"></i> Kembali
            </button>

            <div class="flex flex-col items-start gap-4">
                <div class="w-32 h-32 bg-gray-600 rounded-2xl overflow-hidden shadow-lg border-2 border-gray-700 shrink-0">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlc8TSQCHIvj_WCrt6IlD_KAdYKnrIEfSNpw79w25_hQ&s&ec=121657058" alt="Team Logo" class="object-cover w-full h-full">
                </div>
                
                <div class="flex items-start justify-between w-full mt-2 gap-2">
    <h1 class="font-bold text-lg uppercase tracking-tight line-clamp-2 flex-1 cursor-default" 
        title="Kei chan imut parah ga ada lawan di dunia melebihi semesta">
        Kei chan imut parah ga ada lawan di dunia melebihi semesta
    </h1>
    
    <div class="relative inline-block text-left">
        <button id="optionsBtn" class="text-gray-500 hover:text-white shrink-0 mt-1 focus:outline-none transition-colors">
            <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
        </button>

        <div id="optionsDropdown" class="hidden absolute right-0 mt-2 w-48 bg-[#2d3142] rounded-lg shadow-xl z-50 border border-gray-700 py-2 transform origin-top-right transition-all">
            <a href="/view-anggota" class="px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                <i class="fa-solid fa-users w-4 text-center"></i> View Anggota
            </a>
            
            <button onclick="bisukanTim()" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-3 transition-colors">
                <i class="fa-solid fa-bell-slash w-4 text-center"></i> Bisukan
            </button>

            <div class="h-px bg-gray-700 my-1"></div> <button onclick="hapusTim()" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 flex items-center gap-3 transition-colors">
                <i class="fa-solid fa-trash w-4 text-center"></i> Hapus Tim
            </button>
        </div>
    </div>
</div>
            </div>
            
            <hr class="border-gray-800 mt-6">
        </div>

        <nav class="flex-1 mt-2">
            <ul id="team-sections">
            </ul>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b flex items-center px-8 shrink-0">
            <h2 class="text-gray-400 font-medium text-sm tracking-widest uppercase">Feed Post</h2>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto transition-all duration-200 hover:scale-[1.03] hover:shadow-md cursor-pointer" onclick="window.location.href='/detail'">
                
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold">
                            GPU
                        </div>
                        <div class="user">
                            <h3 class="font-bold text-black text-lg leading-tight">GPU</h3>
                            <span class="text-gray-500 text-sm">XI TKJ 2</span>
                        </div>
                    </div>

                    <div class="text-gray-800 leading-relaxed mb-4">
                        Masalah pertama: browser error saat runtime.
                    </div>
                </div>

                <div class="post-bottom bg-action-bar px-6 py-4 flex flex-wrap items-center justify-between gap-y-3 gap-x-6 text-white">
                    <div class="actions flex flex-wrap items-center gap-4 font-bold">
                        <span class="text-[13px]">
                            <button onclick="event.stopPropagation()"><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button>
                        </span>
                        <span class="text-[13px]">
                            <button onclick="event.stopPropagation()"><iconify-icon icon="mdi:share"></iconify-icon>Share</button>
                        </span>
                        <span class="text-[13px]">
                            <button onclick="event.stopPropagation()"><iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>Bookmark</button>
                        </span>
                        <span class="text-[13px]">
                            <button onclick="event.stopPropagation()">
                                <svg class="icomment" width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0015 1.09881e-07C8.10862 -0.000280442 6.25454 0.536679 4.65477 1.54846C3.05501 2.56025 1.77526 4.0053 0.964284 5.71564C0.153311 7.42599 -0.155579 9.33138 0.0735211 11.2103C0.302621 13.0893 1.0603 14.8646 2.25849 16.33L0.294488 18.293C0.154679 18.4329 0.0594721 18.611 0.0209045 18.805C-0.017663 18.9989 0.00214001 19.2 0.07781 19.3827C0.15348 19.5654 0.28162 19.7215 0.446029 19.8314C0.610439 19.9413 0.803738 20 1.00149 20H10.0015C12.6537 20 15.1972 18.9464 17.0726 17.0711C18.9479 15.1957 20.0015 12.6522 20.0015 10C20.0015 7.34784 18.9479 4.8043 17.0726 2.92893C15.1972 1.05357 12.6537 1.09881e-07 10.0015 1.09881e-07ZM7.00149 5H13.0015C13.2667 5 13.5211 5.10536 13.7086 5.29289C13.8961 5.48043 14.0015 5.73478 14.0015 6C14.0015 6.26522 13.8961 6.51957 13.7086 6.70711C13.5211 6.89464 13.2667 7 13.0015 7H7.00149C6.73627 7 6.48192 6.89464 6.29438 6.70711C6.10685 6.51957 6.00149 6.26522 6.00149 6C6.00149 5.73478 6.10685 5.48043 6.29438 5.29289C6.48192 5.10536 6.73627 5 7.00149 5ZM13.0015 15H7.00149C6.73627 15 6.48192 14.8946 6.29438 14.7071C6.10685 14.5196 6.00149 14.2652 6.00149 14C6.00149 13.7348 6.10685 13.4804 6.29438 13.2929C6.48192 13.1054 6.73627 13 7.00149 13H13.0015C13.2667 13 13.5211 13.1054 13.7086 13.2929C13.8961 13.4804 14.0015 13.7348 14.0015 14C14.0015 14.2652 13.8961 14.5196 13.7086 14.7071C13.5211 14.8946 13.2667 15 13.0015 15ZM15.0015 11H5.00149C4.73627 11 4.48192 10.8946 4.29438 10.7071C4.10685 10.5196 4.00149 10.2652 4.00149 10C4.00149 9.73478 4.10685 9.48043 4.29438 9.29289C4.48192 9.10536 4.73627 9 5.00149 9H15.0015C15.2667 9 15.5211 9.10536 15.7086 9.29289C15.8961 9.48043 16.0015 9.73478 16.0015 10C16.0015 10.2652 15.8961 10.5196 15.7086 10.7071C15.5211 10.8946 15.2667 11 15.0015 11Z" fill="currentColor"/>
                                </svg>Comment
                            </button>
                        </span>
                    </div>
                    <div class="tags flex flex-wrap gap-2 items-center">
                        <span class="tag bg-[#19b3b3] px-2 py-1 rounded-full text-[12px]">IPA</span>
                        <span class="tag bg-[#19b3b3] px-2 py-1 rounded-full text-[12px]">XI TKJ 2</span>
                        <span class="views text-[12px] italic opacity-70">February 30th, 2067</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

<script src="js/detailtim.js"></script>
</body>
</html>