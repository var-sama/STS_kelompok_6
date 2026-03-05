<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* --- Base & Reset --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #E6E8F4; /* Light bluish-gray background */
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: #272C39; 
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo-area {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #3A404F;
        }

        .logo-circle {
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border-radius: 50%;
        }

        .nav-menu {
            list-style: none;
            flex-grow: 1;
            padding-top: 20px;
        }

        .nav-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #A0A5B1;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-item:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }

        .nav-item.active {
            color: #06B6D4;
        }
        
        .nav-item i {
            font-size: 1.2rem;
        }

        .user-profile {
            padding: 30px 20px;
            text-align: center;
        }

        .user-profile i.fa-circle-user {
            font-size: 4rem;
            color: #555B6A;
            margin-bottom: 10px;
        }
        .user-profile p {
            color: #A0A5B1;
            font-size: 0.9rem;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px 40px;
            overflow-y: auto;
        }

        .top-link {
            color: #06B6D4;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 2rem;
            color: #111;
        }

        .header-controls {
            display: flex;
            gap: 10px;
        }

        .header-controls select {
            padding: 8px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background-color: white;
            outline: none;
        }

        .header-controls .empty-box {
            width: 50px;
            height: 38px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #272C39;
            color: white;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-info p {
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-icon i {
            font-size: 3rem;
            color: white;
        }

        .table-container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .table-header-title {
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #272C39;
            border-bottom: 1px solid #E5E7EB;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background-color: #F8F9FA;
            color: #6B7280;
            font-weight: 600;
            border-bottom: 1px solid #E5E7EB;
        }

        td {
            border-bottom: 1px solid #E5E7EB;
            color: #111;
            font-weight: 500;
        }

        .action-icon {
            color: #6B7280;
            cursor: pointer;
        }

        /* Table Footer */
        .table-footer {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            color: #6B7280;
            font-size: 0.9rem;
            background-color: #F8F9FA;
        }
        
        .view-all {
            text-decoration: none;
            color: #6B7280;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="logo-area">
                <div class="logo-circle"></div>
                <span>Logo</span>
            </div>
            <nav>
                <a href="#" class="nav-item"><i class="fa-solid fa-house"></i> Homepage</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-tags"></i> Category</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-users"></i> Teams</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-bookmark"></i> Bookmark</a>
                <a href="#" class="nav-item active"><i class="fa-solid fa-circle-user"></i> Admin Page</a>
            </nav>
        </div>
        <div class="user-profile">
            <i class="fa-solid fa-circle-user"></i>
            <p>Yachi8000</p>
        </div>
    </div>

    <div class="main-content">
        <a href="#" class="top-link"><i class="fa-solid fa-angle-left"></i> Kembali</a>

        <div class="header">
            <h1>Analytics</h1>
            <div class="header-controls">
                <select>
                    <option>Weekly</option>
                    <option>Monthly</option>
                </select>
                <div class="empty-box"></div>
            </div>
        </div>

        <div class="cards-grid">
            <?php
            // Mock Data for statistics
            $stats = [
                ['title' => 'Active Users', 'value' => '999', 'icon' => 'fa-users'],
                ['title' => 'New Posts', 'value' => '999', 'icon' => 'fa-newspaper'],
                ['title' => 'New Comment', 'value' => '1,000', 'icon' => 'fa-comment'],
                ['title' => 'New Message', 'value' => '1.605', 'icon' => 'fa-envelope']
            ];

            foreach ($stats as $stat) {
                echo '
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>' . $stat['title'] . '</h3>
                        <p>' . $stat['value'] . '</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid ' . $stat['icon'] . '"></i>
                    </div>
                </div>';
            }
            ?>
        </div>

        <div class="table-container">
            <div class="table-header-title">Daftar Pengguna</div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mock Data for table rows
                    $users = [
                        ['id' => '1', 'nama' => 'IPA', 'kelas' => 'XI TKJ 2', 'tanggal' => '29, Febuari 2067'],
                        ['id' => '1', 'nama' => 'IPA', 'kelas' => 'XI TKJ 2', 'tanggal' => '29, Febuari 2067'],
                        ['id' => '1', 'nama' => 'IPA', 'kelas' => 'XI TKJ 2', 'tanggal' => '29, Febuari 2067'],
                        ['id' => '1', 'nama' => 'IPA', 'kelas' => 'XI TKJ 2', 'tanggal' => '29, Febuari 2067'],
                        ['id' => '1', 'nama' => 'IPA', 'kelas' => 'XI TKJ 2', 'tanggal' => '29, Febuari 2067'],
                    ];

                    foreach ($users as $user) {
                        echo '
                        <tr>
                            <td>' . $user['id'] . '</td>
                            <td>' . $user['nama'] . '</td>
                            <td>' . $user['kelas'] . '</td>
                            <td><i>' . $user['tanggal'] . '</i></td>
                            <td><i class="fa-solid fa-thumbtack action-icon"></i></td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="table-footer">
                <span>Showing 5 out of 67 users</span>
                <a href="#" class="view-all">View All ></a>
            </div>
        </div>

    </div>

</body>
</html>