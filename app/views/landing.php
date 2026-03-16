<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/landing.css">
    <title>landing page</title>
</head>
<body>
    <div class="layout">
        <?php require_once '../app/views/components/navbar.php'; ?>
        <main>
            <div class="content-wrapper">
                <div class="search-container">
                    <input type="text" placeholder="Cari masalah">
                </div>

                <div class="post-scroll">
                    <div class="post-area">
                        <div class="post">
                            <div class="post-header">
                                <div class="profile"></div>
                                <div class="user"><h3>GPU</h3><span>XI TKJ 2</span></div>
                            </div>
                            <div class="post-text">Masalah pertama: browser error saat runtime.</div>
                            <div class="post-bottom"><div class="actions"><span>Like</span><span>Share</span><span>Bookmark</span><span>Comment</span></div><div class="tags"><span class="tag">IPA</span><span class="tag">XI TKJ 2</span><span class="views">67</span></div></div>
                        </div>
                        <div class="post">
                            <div class="post-header"><div class="profile"></div><div class="user"><h3>Eva</h3><span>XI RPL 1</span></div></div>
                            <div class="post-text">Masalah kedua: error database connection di XAMPP.</div>
                            <div class="post-bottom"><div class="actions"><span>Like</span><span>Share</span><span>Bookmark</span><span>Comment</span></div><div class="tags"><span class="tag">Database</span><span class="tag">XAMPP</span><span class="views">120</span></div></div>
                        </div>
                        <div class="post">
                            <div class="post-header"><div class="profile"></div><div class="user"><h3>Budi</h3><span>XII TKJ 3</span></div></div>
                            <div class="post-text">Masalah ketiga: CSS layout tidak responsif di mobile.</div>
                            <div class="post-bottom"><div class="actions"><span>Like</span><span>Share</span><span>Bookmark</span><span>Comment</span></div><div class="tags"><span class="tag">CSS</span><span class="tag">Responsif</span><span class="views">235</span></div></div>
                        </div>
                        <div class="post">
                            <div class="post-header"><div class="profile"></div><div class="user"><h3>Carol</h3><span>XII RPL 2</span></div></div>
                            <div class="post-text">Masalah keempat: notifikasi JS tidak muncul di production.</div>
                            <div class="post-bottom"><div class="actions"><span>Like</span><span>Share</span><span>Bookmark</span><span>Comment</span></div><div class="tags"><span class="tag">JavaScript</span><span class="tag">Notifikasi</span><span class="views">482</span></div></div>
                        </div>
                        <div class="post">
                            <div class="post-header"><div class="profile"></div><div class="user"><h3>Dina</h3><span>XII TKJ 1</span></div></div>
                            <div class="post-text">Masalah kelima: server timeout saat upload file.</div>
                            <div class="post-bottom"><div class="actions"><span>Like</span><span>Share</span><span>Bookmark</span><span>Comment</span></div><div class="tags"><span class="tag">Server</span><span class="tag">File</span><span class="views">94</span></div></div>
                        </div>
                    </div>
                </div>

                <div class="create-container">
                    <input type="text" placeholder="Ciptakan masalah baru">
                </div>
            </div>
        </main>
    </div>
</body>
</html>