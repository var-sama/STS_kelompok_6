    document.querySelectorAll('.bookmark-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); 
            
            const problemId = this.getAttribute('data-id');
            const icon = this.querySelector('iconify-icon');
            
            // Mengirim data ke backend secara realtime
            fetch('/toggle-bookmark', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'problem_id=' + problemId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    // Jika berhasil ditambah, ubah icon jadi FULL dan beri warna teal
                    icon.setAttribute('icon', 'material-symbols:bookmark');
                    icon.style.color = '#00ced1';
                } else if (data.status === 'removed') {
                    // Jika dihapus, kembalikan ke OUTLINE dan hapus warnanya
                    icon.setAttribute('icon', 'material-symbols:bookmark-outline');
                    icon.style.color = '';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
