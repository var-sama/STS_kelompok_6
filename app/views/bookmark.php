<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/landing.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Halaman Bookmark</title>
</head>
<body>
    <div class="layout">
        <?php require_once '../app/views/components/navbar.php'; ?>
        <main>
            <div class="search-container">
                    <iconify-icon icon="material-symbols:search"></iconify-icon>
                    <input type="text" placeholder="Cari masalah">
                </div>

            <div class="post-scroll">
                <div class="post-area">
                <?php if (!empty($problems)): ?>
                    <?php foreach ($problems as $problem): ?>
                        <div class="post" id="post-box-<?= $problem['id'] ?>">
                            <div onclick="window.location.href='/problem-detail?id=<?= $problem['id'] ?>'" style="cursor: pointer;">
                                <div class="post-header">
                                    <div class="profile"></div>
                                    <div class="user">
                                        <h3>Anonim</h3> <span>Umum</span>
                                    </div>
                                </div>
                                <div class="post-text">
                                    <strong><?= htmlspecialchars($problem['title']) ?></strong>
                                </div>
                            </div>
                            
                            <div class="post-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                    <span>
                                        <button class="bookmark-btn" data-id="<?= $problem['id'] ?>">
                                            <iconify-icon icon="material-symbols:bookmark" style="color: #00ced1;"></iconify-icon>
                                            Bookmark
                                        </button>
                                    </span>
                                    <span><button><svg class="icomment" width="18" height="18" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0015 1.09881e-07C8.10862 -0.000280442 6.25454 0.536679 4.65477 1.54846C3.05501 2.56025 1.77526 4.0053 0.964284 5.71564C0.153311 7.42599 -0.155579 9.33138 0.0735211 11.2103C0.302621 13.0893 1.0603 14.8646 2.25849 16.33L0.294488 18.293C0.154679 18.4329 0.0594721 18.611 0.0209045 18.805C-0.017663 18.9989 0.00214001 19.2 0.07781 19.3827C0.15348 19.5654 0.28162 19.7215 0.446029 19.8314C0.610439 19.9413 0.803738 20 1.00149 20H10.0015C12.6537 20 15.1972 18.9464 17.0726 17.0711C18.9479 15.1957 20.0015 12.6522 20.0015 10C20.0015 7.34784 18.9479 4.8043 17.0726 2.92893C15.1972 1.05357 12.6537 1.09881e-07 10.0015 1.09881e-07ZM7.00149 5H13.0015C13.2667 5 13.5211 5.10536 13.7086 5.29289C13.8961 5.48043 14.0015 5.73478 14.0015 6C14.0015 6.26522 13.8961 6.51957 13.7086 6.70711C13.5211 6.89464 13.2667 7 13.0015 7H7.00149C6.73627 7 6.48192 6.89464 6.29438 6.70711C6.10685 6.51957 6.00149 6.26522 6.00149 6C6.00149 5.73478 6.10685 5.48043 6.29438 5.29289C6.48192 5.10536 6.73627 5 7.00149 5ZM13.0015 15H7.00149C6.73627 15 6.48192 14.8946 6.29438 14.7071C6.10685 14.5196 6.00149 14.2652 6.00149 14C6.00149 13.7348 6.10685 13.4804 6.29438 13.2929C6.48192 13.1054 6.73627 13 7.00149 13H13.0015C13.2667 13 13.5211 13.1054 13.7086 13.2929C13.8961 13.4804 14.0015 13.7348 14.0015 14C14.0015 14.2652 13.8961 14.5196 13.7086 14.7071C13.5211 14.8946 13.2667 15 13.0015 15ZM15.0015 11H5.00149C4.73627 11 4.48192 10.8946 4.29438 10.7071C4.10685 10.5196 4.00149 10.2652 4.00149 10C4.00149 9.73478 4.10685 9.48043 4.29438 9.29289C4.48192 9.10536 4.73627 9 5.00149 9H15.0015C15.2667 9 15.5211 9.10536 15.7086 9.29289C15.8961 9.48043 16.0015 9.73478 16.0015 10C16.0015 10.2652 15.8961 10.5196 15.7086 10.7071C15.5211 10.8946 15.2667 11 15.0015 11Z"/>
                                    </svg>Comment</button></span>
                                </div>
                                <div class="tags">
                                    <span class="tag">Problem</span>
                                    <span class="views">
                                        <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : 'Unknown Date' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center; color: #888; padding: 50px;">
                        <p>Belum ada masalah yang di-bookmark.</p>
                    </div>
                <?php endif; ?>
                </div>
            </div>
                <div class="create-container" onclick="window.location.href='/Problemcreate'">
                    <div class="plus-icon">
                        <iconify-icon icon="mdi:plus"></iconify-icon>
                    </div>
                </div>
        </main>
    </div>

    <script>
    document.querySelectorAll('.bookmark-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const problemId = this.getAttribute('data-id');
            
            fetch('/toggle-bookmark', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'problem_id=' + problemId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    // Langsung hapus card postingan dari layar secara realtime
                    const postCard = document.getElementById('post-box-' + problemId);
                    if(postCard) postCard.remove();
                }
            });
        });
    });
    </script>
</body>
</html>