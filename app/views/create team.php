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
        /* Base styles */
        body { overflow: hidden; background-color: #f6f7fb; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        .bg-sidebar { background-color: #1a1e2e; }
        .text-teal-custom { color: #00ced1; }
        
        /* Custom styles for create team layout */
        .content { flex: 1; padding: 24px; display: flex; flex-direction: column; gap: 16px; overflow-y: auto; }
        
        .card { background: white; border-radius: 12px; border: 0.5px solid #ddd; padding: 22px 24px; width: 100%; }
        .card-title { font-size: 18px; font-weight: 600; color: #222831; margin-bottom: 6px; }
        .card-desc { font-size: 13px; color: #888; margin-bottom: 16px; padding-bottom: 14px; border-bottom: 0.5px solid #eee; line-height: 1.6; font-weight: 600; }
        label, .item-text, .privacy-opt-title, h2 { font-weight: 600; }
        
        .side-by-side { display: flex; gap: 16px; width: 100%; }
        .side-by-side .card { flex: 1; min-width: 0; }
        label { font-size: 13px; font-weight: 500; color: #555; display: block; margin-bottom: 6px; }
        .optional { color: #bbb; font-size: 12px; font-weight: 400; margin-left: 4px; }
        
        /* Photo Upload area */
        .photo-upload { border: 1.5px dashed #00ADB5; border-radius: 10px; padding: 40px 16px; display: flex; flex-direction: column; align-items: center; gap: 8px; cursor: pointer; background: #f0fdfd; transition: background 0.2s; }
        .photo-upload:hover { background: #e0f7f8; }
        .photo-icon { width: 44px; height: 44px; border-radius: 50%; background: #e0f7f8; display: flex; align-items: center; justify-content: center; }
        .photo-label { font-size: 15px; color: #00ADB5; font-weight: 600; }
        .photo-sub { font-size: 13px; color: #aaa; font-weight: 600; }
        
        /* Privacy Options */
        .privacy-opt { border: 0.5px solid #ddd; border-radius: 10px; padding: 13px 14px; cursor: pointer; background: #f7f7f7; margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px; transition: all 0.2s; }
        .privacy-opt:last-child { margin-bottom: 0; }
        .privacy-opt.selected { border-color: #00ADB5; background: #f0fdfd; }
        .privacy-radio { width: 18px; height: 18px; border-radius: 50%; border: 2px solid #ccc; flex-shrink: 0; margin-top: 2px; display: flex; align-items: center; justify-content: center; }
        .privacy-opt.selected .privacy-radio { border-color: #00ADB5; }
        .privacy-radio-dot { width: 10px; height: 10px; border-radius: 50%; background: #00ADB5; display: none; }
        .privacy-opt.selected .privacy-radio-dot { display: block; }
        .privacy-opt-title { font-size: 15px; font-weight: 600; color: #222831; }
        .privacy-opt-sub { font-size: 13px; color: #888; margin-top: 3px; }
        
        /* Dynamic Lists (Section & Member) */
        .dynamic-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 12px; list-style: none; padding: 0; margin-left: 0; }
        
        .list-item { 
            display: flex !important; 
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            align-items: center; 
            justify-content: space-between; 
            padding: 12px 14px; 
            background: #f7f7f7; 
            border-radius: 10px; 
            border: 1px solid #eee; 
            width: 100%; 
            /* Tambahkan transisi halus untuk saat diangkat/dilepas */
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }
        
        .item-left { 
            display: flex !important; 
            flex-direction: row !important;
            align-items: center; 
            gap: 12px; 
            flex: 1; 
            min-width: 0;
            pointer-events: none;
        }
        
        .item-text { font-size: 15px; color: #222831; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500; }
        
        .section-dot { width: 10px; height: 10px; border-radius: 50%; background: #00ced1; flex-shrink: 0; }
        .member-avatar { width: 32px; height: 32px; border-radius: 50%; background: #1a1e2e; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #00ced1; font-weight: bold; flex-shrink: 0; text-transform: uppercase; }
        
        /* Drag & Drop Styles Khusus Section */
        #section-list .list-item { cursor: grab; }
        #section-list .list-item:active { cursor: grabbing; }
        #section-list .list-item.dragging { 
            opacity: 1; /* Opacity 100% / tidak pudar */
            border: 2px solid #00ADB5; 
            background: #ffffff; 
            transform: scale(1.02); /* Sedikit membesar agar terlihat keangkat */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12); /* Bayangan saat diangkat */
            z-index: 50; /* Pastikan berada paling atas */
        }

        /* X Button */
        .btn-remove-item { 
            width: 26px; 
            height: 26px; 
            border-radius: 50%; 
            background: #ffe4e4; 
            border: none; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 18px; 
            color: #dc2626; 
            flex-shrink: 0; 
            transition: background 0.2s; 
            margin-left: 10px; 
            line-height: 0; 
        }
        
        .btn-remove-item:hover { background: #fecaca; }

        /* Buttons & Actions */
        .add-row { display: flex; gap: 8px; }
        .btn-add { background: #00ADB5; color: white; border: none; border-radius: 8px; padding: 10px 18px; font-size: 15px; font-family: inherit; cursor: pointer; white-space: nowrap; font-weight: 500; transition: background 0.2s; }
        .btn-add:hover { background: #008c94; }
        
        .action-row { display: flex; gap: 12px; margin-top: 8px; }
        .btn-cancel { flex: 1; background: transparent; border: 1.5px solid #00ADB5; border-radius: 8px; padding: 14px; font-size: 16px; color: #00ADB5; cursor: pointer; font-family: inherit; font-weight: 600; transition: all 0.2s; }
        .btn-cancel:hover { background: #f0fdfd; }
        .btn-submit { flex: 1; background: #00ADB5; border: none; border-radius: 8px; padding: 14px; font-size: 16px; color: white; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.2s; }
        .btn-submit:hover { background: #008c94; }
        
        .field-group { margin-bottom: 16px; }
        .field-group:last-child { margin-bottom: 0; }
        
        /* Utilities */
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .sidebar-placeholder { display: flex; align-items: center; justify-content: center; background-color: #2d3142; color: #4b5563; }
    </style>
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
                    <input type="text" id="team-name-input" placeholder="Contoh: Tim Robotika XI TKJ 2" maxlength="100" 
                           class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[16px] font-semibold text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all" />
                </div>

                <div class="field-group">
                    <label>Deskripsi Tim <span class="optional">(opsional)</span></label>
                    <textarea placeholder="Ceritakan sedikit tentang tim ini — tujuan, fokus, atau kegiatan yang dilakukan..." 
                              class="w-full bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-3 text-[14px] text-[#222831] focus:outline-none focus:border-[#00ADB5] focus:bg-[#f0fdfd] transition-all min-h-[100px] resize-none"></textarea>
                </div>
            </div>

            <div class="side-by-side">
                <div class="card flex flex-col">
                    <div class="card-title">Foto Tim</div>
                    <div class="card-desc">Foto tim membantu anggota mengenali tim dengan mudah. Gunakan gambar representatif, min. 200×200px.</div>
                    
                    <input type="file" id="team-photo-input" accept="image/png, image/jpeg" class="hidden" onchange="handlePhotoUpload(this)">
                    
                    <div class="photo-upload flex-1" onclick="document.getElementById('team-photo-input').click()">
                        <div class="photo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ADB5" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        <span class="photo-label">Klik untuk upload foto tim</span>
                        <span id="photo-file-name" class="photo-sub">Format PNG atau JPG, maks. 5MB</span>
                    </div>
                </div>

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
                        <button class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                    <div class="list-item" data-value="Anggota" draggable="true">
                        <div class="item-left"><div class="section-dot"></div><span class="item-text section-name">Anggota</span></div>
                        <button class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                    <div class="list-item" data-value="Pengumuman" draggable="true">
                        <div class="item-left"><div class="section-dot"></div><span class="item-text section-name">Pengumuman</span></div>
                        <button class="btn-remove-item" onclick="removeSection(this)">×</button>
                    </div>
                </div>
                
                <div class="add-row">
                    <input type="text" id="sec-input" placeholder="Nama section baru..." maxlength="30" onkeypress="handleSectionInputKey(event)" 
                           class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all" />
                    <button class="btn-add" onclick="addSection()">+ Tambah Section</button>
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
                        <button class="btn-remove-item" onclick="this.closest('.list-item').remove()">×</button>
                    </div>
                </div>
                <div class="add-row">
                    <input type="text" id="member-input" placeholder="Cari username atau email..." onkeypress="handleMemberInputKey(event)" 
                           class="flex-1 bg-[#f7f7f7] border border-[#ddd] rounded-lg px-4 py-2 text-[15px] text-[#222831] focus:outline-none focus:border-[#00ADB5] transition-all" />
                    <button class="btn-add" onclick="addMember()">Undang</button>
                </div>
            </div>

            <div class="action-row pb-4">
                <button class="btn-cancel" onclick="window.location.href='/teams'">Batal</button>
                <button class="btn-submit">Buat Tim</button>
            </div>
        </div>
    </main>

<script>
    const teamNameInput = document.getElementById('team-name-input');
    const sidebarTeamName = document.getElementById('sidebar-team-name');

    teamNameInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value) {
            sidebarTeamName.textContent = value;
            sidebarTeamName.classList.remove('text-gray-400');
            sidebarTeamName.classList.add('text-white');
        } else {
            sidebarTeamName.textContent = "Nama Tim";
            sidebarTeamName.classList.remove('text-white');
            sidebarTeamName.classList.add('text-gray-400');
        }
    });

    function handlePhotoUpload(input) {
        const fileNameLabel = document.getElementById('photo-file-name');
        const sidebarImg = document.getElementById('sidebar-team-img');
        const sidebarPlaceholder = document.getElementById('sidebar-img-placeholder');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            if(!file.type.startsWith('image/')) {
                alert('Silakan upload file gambar (PNG atau JPG)');
                input.value = '';
                return;
            }

            if(file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5MB');
                input.value = '';
                return;
            }

            fileNameLabel.textContent = file.name;
            fileNameLabel.classList.add('text-teal-custom');

            const reader = new FileReader();
            reader.onload = function(e) {
                sidebarImg.src = e.target.result;
                sidebarImg.classList.remove('hidden');
                sidebarPlaceholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    const sidebarMenu = document.getElementById('sidebar-menu');
    const sectionList = document.getElementById('section-list');

    function updateSidebarMenu() {
        sidebarMenu.innerHTML = '';
        const sections = sectionList.querySelectorAll('.list-item');

        sections.forEach((section, index) => {
            const sectionName = section.querySelector('.section-name').textContent;
            const li = document.createElement('li');
            li.className = "flex items-center h-14 hover:bg-gray-800/20 cursor-pointer transition-all duration-150 group";
            
            let activeIndicator = '';
            let textClass = 'text-gray-400 group-hover:text-white';
            
            if (index === 0) {
                li.classList.add('bg-gray-800/40', 'relative');
                activeIndicator = '<div class="absolute left-0 top-0 bottom-0 w-1 bg-[#00ced1]"></div>';
                textClass = 'text-teal-custom font-bold';
            }

            li.innerHTML = `
                ${activeIndicator}
                <span class="pl-8 text-sm ${textClass}">${sectionName}</span>
            `;
            sidebarMenu.appendChild(li);
        });
    }

    // --- FITUR DRAG AND DROP SECTION START ---
    sectionList.addEventListener('dragstart', e => {
        if (e.target.classList.contains('list-item')) {
            // Tambahkan timeout kecil supaya elemen aslinya tetap dapet efek class dragging
            setTimeout(() => {
                e.target.classList.add('dragging');
            }, 0);
        }
    });

    sectionList.addEventListener('dragend', e => {
        if (e.target.classList.contains('list-item')) {
            e.target.classList.remove('dragging');
            updateSidebarMenu();
        }
    });

    sectionList.addEventListener('dragover', e => {
        e.preventDefault();
        const afterElement = getDragAfterElement(sectionList, e.clientY);
        const draggable = document.querySelector('.dragging');
        if (draggable) {
            if (afterElement == null) {
                sectionList.appendChild(draggable);
            } else {
                sectionList.insertBefore(draggable, afterElement);
            }
        }
    });

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.list-item:not(.dragging)')];

        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
    // --- FITUR DRAG AND DROP SECTION END ---

    const secInput = document.getElementById('sec-input');

    function handleSectionInputKey(e) {
        if (e.key === 'Enter') { addSection(); }
    }

    function addSection() {
        const val = secInput.value.trim();
        if (!val) return;

        let isDuplicate = false;
        sectionList.querySelectorAll('.section-name').forEach(el => {
            if(el.textContent.toLowerCase() === val.toLowerCase()) isDuplicate = true;
        });
        if(isDuplicate) { alert('Nama section sudah ada.'); return; }

        const item = document.createElement('div');
        item.className = 'list-item';
        item.setAttribute('draggable', 'true');
        
        item.innerHTML = `
            <div class="item-left">
                <div class="section-dot"></div>
                <span class="item-text section-name">${val}</span>
            </div>
            <button class="btn-remove-item" onclick="removeSection(this)">×</button>
        `;
        
        sectionList.appendChild(item);
        secInput.value = '';
        secInput.focus();
        
        updateSidebarMenu();
    }

    function removeSection(btn) {
        if(sectionList.querySelectorAll('.list-item').length <= 1) {
            alert('Tim harus memiliki setidaknya satu section.');
            return;
        }
        btn.closest('.list-item').remove();
        updateSidebarMenu();
    }

    const memberInput = document.getElementById('member-input');
    const memberList = document.getElementById('member-list');

    function handleMemberInputKey(e) {
        if (e.key === 'Enter') { addMember(); }
    }

    function addMember() {
        const val = memberInput.value.trim();
        if (!val) return;

        const initials = val.substring(0, 2);
        const item = document.createElement('div');
        item.className = 'list-item';
        
        item.innerHTML = `
            <div class="item-left">
                <div class="member-avatar">${initials}</div>
                <span class="item-text" title="${val}">${val}</span>
            </div>
            <button class="btn-remove-item" onclick="this.closest('.list-item').remove()">×</button>
        `;
        
        memberList.appendChild(item);
        memberInput.value = '';
        memberInput.focus();
    }

    function selectPrivacy(el) {
        document.querySelectorAll('.privacy-opt').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
    }

    document.addEventListener('DOMContentLoaded', updateSidebarMenu);

    // --- FITUR SUBMIT BUAT TIM ---
    const btnSubmit = document.querySelector('.btn-submit');

    btnSubmit.addEventListener('click', function() {
        const teamName = teamNameInput.value.trim();
        const teamDesc = document.querySelector('textarea').value.trim();

        // 1. Validasi: Nama tim wajib diisi
        if (!teamName) {
            alert('Nama tim wajib diisi!');
            teamNameInput.focus();
            return;
        }

        // 2. Ambil Foto (Base64 dari sidebar jika ada)
        const sidebarImg = document.getElementById('sidebar-team-img');
        const teamImage = !sidebarImg.classList.contains('hidden') ? sidebarImg.src : '';

        // 3. Ambil Privasi
        const isPublic = document.querySelectorAll('.privacy-opt')[0].classList.contains('selected');
        const privacyText = isPublic ? 'Publik' : 'Privat';

        // 4. Ambil Data Section
        const sections = Array.from(document.querySelectorAll('#section-list .section-name'))
                              .map(el => el.textContent.trim());

        // 5. Ambil Data Anggota
        const members = Array.from(document.querySelectorAll('#member-list .item-text'))
                             .map(el => el.textContent.trim());

        // 6. Rangkai menjadi Object Tim
        const newTeam = {
            id: Date.now(), // Generate ID unik berdasarkan waktu
            name: teamName,
            description: teamDesc,
            image: teamImage,
            membersCount: members.length + 1, // +1 dengan kamu sebagai pembuat
            isPublic: isPublic,
            isMuted: false
        };

        // 7. Simpan ke LocalStorage
        // Ambil data tim yang sudah ada sebelumnya (jika ada), lalu tambahkan yang baru
        let savedTeams = JSON.parse(localStorage.getItem('myCustomTeams')) || [];
        savedTeams.push(newTeam);
        localStorage.setItem('myCustomTeams', JSON.stringify(savedTeams));

        // 8. Beri notifikasi dan alihkan ke halaman Teams
        alert('Tim berhasil dibuat!');
        window.location.href = '/teams'; // Pastikan URL ini sesuai dengan rute ke file teams.php kamu
    });
</script>

</body>
</html>