<?php
require_once '../app/config/app.php'; 

$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$totalComments = $pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn();

$stats = [
    ['label' => 'Total Users', 'value' => $totalUsers],
    ['label' => 'Total Post', 'value' => $totalPosts],
    ['label' => 'Total Comment', 'value' => $totalComments],
];

$dbPosts = $pdo->query("SELECT title, class, created_at FROM posts ORDER BY created_at DESC LIMIT 3")->fetchAll();
$posts = [];
foreach ($dbPosts as $row) {
    $posts[] = [
        'title' => $row['title'],
        'class' => $row['class'],
        'date'  => date('F j, Y', strtotime($row['created_at']))
    ];
}

// Some comment

$queryMessages = "SELECT m.message_text, m.created_at, u.name, u.class, u.image 
                  FROM messages m JOIN users u ON m.user_id = u.id 
                  ORDER BY m.created_at DESC LIMIT 5";
$dbMessages = $pdo->query($queryMessages)->fetchAll();
$messages = [];
foreach ($dbMessages as $row) {
    $timeAgo = time() - strtotime($row['created_at']);
    $timeStr = ($timeAgo < 60) ? 'Just now' : (($timeAgo < 3600) ? round($timeAgo / 60) . ' Mins Ago' : date('H:i', strtotime($row['created_at'])));

    $messages[] = [
        'name' => $row['name'], 'class' => $row['class'], 'text' => $row['message_text'], 'time' => $timeStr, 'img' => $row['image']
    ];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#E2E4F0]">

    <?php
    $stats = [
        ['label' => 'Total Users', 'value' => '1200'],
        ['label' => 'Total Post', 'value' => '1200'],
        ['label' => 'Total Comment', 'value' => '1200'],
    ];

    $posts = [
        ['title' => 'New Update', 'class' => 'Juang', 'date' => 'May 28, 2024'],
        ['title' => 'New Feature Announcement', 'class' => 'Juang', 'date' => 'February 17, 2026'],
        ['title' => 'Community Guidelines Update', 'class' => 'Juang', 'date' => 'March 27, 2026'],
    ];

    $messages = [
        ['name' => 'Yachiyo Runami', 'class' => 'XI TKJ 2', 'text' => 'Iroha Cutiest Girl', 'time' => '2 Mins Ago', 'img' => 'https://i.pravatar.cc/150?u=yachiyo'],
        ['name' => 'Yachiyo Runami', 'class' => 'XI TKJ 2', 'text' => 'Iroha Cutiest Girl', 'time' => '2 Mins Ago', 'img' => 'https://i.pravatar.cc/150?u=yachiyo2'],
    ];
    ?>
    <div class="layout">
        <?php require_once '../app/views/components/navbar.php'; ?>
    <main class="ml-16 p-8 min-h-screen">
        
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <?php foreach ($stats as $stat): ?>
                <div class="bg-[#2D333B] text-white p-7 rounded-[2.5rem] flex justify-between items-center shadow-lg transition-transform hover:scale-[1.02]">
                    <div>
                        <h2 class="text-xl font-bold mb-1"><?php echo $stat['label']; ?></h2>
                        <p class="text-3xl font-medium"><?php echo $stat['value']; ?></p>
                    </div>
                    <div class="bg-white/10 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm overflow-hidden mb-10">
            <div class="px-10 py-5 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Recent Posts</h2>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#D9D9D9] text-gray-700">
                            <th class="px-10 py-4 font-bold uppercase text-sm tracking-wider">Title</th>
                            <th class="px-10 py-4 font-bold uppercase text-sm tracking-wider">Class</th>
                            <th class="px-10 py-4 font-bold uppercase text-sm tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($posts as $post): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-10 py-5 text-gray-700"><?php echo $post['title']; ?></td>
                                <td class="px-10 py-5 text-gray-700"><?php echo $post['class']; ?></td>
                                <td class="px-10 py-5 text-gray-700"><?php echo $post['date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm overflow-hidden">
            <div class="px-10 py-5 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Latest Messages</h2>
            </div>
            <div class="divide-y divide-gray-100">
                <?php foreach ($messages as $msg): ?>
                    <div class="px-10 py-6 flex items-center gap-6 hover:bg-gray-50 transition-colors">
                        <img src="<?php echo $msg['img']; ?>" alt="Profile" class="w-16 h-16 rounded-full object-cover shadow-sm">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="font-bold text-lg text-gray-900"><?php echo $msg['name']; ?></h3>
                                <span class="text-xs text-gray-400"><?php echo $msg['time']; ?></span>
                            </div>
                            <p class="text-sm text-blue-500 font-semibold mb-1"><?php echo $msg['class']; ?></p>
                            <p class="text-gray-600"><?php echo $msg['text']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>
                </div>

</body>
</html>