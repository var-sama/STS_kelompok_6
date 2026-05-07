const teamNameInput = document.getElementById('team-name-input');
const sidebarTeamName = document.getElementById('sidebar-team-name');

// 1. Update Preview Nama Tim
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

// 2. Update Preview Foto
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

// 3. Update Privasi (Update input hidden agar terbaca PHP)
function selectPrivacy(el) {
    document.querySelectorAll('.privacy-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    
    // Ambil teks dari pilihan (Publik/Privat) dan masukkan ke input hidden
    const val = el.querySelector('.privacy-opt-title').textContent.toLowerCase();
    document.getElementById('privacy-value').value = val;
}

// 4. Inisialisasi Sidebar Menu (Kosong dulu sesuai request kamu)
document.addEventListener('DOMContentLoaded', () => {
    const sidebarMenu = document.getElementById('sidebar-menu');
    sidebarMenu.innerHTML = '<li class="pl-8 text-sm text-gray-500 h-14 flex items-center italic">Section akan muncul di sini</li>';

    // 5. Mencegah Double Submit
    const form = document.getElementById('team-form');
    form.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]') || form.querySelector('input[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';
        }
    });
}); 