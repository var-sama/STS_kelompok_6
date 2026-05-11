function toggleDropdown(event, dropdownId) {
    event.stopPropagation();
    const dropdown = document.getElementById(dropdownId);
    if (!dropdown) return;

    document.querySelectorAll('[id^="optionsDropdown"]').forEach(el => {
        if (el !== dropdown) el.classList.add('hidden');
    });

    dropdown.classList.toggle('hidden');
}

function closeDropdown() {
    const dropdown = document.getElementById('optionsDropdown');
    if (dropdown) dropdown.classList.add('hidden');
}

window.addEventListener('click', () => {
    closeDropdown();
});

function bisukanTim(event) {
    event.stopPropagation();
    closeDropdown();
    alert('Tim dibisukan.');
}

function hapusTim(event) {
    event.stopPropagation();
    closeDropdown();
    if (confirm('Apakah kamu yakin ingin menghapus tim ini?')) {
        alert('Tim dihapus.');
    }
}

function toggleTeamOptions(event) {
    event.stopPropagation();
    const dropdown = document.getElementById('teamOptionsDropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

window.addEventListener('click', () => {
    const teamDropdown = document.getElementById('teamOptionsDropdown');
    if (teamDropdown) teamDropdown.classList.add('hidden');
});

function setActive(element) {
    // 1. Cari semua menu section
    const allMenus = document.querySelectorAll('.section-menu');

    // 2. Bersihkan semua class "aktif" dari semua menu
    allMenus.forEach(menu => {
        // Hapus class aktif
        menu.classList.remove('bg-white/10', 'border-[#2dd4bf]', 'text-[#2dd4bf]');
        // Kembalikan ke class default (tidak aktif)
        menu.classList.add('border-transparent', 'text-gray-300', 'hover:bg-white/5', 'hover:text-white');
    });

    // 3. Tambahkan class "aktif" cuma ke yang baru saja diklik
    element.classList.add('bg-white/10', 'border-[#2dd4bf]', 'text-[#2dd4bf]');
    // Hapus class hover/transparan biar nggak bentrok
    element.classList.remove('border-transparent', 'text-gray-300', 'hover:bg-white/5', 'hover:text-white');
}