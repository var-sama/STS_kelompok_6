<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Team Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Mengunci struktur Flexbox agar tidak dirusak oleh manipulasi JavaScript */
        .list-item { 
            display: flex !important; 
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center !important; 
            justify-content: space-between !important; 
        }

        .item-left { 
            display: flex !important; 
            flex-direction: row !important;
            align-items: center !important; 
        }

        /* State Dinamis yang Dikontrol & Dimanipulasi oleh JavaScript */
        .privacy-opt.selected { 
            border-color: #00ADB5; 
            background-color: #f0fdfd; 
        }
        .privacy-opt.selected .privacy-radio { 
            border-color: #00ADB5; 
        }
        .privacy-opt.selected .privacy-radio-dot { 
            display: block; 
        }

        /* Drag & Drop Styles Khusus Section */
        #section-list .list-item.dragging { 
            opacity: 1; 
            border: 2px solid #00ADB5; 
            background-color: #ffffff; 
            transform: scale(1.02); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12); 
            z-index: 50; 
        }
    </style>
</head>
<body class="bg-[#f6f7fb] flex h-screen font-sans overflow-hidden">
    
    <?php require_once '../app/views/components/navbar.php'?>
    
    <aside class="bg-[#1a1e2e] w-[320px] flex flex-col text-white shadow-2xl z-10 shrink-0">
        <div class="p-6">
            <button class="text-[#00ced1] font-semibold flex items-center gap-2 hover:opacity-80 mb-8 transition-all duration-200" onclick="window.location.href='/teams'">
                <i class="fa-solid fa-chevron-left text-sm"></i> Kembali
            </button>

            <div class="flex flex-col items-start gap-4">
                <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-lg border-2 border-gray-700 shrink-0">
                    <div id="sidebar-img-placeholder" class="flex items-center justify-center bg-[#2d3142] text-gray-500 w-full h-full">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    <img id="sidebar-team-img" src="" alt="Team Logo" class="object-cover w-full h-full hidden">
                </div>
                
                <div class="flex items-start justify-between w-full mt-2 gap-2">
                    <h1 id="sidebar-team-name" class="font-bold text-lg uppercase tracking-tight [display:-webkit-box]; [-webkit-line-clamp:2]; [-webkit-box-orient:vertical]; overflow-hidden flex-1 cursor-default text-gray-400" title="Nama Tim">
                        Nama Tim
                    </h1>
                </div>
            </div>
            
            <hr class="border-gray-800 mt-6">
        </div>

        <nav class="flex-1 mt-2 overflow-y-auto">
            <ul id="sidebar-menu"></ul>
        </nav>
    </aside>

    <form id="team-form" action="/teams-store" method="POST" enctype="multipart/form-data" autocomplete="off" class="flex-1 flex flex-col overflow-auto">
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b flex items-center px-8 shrink-0">
                <h2 class="text-gray-400 font-semibold text-sm tracking-widest uppercase">Buat Team Baru</h2>
            </header>

            <div class="flex-1 p-6 flex flex-col gap-4 overflow-y-auto">
                
                <div class="bg-white rounded-xl border-[0.5px] border-[#ddd] p-[22px_24px] w-full">
                    <div class="text-lg font-semibold text-[#222831] mb-1.5">Informasi Tim</div>
                    <div class="text-[13px] text-[#888] mb-4 pb-3.5 border-b-[0.5px] border-[#eee] leading-relaxed font-semibold">Isi detail dasar tim kamu. Nama tim akan tampil di halaman pencarian dan daftar tim, jadi pastikan mudah dikenali.</div>
                    
                    <div class="mb-4">
                        <label for="team-name-input" class="block text-[13px] font-semibold text-gray-600 mb-1.5">Nama Tim</label>
                        <input type="text" name="team_name" id="team-name-input" placeholder="Contoh: Tim Robotika XI TKJ 2" maxlength="100" 
                               class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[16px] font-semibold text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all duration-200" />
                    </div>

                    <div class="mb-0">
                        <label class="block text-[13px] font-semibold text-gray-600 mb-1.5">Deskripsi Tim <span class="text-gray-300 text-xs font-normal ml-1">(opsional)</span></label>
                        <textarea name="team_description" placeholder="Ceritakan sedikit tentang tim ini — tujuan, fokus, atau kegiatan yang dilakukan..." 
                                  class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[14px] text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all duration-200 min-h-[100px] resize-none"></textarea>
                    </div>
                </div>

                <div class="flex gap-4 w-full">
                    
                    <div class="bg-white rounded-xl border-[0.5px] border-[#ddd] p-[22px_24px] flex flex-col flex-1 min-w-0">
                        <div class="text-lg font-semibold text-[#222831] mb-1.5">Foto Tim</div>
                        <div class="text-[13px] text-[#888] mb-4 pb-3.5 border-b-[0.5px] border-[#eee] leading-relaxed font-semibold">Foto tim membantu anggota mengenali tim dengan mudah. Gunakan gambar representatif, min. 200×200px.</div>
                        
                        <input type="file" name="team_logo" id="team-photo-input" accept="image/png, image/jpeg" class="hidden" onchange="handlePhotoUpload(this)">
                        
                        <div class="border-[1.5px] border-dashed border-[#00ADB5] rounded-xl p-[40px_16px] flex flex-col items-center gap-2 cursor-pointer bg-[#f0fdfd] hover:bg-[#e0f7f8] transition-colors duration-200 flex-1 justify-center" onclick="document.getElementById('team-photo-input').click()">
                            <div class="w-11 h-11 rounded-full bg-[#e0f7f8] flex items-center justify-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ADB5" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                            <span class="text-[15px] text-[#00ADB5] font-semibold">Klik untuk upload foto tim</span>
                            <span id="photo-file-name" class="text-[13px] text-gray-400 font-semibold">Format PNG atau JPG, maks. 5MB</span>
                        </div>
                    </div>

                    <input type="hidden" name="privacy" id="privacy-value" value="public">
                    <div class="bg-white rounded-xl border-[0.5px] border-[#ddd] p-[22px_24px] flex-1 min-w-0">
                        <div class="text-lg font-semibold text-[#222831] mb-1.5">Privasi Tim</div>
                        <div class="text-[13px] text-[#888] mb-4 pb-3.5 border-b-[0.5px] border-[#eee] leading-relaxed font-semibold">Tentukan siapa saja yang bisa melihat dan bergabung ke tim ini.</div>
                        
                        <div class="privacy-opt border border-[#ddd] rounded-xl p-[13px_14px] cursor-pointer bg-[#f7f7f7] mb-2.5 flex items-start gap-2.5 transition-all duration-200 selected" onclick="selectPrivacy(this)">
                            <div class="privacy-radio w-[18px] h-[18px] rounded-full border-2 border-gray-300 shrink-0 mt-0.5 flex items-center justify-center">
                                <div class="privacy-radio-dot w-2.5 h-2.5 rounded-full bg-[#00ADB5] hidden"></div>
                            </div>
                            <div>
                                <div class="text-[15px] font-semibold text-[#222831]">Publik</div>
                                <div class="text-[13px] text-[#888] mt-0.5">Semua orang bisa melihat dan bergabung secara bebas</div>
                            </div>
                        </div>
                        
                        <div class="privacy-opt border border-[#ddd] rounded-xl p-[13px_14px] cursor-pointer bg-[#f7f7f7] flex items-start gap-2.5 transition-all duration-200" onclick="selectPrivacy(this)">
                            <div class="privacy-radio w-[18px] h-[18px] rounded-full border-2 border-gray-300 shrink-0 mt-0.5 flex items-center justify-center">
                                <div class="privacy-radio-dot w-2.5 h-2.5 rounded-full bg-[#00ADB5] hidden"></div>
                            </div>
                            <div>
                                <div class="text-[15px] font-semibold text-[#222831]">Privat</div>
                                <div class="text-[13px] text-[#888] mt-0.5">Hanya bisa bergabung melalui undangan anggota tim</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border-[0.5px] border-[#ddd] p-[22px_24px] w-full">
                    <div class="text-lg font-semibold text-[#222831] mb-1.5">Section Tim</div>
                    <div class="text-[13px] text-[#888] mb-4 pb-3.5 border-b-[0.5px] border-[#eee] leading-relaxed font-semibold">Section adalah kategori konten di dalam tim. Kamu bisa <strong>klik dan geser (drag)</strong> untuk mengatur urutannya.</div>
                    
                    <div class="flex flex-col gap-2 mb-3 list-none p-0 m-0" id="section-list">
                        <div class="list-item p-[12px_14px] bg-[#f7f7f7] rounded-xl border border-[#eee] w-full transition-all duration-200 cursor-grab active:cursor-grabbing" data-value="Lomen" draggable="true">
                            <div class="item-left gap-3 flex-1 min-w-0 pointer-events-none">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#00ced1] shrink-0"></div>
                                <span class="item-text section-name text-[15px] text-[#222831] flex-1 whitespace-nowrap overflow-hidden text-ellipsis font-semibold">Lomen</span>
                            </div>
                            <button type="button" class="w-[26px] h-[26px] rounded-full bg-[#ffe4e4] hover:bg-[#fecaca] cursor-pointer flex items-center justify-center text-lg text-red-600 shrink-0 transition-colors duration-200 ml-2.5 leading-none" onclick="removeSection(this)">×</button>
                        </div>
                        <div class="list-item p-[12px_14px] bg-[#f7f7f7] rounded-xl border border-[#eee] w-full transition-all duration-200 cursor-grab active:cursor-grabbing" data-value="Anggota" draggable="true">
                            <div class="item-left gap-3 flex-1 min-w-0 pointer-events-none">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#00ced1] shrink-0"></div>
                                <span class="item-text section-name text-[15px] text-[#222831] flex-1 whitespace-nowrap overflow-hidden text-ellipsis font-semibold">Anggota</span>
                            </div>
                            <button type="button" class="w-[26px] h-[26px] rounded-full bg-[#ffe4e4] hover:bg-[#fecaca] cursor-pointer flex items-center justify-center text-lg text-red-600 shrink-0 transition-colors duration-200 ml-2.5 leading-none" onclick="removeSection(this)">×</button>
                        </div>
                        <div class="list-item p-[12px_14px] bg-[#f7f7f7] rounded-xl border border-[#eee] w-full transition-all duration-200 cursor-grab active:cursor-grabbing" data-value="Pengumuman" draggable="true">
                            <div class="item-left gap-3 flex-1 min-w-0 pointer-events-none">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#00ced1] shrink-0"></div>
                                <span class="item-text section-name text-[15px] text-[#222831] flex-1 whitespace-nowrap overflow-hidden text-ellipsis font-semibold">Pengumuman</span>
                            </div>
                            <button type="button" class="w-[26px] h-[26px] rounded-full bg-[#ffe4e4] hover:bg-[#fecaca] cursor-pointer flex items-center justify-center text-lg text-red-600 shrink-0 transition-colors duration-200 ml-2.5 leading-none" onclick="removeSection(this)">×</button>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <input type="text" id="sec-input" placeholder="Nama section baru..." maxlength="30" 
                            onkeydown="if(event.key === 'Enter') { event.preventDefault(); addSection(); }" 
                            class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all duration-200" />
                        <button type="button" class="bg-[#00ADB5] hover:bg-[#008c94] text-white rounded-lg p-[10px_18px] text-[15px] cursor-pointer whitespace-nowrap font-medium transition-colors duration-200" onclick="addSection()">+ Tambah Section</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border-[0.5px] border-[#ddd] p-[22px_24px] w-full">
                    <div class="text-lg font-semibold text-[#222831] mb-1.5">Undang Anggota</div>
                    <div class="text-[13px] text-[#888] mb-4 pb-3.5 border-b-[0.5px] border-[#eee] leading-relaxed font-semibold">Cari dan undang teman menggunakan username atau email. Mereka akan mendapat notifikasi.</div>
                    
                    <div class="flex flex-col gap-2 mb-3 list-none p-0 m-0" id="member-list">
                        <div class="list-item p-[12px_14px] bg-[#f7f7f7] rounded-xl border border-[#eee] w-full transition-all duration-200">
                            <div class="item-left gap-3 flex-1 min-w-0 pointer-events-none">
                                <div class="w-8 h-8 rounded-full bg-[#1a1e2e] flex items-center justify-center text-xs text-[#00ced1] font-bold shrink-0 uppercase">GP</div>
                                <span class="item-text text-[15px] text-[#222831] flex-1 whitespace-nowrap overflow-hidden text-ellipsis font-semibold">GPU</span>
                            </div>
                            <button type="button" class="w-[26px] h-[26px] rounded-full bg-[#ffe4e4] hover:bg-[#fecaca] cursor-pointer flex items-center justify-center text-lg text-red-600 shrink-0 transition-colors duration-200 ml-2.5 leading-none" onclick="this.closest('.list-item').remove()">×</button>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <input type="text" id="member-input" placeholder="Cari username atau email..." onkeypress="handleMemberInputKey(event)" 
                               class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all duration-200" />
                        <button class="bg-[#00ADB5] hover:bg-[#008c94] text-white rounded-lg p-[10px_18px] text-[15px] cursor-pointer whitespace-nowrap font-medium transition-colors duration-200" onclick="addMember()">Undang</button>
                    </div>
                </div>

                <div class="flex gap-3 mt-2 pb-4">
                    <button type="button" class="flex-1 bg-transparent border-2 border-[#00ADB5] hover:bg-[#f0fdfd] rounded-lg p-3.5 text-base text-[#00ADB5] cursor-pointer font-semibold transition-all duration-200" onclick="window.location.href='/teams'">Batal</button>
                    <button type="submit" class="flex-1 bg-[#00ADB5] hover:bg-[#008c94] rounded-lg p-3.5 text-base text-white font-semibold cursor-pointer transition-colors duration-200">Buat Tim</button>
                </div>
            </div>
        </main>
    </form>

    <script src="/js/createteams.js"></script>
</body>
</html>