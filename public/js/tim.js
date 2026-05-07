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

// Fungsi Pin UI (Tanpa ID)
function togglePin(event) {
    event.stopPropagation();
    const button = event.currentTarget;
    const svg = button.querySelector('svg');
    const path = svg.querySelector('path');
    const card = button.closest('.card-bg') || button.closest('[onclick*="teams-detail"]');
    const grid = document.getElementById('teams-grid');

    const isPinned = svg.getAttribute('fill') === '#ffffff';

    if (isPinned) {
        // UNPIN
        svg.setAttribute('fill', 'none');
        if(path) path.setAttribute('stroke', '#4C515F');
        grid.appendChild(card);
    } else {
        // PIN
        svg.setAttribute('fill', '#ffffff');
        if(path) path.setAttribute('stroke', '#ffffff');
        const firstTeamCard = grid.children[1]; 
        grid.insertBefore(card, firstTeamCard);
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