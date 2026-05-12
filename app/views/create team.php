<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Team Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/createtim.css">

      
</head>
<body class="bg-[#f6f7fb] flex h-screen font-sans">
    <?php require_once '../app/views/components/navbar.php'?>
    
    <aside class="bg-sidebar w-[320px] flex flex-col text-white shadow-2xl z-10 shrink-0">
        <div class="p-6">
            <button class="text-teal-custom font-semibold flex items-center gap-2 hover:opacity-80 mb-8 transition-all" onclick="window.location.href='/teams'">
                <i class="fa-solid fa-chevron-left text-sm"></i> Kembali
            </button>

            <div class="flex flex-col items-start gap-4">
                <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-lg border-2 border-gray-700 shrink-0">
                    <div id="sidebar-img-placeholder" class="sidebar-placeholder w-full h-full">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    <img id="sidebar-team-img" src="" alt="Team Logo" class="object-cover w-full h-full hidden">
                </div>
                
                <div class="flex items-start justify-between w-full mt-2 gap-2">
                    <h1 id="sidebar-team-name" class="font-bold text-lg uppercase tracking-tight line-clamp-2 flex-1 cursor-default text-gray-400" title="Nama Tim">
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
            <h2 class="text-gray-400 font-medium text-sm tracking-widest uppercase">Buat Team Baru</h2>
        </header>

        <div class="content">
            <div class="card">
                <div class="card-title">Informasi Tim</div>
                <div class="card-desc">Isi detail dasar tim kamu. Nama tim akan tampil di halaman pencarian dan daftar tim, jadi pastikan mudah dikenali.</div>
                
                <div class="field-group">
                    <label for="team-name-input">Nama Tim</label>
                    <input type="text" name="team_name" id="team-name-input" placeholder="Contoh: Tim Robotika XI TKJ 2" maxlength="100" 
                           class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[16px] font-semibold text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all" />
                </div>

                <div class="field-group">
                    <label>Deskripsi Tim <span class="optional">(opsional)</span></label>
                    <textarea name="team_description" placeholder="Ceritakan sedikit tentang tim ini — tujuan, fokus, atau kegiatan yang dilakukan..." 
                              class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[14px] text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all min-h-[100px] resize-none"></textarea>
                </div>
            </div>

            <div class="side-by-side">
                <div class="card flex flex-col">
                    <div class="card-title">Foto Tim</div>
                    <div class="card-desc">Foto tim membantu anggota mengenali tim dengan mudah. Gunakan gambar representatif, min. 200×200px.</div>
                    
                    <input type="file" name="team_logo" id="team-photo-input" accept="image/png, image/jpeg" class="hidden" onchange="handlePhotoUpload(this)">
                    
                    <div class="photo-upload flex-1" onclick="document.getElementById('team-photo-input').click()">
                        <div class="photo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ADB5" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        <span class="photo-label">Klik untuk upload foto tim</span>
                        <span id="photo-file-name" class="photo-sub">Format PNG atau JPG, maks. 5MB</span>
                    </div>
                </div>

                <input type="hidden" name="privacy" id="privacy-value" value="public">
                <div class="card">
                    <div class="card-title">Privasi Tim</div>
                    <div class="card-desc">Tentukan siapa saja yang bisa melihat dan bergabung ke tim ini.</div>
                    <div class="privacy-opt selected" onclick="selectPrivacy(this)">
                        <div class="privacy-radio"><div class="privacy-radio-dot"></div></div>
                        <div>
                            <div class="privacy-opt-title">Publik</div>
                            <div class="privacy-opt-sub">Semua orang bisa melihat dan bergabung secara bebas</div>
                        </div>
                    </div>
                    <div class="privacy-opt" onclick="selectPrivacy(this)">
                        <div class="privacy-radio"><div class="privacy-radio-dot"></div></div>
                        <div>
                            <div class="privacy-opt-title">Privat</div>
                            <div class="privacy-opt-sub">Hanya bisa bergabung melalui undangan anggota tim</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Section Tim</div>
                <div class="card-desc">Section adalah kategori konten di dalam tim. Kamu bisa <strong>klik dan geser (drag)</strong> untuk mengatur urutannya.</div>
                
                <div class="dynamic-list" id="section-list">
                    <div class="list-item" data-value="Lomen" draggable="true">
                        <div class="item-left"><div class="section-dot"></div><span class="item-text section-name">Lomen</span></div>
                        <button type="button" class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                    <div class="list-item" data-value="Anggota" draggable="true">
                        <div class="item-left"><div class="section-dot"></div><span class="item-text section-name">Anggota</span></div>
                        <button type="button" class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                    <div class="list-item" data-value="Pengumuman" draggable="true">
                        <div class="item-left"><div class="section-dot"></div><span class="item-text section-name">Pengumuman</span></div>
                        <button type="button" class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                </div>
                
                <div class="add-row">
                    <input type="text" id="sec-input" placeholder="Nama section baru..." maxlength="30" 
                        onkeydown="if(event.key === 'Enter') { event.preventDefault(); addSection(); }" 
                        class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all" />
                    <button type="button" class="btn-add" onclick="addSection()">+ Tambah Section</button>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Undang Anggota</div>
                <div class="card-desc">Cari dan undang teman menggunakan username atau email. Mereka akan mendapat notifikasi.</div>
                <div class="dynamic-list" id="member-list">
                    <div class="list-item">
                        <div class="item-left">
                            <div class="member-avatar">GP</div>
                            <span class="item-text">GPU</span>
                        </div>
                        <button type="button" class="btn-remove-item" onclick="this.closest('.list-item').remove()">×</button>
                    </div>
                </div>
                <div class="add-row">
                    <input type="text" id="member-input" placeholder="Cari username atau email..." onkeypress="handleMemberInputKey(event)" 
                           class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all" />
                    <button class="btn-add" onclick="addMember()">Undang</button>
                </div>
            </div>

            <div class="action-row pb-4">
                <button type="button" class="btn-cancel" onclick="window.location.href='/teams'">Batal</button>
                <button type="submit" class="btn-submit">Buat Tim</button>
            </div>
        </div>
    </main>
</form>
    <script src="/js/createteams.js"></script>
</body>
</html>