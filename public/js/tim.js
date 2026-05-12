// Fungsi Dropdown
function toggleDropdown(event, id) {
    event.stopPropagation();
    document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
        if(el.id !== `dropdown-${id}`) el.classList.add('hidden');
    });
    const dropdown = document.getElementById(`dropdown-${id}`);
    if (dropdown) dropdown.classList.toggle('hidden');
}

// Tutup dropdown kalau klik di luar
window.addEventListener('click', () => {
    document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
});

// Fungsi Pin UI (Dengan perbaikan posisi Unpin)
function togglePin(event) {
    event.stopPropagation();
    const button = event.currentTarget;
    const svg = button.querySelector('svg');
    const path = svg.querySelector('path');
    const card = button.closest('.card-bg') || button.closest('[onclick*="teams-detail"]');
    const grid = document.getElementById('teams-grid');

    const isPinned = svg.getAttribute('fill') === '#ffffff';

    if (isPinned) {
        // --- PROSES UNPIN ---
        svg.setAttribute('fill', 'none');
        if(path) path.setAttribute('stroke', '#4C515F');
        
        // Hapus penanda class (opsional tapi membantu)
        card.classList.remove('is-pinned'); 

        // Cari elemen tim PERTAMA yang statusnya TIDAK dipin.
        // Kita pakai slice(1) untuk mengabaikan index 0 (karena biasanya index 0 itu tombol "Buat Tim Baru").
        const firstUnpinnedCard = Array.from(grid.children).slice(1).find(el => {
            // Lewati card yang sedang kita klik ini
            if (el === card) return false;
            
            // Cek apakah elemen tetangga ini sedang dipin (dari class atau warna SVG-nya)
            const elSvg = el.querySelector('svg');
            const elIsPinned = el.classList.contains('is-pinned') || (elSvg && elSvg.getAttribute('fill') === '#ffffff');
            
            // Kita mencari elemen yang TIDAK dipin
            return !elIsPinned; 
        });

        if (firstUnpinnedCard) {
            // Taruh tim yang di-unpin tepat SEBELUM tim unpinned pertama 
            // (Otomatis jatuh pas di bawah batas kelompok yang di-pin)
            grid.insertBefore(card, firstUnpinnedCard);
        } else {
            // Kalau semua tim ternyata dipin, baru lempar ke paling bawah
            grid.appendChild(card);
        }

    } else {
        // --- PROSES PIN ---
        svg.setAttribute('fill', '#ffffff');
        if(path) path.setAttribute('stroke', '#ffffff');
        
        // Tambahkan class penanda agar gampang dicari saat unpin nanti
        card.classList.add('is-pinned');
        
        // Pindah ke urutan paling atas (setelah tombol Buat Tim Baru)
        const firstTeamCard = grid.children[1]; 
        if (firstTeamCard) {
            grid.insertBefore(card, firstTeamCard);
        } else {
            grid.appendChild(card);
        }
    }
}

// Fungsi dummy untuk tombol aksi
function viewAnggota(event) {
    event.stopPropagation();
    window.location.href = '/view-anggota';
}

function bisukanTim(event) {
    event.stopPropagation();
    alert("Tim dibisukan.");
}

function confirmDelete(event) {
    event.stopPropagation();
    return confirm("Apakah kamu yakin ingin menghapus tim ini?");
}