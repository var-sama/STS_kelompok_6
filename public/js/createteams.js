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
                // Tambah timeout kecil supaya elemen aslinya tetap dapet efek class dragging
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
                isMuted: false,

                sections: sections
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
        