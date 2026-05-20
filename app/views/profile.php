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
                <h3 style="color: #555;">Belum ada postingan saat ini.</h3>
                </div>
            
            

            <div id="Suka" class="tab-content" style="display: none; margin-top: 30px;">
                <h3 style="color: #555;">Belum ada aktivitas suka saat ini.</h3>
                </div>

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

