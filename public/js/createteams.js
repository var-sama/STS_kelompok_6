// 1. Deklarasi Elemen (Di paling atas biar semua fungsi bisa akses)
const teamNameInput = document.getElementById('team-name-input');
const sidebarTeamName = document.getElementById('sidebar-team-name');
const form = document.getElementById('team-form');
const sidebarMenu = document.getElementById('sidebar-menu');

// 2. Update Preview Nama Tim
teamNameInput.addEventListener('input', function() {
    const value = this.value.trim();
    sidebarTeamName.textContent = value || "Nama Tim";
    if (value) {
        sidebarTeamName.classList.remove('text-gray-400');
        sidebarTeamName.classList.add('text-white');
    } else {
        sidebarTeamName.classList.remove('text-white');
        sidebarTeamName.classList.add('text-gray-400');
    }
});

// 3. Update Preview Foto (PASTIKAN INI ADA)
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

        fileNameLabel.textContent = file.name;
        fileNameLabel.classList.add('text-[#00ADB5]');

        const reader = new FileReader();
        reader.onload = function(e) {
            sidebarImg.src = e.target.result;
            sidebarImg.classList.remove('hidden');
            sidebarPlaceholder.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}

// 4. Update Privasi
function selectPrivacy(el) {
    document.querySelectorAll('.privacy-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    const val = el.querySelector('.privacy-opt-title').textContent.toLowerCase();
    document.getElementById('privacy-value').value = val;
}

// 5. Fungsi Update Sidebar Preview (Pindahkan ke luar DOMContentLoaded)
function updateSidebarPreview() {
    const sections = document.querySelectorAll('.section-name');
    
    if (sections.length === 0) {
        sidebarMenu.innerHTML = '<li class="pl-8 text-sm text-gray-500 h-14 flex items-center italic">Section akan muncul di sini</li>';
        return;
    }

    let html = '';
    sections.forEach(sec => {
        html += `
            <li class="pl-8 h-12 flex items-center text-gray-300 border-l-4 border-transparent hover:bg-white/5 transition-all cursor-default">
                <span class="text-sm font-medium">${sec.textContent}</span>
            </li>
        `;
    });
    sidebarMenu.innerHTML = html;
}

// 6. Fungsi Tambah & Hapus Section
function addSection() {
    const input = document.getElementById('sec-input');
    const list = document.getElementById('section-list');
    const val = input.value.trim();

    // Validasi: Jangan tambah kalau kosong
    if (val === "") {
        return; 
    }

    const item = document.createElement('div');
    item.className = 'list-item';
    item.innerHTML = `
        <div class="item-left">
            <div class="section-dot"></div>
            <span class="item-text section-name">${val}</span>
        </div>
        <button type="button" class="btn-remove-item" onclick="removeSection(this)">×</button> 
    `;
    list.appendChild(item);
    input.value = "";
    updateSidebarPreview();

    
}

function removeSection(btn) {
    const sections = document.querySelectorAll('.section-name');
    
    // Cek dulu sebelum hapus: Kalau tinggal 1, jangan kasih hapus!
    if (sections.length <= 1) {
        alert('Tim kamu minimal harus punya 1 section!');
        return; // Berhenti di sini, jangan lanjut hapus
    }

    btn.closest('.list-item').remove();
    updateSidebarPreview();
}

// 7. Gabungkan Event Listener (Cukup satu submit listener saja!)
document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi preview saat pertama kali buka
    updateSidebarPreview();

    form.addEventListener('submit', function(e) {
        const sections = document.querySelectorAll('.section-name');
        
        if (sections.length === 0) {
            alert('Minimal buat satu section!');
            e.preventDefault();
            return;
        }

        // Masukkan semua section ke dalam input hidden
        sections.forEach((el, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'sections[]';
            input.value = el.textContent.trim();
            form.appendChild(input);
        });

        const submitBtn = form.querySelector('.btn-submit');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyimpan...';
        }
    });
});