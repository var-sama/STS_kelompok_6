<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Post Detail</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/detail.css">
    <style>
        /* Mengatur input agar garis bawaannya abu, dan menghilangkan outline biru bawaan browser */
        .reply-input {
            border: 1px solid #d1d5db !important; /* Garis abu original saat diam */
            outline: none !important; /* Hilangkan outline supaya tidak ada 2 garis */
            transition: all 0.3s ease;
        }

        /* Saat di-klik, garis abunya langsung berubah warna jadi teal */
        .reply-input:focus {
            border: 1px solid #00ced1 !important;
        }

        /* Transisi agar placeholder memudar */
        .reply-input::placeholder {
            transition: opacity 0.3s ease;
        }

        /* Placeholder menjadi pudar saat input fokus */
        .reply-input:focus::placeholder {
            opacity: 0.3;
        }

        /* Bikin tag jadi full rounded */
        .tag {
            border-radius: 9999px !important;
        }
    </style>
</head>
<body>
    <div class="layout">
        <?php require_once '../app/views/components/navbar.php'; ?>
        <main>
            <button class="bg-[#222831] text-[#00ced1] text-sm w-fit rounded-full px-4 py-1.5 font-semibold flex items-center gap-2 hover:opacity-60 mb-6 transition-all" onclick="window.history.back();">
                <i class="fa-solid fa-chevron-left text-xs"></i> Kembali
            </button>
            <div class="detail-page">
                <div class="detail-card">
                    <div class="post-header">
                        <div class="avatar"></div>
                        <div class="user-info">
                            <h3><?= htmlspecialchars($problem['username'] ?? 'Anonim') ?> <span class="meta">• <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : '' ?></span></h3>
                            <p><?= htmlspecialchars($problem['class'] ?? '11 anonim') ?></p>
                        </div>
                    </div>

                    <h2 class="post-title"><?= htmlspecialchars($problem['title'] ?? 'Judul Tidak Ditemukan') ?></h2>
                    <p class="post-text"><?= nl2br(htmlspecialchars($problem['description'] ?? 'Deskripsi tidak tersedia atau gagal dimuat.')) ?></p>
                    <div class="post-function">
                        <div class="post-bottom">
                            <div class="actions">
                                <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                <span><button><iconify-icon icon="material-symbols:bookmark-outline"></iconify-icon>Bookmark</button></span>
                            </div>
                            <div class="tags">
                                <span class="tag">IPA</span>
                                <span class="tag">XI TKJ 2</span>
                                <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : '' ?>
                            </div>
                        </div>
                        <div class="reply-container">
                            <input class="reply-input" type="text" placeholder="Reply">
                        </div>
                    </div>
                </div>
            </div>

            <div class="comment-section">
                <div class="comment">
                <div class="comment-header">
                    <div class="profile"></div>
                    <div class="comment-info">
                        <h3>GPU <span class="meta">• telah diupload lorem ipsum yg lalu</span></h3>
                    </div>
                </div>
                <div class="comment-bar">
                    <div><p class="comment-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</p></div>
                    <div class="comment-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                </div>
                    </div>
                </div>
                </div>

                  <div class="comment">
                <div class="comment-header">
                    <div class="profile"></div>
                    <div class="comment-info">
                        <h3>GPU <span class="meta">• telah diupload lorem ipsum yg lalu</span></h3>
                    </div>
                </div>
                <div class="comment-bar">
                    <div><p class="comment-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</p></div>
                    <div class="comment-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                </div>
                    </div>
                </div>
                </div>

                  <div class="comment">
                <div class="comment-header">
                    <div class="profile"></div>
                    <div class="comment-info">
                        <h3>GPU <span class="meta">• telah diupload lorem ipsum yg lalu</span></h3>
                    </div>
                </div>
                <div class="comment-bar">
                    <div><p class="comment-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</p></div>
                    <div class="comment-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                </div>
                    </div>
                </div>
                </div>

                  <div class="comment">
                <div class="comment-header">
                    <div class="profile"></div>
                    <div class="comment-info">
                        <h3>GPU <span class="meta">• telah diupload lorem ipsum yg lalu</span></h3>
                    </div>
                </div>
                <div class="comment-bar">
                    <div><p class="comment-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</p></div>
                    <div class="comment-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                </div>
                    </div>
                </div>
                </div>

                  <div class="comment">
                <div class="comment-header">
                    <div class="profile"></div>
                    <div class="comment-info">
                        <h3>GPU <span class="meta">• telah diupload lorem ipsum yg lalu</span></h3>
                    </div>
                </div>
                <div class="comment-bar">
                    <div><p class="comment-text">Lorem ipsum dolor sit amet consectetur adipisicing elit</p></div>
                    <div class="comment-bottom">
                                <div class="actions">
                                    <span><button><iconify-icon icon="mdi:like-outline"></iconify-icon>Like</button></span>
                                    <span><button><iconify-icon icon="mdi:share"></iconify-icon>Share</button></span>
                                </div>
                    </div>
                </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>