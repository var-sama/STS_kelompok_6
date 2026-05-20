<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* === RESET & GLOBAL STYLES === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            overflow: hidden; /* Mencegah double scrollbar */
        }

        /* === PROFILE COMPONENT STYLES === */
        .profile-wrapper {
            flex: 1; /* PENTING: Mengisi sisa layar di sebelah kanan navbar */
            background-color: #ffffff; 
            padding: 40px;
            height: 100vh;
            overflow-y: auto; /* Bisa di-scroll kalau konten profilnya panjang */
            box-sizing: border-box;
            color: #000;
            font-family: 'Roboto', sans-serif;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .profile-left-section {
            display: flex;
            gap: 20px;
        }

        .profile-wrapper .avatar {
            font-size: 100px;
            color: #000;
        }

        .user-info h1 {
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #000;
        }

        .user-info h1 i {
            font-size: 16px;
            color: #555;
            cursor: pointer;
        }

        .user-info .handle {
            color: #555;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-info .school {
            color: #333;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-actions i {
            font-size: 20px;
            cursor: pointer;
            color: #000;
        }

        .btn-headline {
            background-color: #c4c4c4;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 500;
            color: #000;
        }

        .reminder-section {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .reminder-section i {
            font-size: 20px;
        }

        /* Tabs */
        .tab-item {
    background: none;
    border: none;
    font: inherit;      /* Mengikuti font dari parent/body */
    color: inherit;     /* Mengikuti warna teks sebelumnya */
    cursor: pointer;    /* Mengubah kursor menjadi bentuk tangan saat diarahkan */
    padding: 10px 15px; /* Sesuaikan dengan padding yang Anda gunakan sebelumnya */
    }

/* Pastikan Anda sudah memiliki CSS untuk state active */
    .tab-item.active {
    color: #007bff; /* Contoh warna biru muda */
    border-bottom: 2px solid #007bff;
    }

        .profile-wrapper .tab-item {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 18px;
            padding-bottom: 10px;
        }

        .profile-wrapper .tab-item.active {
            color: #0088cc;
            border-bottom: 3px solid #0088cc;
        }

      

        /* Contact Information */
        .contact-section h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .contact-grid {
            display: flex;
            justify-content: flex-start;
            gap: 100px;
            max-width: 800px;
        }

        .contact-item {
            display: flex;
            gap: 15px;
            align-items: center;
            height: 100px;
            weight: 20px;
        }

        .contact-item i {
            font-size: 24px;
            color: #000;
        }

        .contact-text h4 {
            font-size: 14px;
            margin-bottom: 3px;
            color: #000;
            font-weight: bold;
        }

        .contact-text a, .contact-text span {
            font-size: 13px;
            color: #0088cc;
            text-decoration: none;
        }

        .profile-pp {
    
    width: 125px;
    height: 125px;
    border-radius: 100%; /* Jika ingin gambarnya menjadi bulat */
    object-fit: cover;
    margin-bottom: 10px;
}

.online {
    width: 50px;
    height: 35px;
    border-radius: 100%; 
    margin-top: 0px;/* Jika ingin gambarnya menjadi bulat */
    position: relative;
    top: 10px; /* Atur angka ini sampai pas di mata */
    right: px;
}

.profile-notif {
    margin: 1px;
    width: 100p;
    height: 20px;
} 

.email {
   width: 50px;
    height: 35x;
    margin-top: 0px;/* Jika ingin gambarnya menjadi bulat */
    position: relative;
    top: 10px; /* Atur angka ini sampai pas di mata */
    right: px;
    margin-bottom: 40px;
} 

.jabatan {
    width: 55px;
    height: 38px;
    margin-top: 0px;/* Jika ingin gambarnya menjadi bulat */
    position: relative;
    top: 10px; /* Atur angka ini sampai pas di mata */
    right: px;
    margin-bottom: 40px;
} 

.dapartemen {
   width: 55px;
    height: 40px;
    margin-top: 0px;/* Jika ingin gambarnya menjadi bulat */
    position: relative;
    top: 10px; /* Atur angka ini sampai pas di mata */
    right: px;
    margin-bottom: 40px;
} 

/* Gaya dasar untuk tombol tab */
        .profile-wrapper .tab-item {
            background: none;
            border: none;
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 18px;
            padding-bottom: 10px;
            cursor: pointer;
            
            /* Tambahkan dua baris ini agar ada animasi transisi yang mulus */
            border-bottom: 3px solid transparent; 
            transition: all 0.3s ease; 
        }


        .profile-wrapper .tab-item.active {
            color: #00ADB5;
            border-bottom: 3px solid #00ADB5; /* Garis bawah biru */
        }
    
        /* === POSTINGAN KARTU STYLES === */
        .post-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 25px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden; /* Agar footer mengikuti border-radius kartu */
        }

        .post-header {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .post-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #d1d1d1; /* Warna abu-abu placeholder */
            margin-right: 15px;
        }

        .post-user-info {
            display: flex;
            flex-direction: column;
        }

        .post-name {
            font-weight: bold;
            font-size: 16px;
            color: #000;
            margin-bottom: 3px;
        }

        .post-meta {
            font-size: 13px;
            color: #888;
        }

        .post-content {
            padding: 0 20px 20px 20px;
            font-size: 15px;
            color: #333;
            line-height: 1.5;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3238; /* Warna dark/navy pada footer */
            padding: 12px 20px;
            color: #ffffff;
        }

        .post-actions {
            display: flex;
            gap: 20px;
        }

        .post-action-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .post-action-btn:hover {
            color: #00ADB5;
        }

        .post-footer-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .post-tag {
            background-color: #15b2b9; /* Warna cyan/teal */
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .post-date {
            font-size: 14px;
            color: #ffffff;
            margin-left: 5px;
        }
    </style>
</head>
<body>

    <div style="display: flex; width: 100%; height: 100vh;"> 
        
        <?php require_once '../app/views/components/navbar.php'?>

        <div class="profile-wrapper">
            
            <div class="profile-header">
                <div class="profile-left-section">
                    <img src="/icons/suki.jpg" class="profile-pp">
                    <div class="user-info">
                        <h1>Michael Momok <img src="/icons/notification.png" class="profile-notif"></i></h1>
                        <p class="handle">@michael10_</p>
                        <p class="school">Student_SMK_Immanuel_Pontianak_11TKJ2</p>
                        <div class="user-actions">
                            <button class="btn-headline">+ Add Headline</button>
                        </div>
                    </div>
                </div>
                
                <div class="reminder-section">
                    <span>Set Reminder</span>
                </div>
            </div>

            <div class="tabs">
                <button class="tab-item active" onclick="bukaTab(event, 'Informasi')">Informasi Pengguna</button>
                <button class="tab-item" onclick="bukaTab(event, 'Postingan')">Postingan</button>
                <button class="tab-item" onclick="bukaTab(event, 'Suka')">Suka</button>
            </div>

            <div id="Informasi" class="tab-content" style="display: block; margin-top: 30px;">
                <div class="contact-grid">
                    <div class="contact-item">
                        <img src="/icons/Email.png" class="email">
                        <div class="contact-text">
                            <h4>Email</h4>
                            <a href="mailto:michael041@gmail.com">michael041@gmail.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <img src="/icons/Jabatan.png" class="jabatan">
                        <div class="contact-text">
                            <h4>Jabatan</h4>
                            <span>Pelajar</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <img src="/icons/dapartemen.png" class="dapartemen">
                        <div class="contact-text">
                            <h4>Dapartermen</h4>
                            <span>SMK1_11TKJ2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Postingan" class="tab-content" style="display: none; margin-top: 30px;">
                
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-avatar"></div>
                        <div class="post-user-info">
                            <div class="post-name">GPU</div>
                            <div class="post-meta">XI TKJ 2</div>
                        </div>
                    </div>
                    <div class="post-content">
                        Masalah pertama: browser error saat runtime.
                    </div>
                    <div class="post-footer">
                        <div class="post-actions">
                            <button class="post-action-btn"><i class="fa-regular fa-thumbs-up"></i> Like</button>
                            <button class="post-action-btn"><i class="fa-solid fa-share"></i> Share</button>
                            <button class="post-action-btn"><i class="fa-regular fa-bookmark"></i> Bookmark</button>
                            <button class="post-action-btn"><i class="fa-regular fa-comment"></i> Comment</button>
                        </div>
                        <div class="post-footer-right">
                            <span class="post-tag">IPA</span>
                            <span class="post-tag">XI TKJ 2</span>
                            <span class="post-date">February 30th, 2067</span>
                        </div>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-header">
                        <div class="post-avatar"></div> 
                        <div class="post-user-info">
                            <div class="post-name">RAM Memory</div>
                            <div class="post-meta">XII RPL 1</div>
                        </div>
                    </div>
                    <div class="post-content">
                        Apakah ada yang tahu cara mengatasi memory leak pada aplikasi berbasis Node.js? Server saya sering crash setelah beberapa jam aktif.
                    </div>
                    <div class="post-footer">
                        <div class="post-actions">
                            <button class="post-action-btn"><i class="fa-regular fa-thumbs-up"></i> Like</button>
                            <button class="post-action-btn"><i class="fa-solid fa-share"></i> Share</button>
                            <button class="post-action-btn"><i class="fa-regular fa-bookmark"></i> Bookmark</button>
                            <button class="post-action-btn"><i class="fa-regular fa-comment"></i> Comment</button>
                        </div>
                        <div class="post-footer-right">
                            <span class="post-tag">Programming</span>
                            <span class="post-tag">Server</span>
                            <span class="post-date">May 20th, 2026</span>
                        </div>
                    </div>
                </div>

            </div>
            
            

            <div id="Suka" class="tab-content" style="display: none; margin-top: 30px;">
                
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-avatar"></div>
                        <div class="post-user-info">
                            <div class="post-name">CPU Core</div>
                            <div class="post-meta">X TKJ 1</div>
                        </div>
                    </div>
                    <div class="post-content">
                        Akhirnya berhasil melakukan konfigurasi router Mikrotik untuk lab komputer sekolah! Jaringan lebih stabil sekarang. 🚀
                    </div>
                    <div class="post-footer">
                        <div class="post-actions">
                            <button class="post-action-btn" style="color: #00ADB5;"><i class="fa-solid fa-thumbs-up"></i> Liked</button>
                            <button class="post-action-btn"><i class="fa-solid fa-share"></i> Share</button>
                            <button class="post-action-btn"><i class="fa-regular fa-bookmark"></i> Bookmark</button>
                            <button class="post-action-btn"><i class="fa-regular fa-comment"></i> Comment</button>
                        </div>
                        <div class="post-footer-right">
                            <span class="post-tag">Jaringan</span>
                            <span class="post-tag">Mikrotik</span>
                            <span class="post-date">May 18th, 2026</span>
                        </div>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-header">
                        <div class="post-avatar"></div> 
                        <div class="post-user-info">
                            <div class="post-name">Motherboard</div>
                            <div class="post-meta">Guru Pembimbing</div>
                        </div>
                    </div>
                    <div class="post-content">
                        Pengingat untuk kelas XI TKJ 2: Batas waktu pengumpulan laporan praktikum perakitan PC adalah hari Jumat minggu ini. Harap kumpulkan dalam format PDF.
                    </div>
                    <div class="post-footer">
                        <div class="post-actions">
                            <button class="post-action-btn" style="color: #00ADB5;"><i class="fa-solid fa-thumbs-up"></i> Liked</button>
                            <button class="post-action-btn"><i class="fa-solid fa-share"></i> Share</button>
                            <button class="post-action-btn"><i class="fa-regular fa-bookmark"></i> Bookmark</button>
                            <button class="post-action-btn"><i class="fa-regular fa-comment"></i> Comment</button>
                        </div>
                        <div class="post-footer-right">
                            <span class="post-tag">Pengumuman</span>

          <script>
        function bukaTab(evt, namaTab) {
            
            let tabcontent = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            
            let tablinks = document.getElementsByClassName("tab-item");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

           
            document.getElementById(namaTab).style.display = "block";
            
            
            evt.currentTarget.classList.add("active");
        }
    </script>  
          
            
                        </div>
                    </div>
                </div>
            </div>
            
        </div> </div> </body>
</html>

