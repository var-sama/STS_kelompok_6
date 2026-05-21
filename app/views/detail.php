<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Post Detail</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-[#f6f7fb] font-sans m-0">
    <div class="flex min-h-screen h-screen">
        <?php require_once '../app/views/components/navbar.php'; ?>
        
        <main class="flex-1 overflow-y-auto h-screen p-6">
            <button class="bg-[#222831] text-[#00ced1] text-sm w-fit rounded-full px-4 py-1.5 font-semibold flex items-center gap-2 hover:opacity-60 mb-6 transition-all" onclick="window.history.back();">
                <i class="fa-solid fa-chevron-left text-xs"></i> Kembali
            </button>
            
            <div class="p-5 flex justify-center">
                <div class="w-full max-w-[1200px] mx-auto bg-white rounded-xl shadow-[0_10px_20px_rgba(0,0,0,0.08)] border border-[#eee] overflow-hidden h-auto min-h-max">
                    
                    <div class="flex items-center gap-2.5 p-5">
                        <div class="w-[50px] h-[50px] bg-[#ccc] rounded-full shrink-0"></div>
                        <div>
                            <h3 class="m-0 text-lg text-[#222] font-semibold">
                                <?= htmlspecialchars($problem['username'] ?? 'Anonim') ?> 
                                <span class="text-[#777] text-[13px] ml-1.5 font-normal">• <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : '' ?></span>
                            </h3>
                            <p class="m-0 text-[#555] text-[13px]"><?= htmlspecialchars($problem['class'] ?? '11 anonim') ?></p>
                        </div>
                    </div>

                    <h2 class="mx-5 mb-[15px] mt-0 text-2xl text-[#111] font-bold"><?= htmlspecialchars($problem['title'] ?? 'Judul Tidak Ditemukan') ?></h2>
                    
                    <p class="mx-5 mb-5 mt-0 text-[#555] text-[15px] leading-[1.5] break-words whitespace-pre-wrap"><?= nl2br(htmlspecialchars($problem['description'] ?? 'Deskripsi tidak tersedia atau gagal dimuat.')) ?></p>
                    
                    <div class="bg-[#2d3142] pt-3 px-5 pb-[18px] mt-2.5">
                        <div class="flex justify-between items-center text-white p-0 flex-wrap gap-2 w-full">
                            <div class="flex gap-5 text-[#222831] justify-start">
                                <span class="flex items-center gap-1.5 cursor-pointer font-semibold text-[13px] m-0 p-0">
                                    <button class="group border-none bg-transparent text-[#eeeeee] p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-1.5 font-semibold hover:text-[#00ADB5] transition-colors">
                                        <iconify-icon icon="mdi:like-outline" class="text-[20px] w-5 h-5 text-[#eeeeee] m-0 p-0 group-hover:text-[#00ADB5] transition-colors"></iconify-icon>Like
                                    </button>
                                </span>
                                <span class="flex items-center gap-1.5 cursor-pointer font-semibold text-[13px] m-0 p-0">
                                    <button class="group border-none bg-transparent text-[#eeeeee] p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-1.5 font-semibold hover:text-[#00ADB5] transition-colors">
                                        <iconify-icon icon="mdi:share" class="text-[20px] w-5 h-5 text-[#eeeeee] m-0 p-0 group-hover:text-[#00ADB5] transition-colors"></iconify-icon>Share
                                    </button>
                                </span>
                                <span class="flex items-center gap-1.5 cursor-pointer font-semibold text-[13px] m-0 p-0">
                                    <button class="bookmark-btn group border-none bg-transparent text-[#eeeeee] p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-1.5 font-semibold hover:text-[#00ADB5] transition-colors" data-id="<?= $problem['id'] ?>">
                                        <iconify-icon 
                                            icon="<?= (isset($problem['is_bookmarked']) && $problem['is_bookmarked'] == 1) ? 'material-symbols:bookmark' : 'material-symbols:bookmark-outline' ?>"
                                            style="<?= (isset($problem['is_bookmarked']) && $problem['is_bookmarked'] == 1) ? 'color: #00ced1;' : '' ?>"
                                            class="text-[20px] w-5 h-5 text-[#eeeeee] m-0 p-0 group-hover:text-[#00ADB5] transition-colors">
                                        </iconify-icon>
                                        Bookmark
                                    </button>
                                </span>
                            </div>
                            <div class="flex gap-[8px] items-center text-white flex-wrap">
                                        <?php if (!empty($problem['tags']) && is_array($problem['tags'])): ?>
                                            <?php foreach ($problem['tags'] as $tagName): ?>
                                                <span class="bg-[#19b3b3] p-[3px_8px] rounded-[10px] text-[12px]">
                                                    <?= htmlspecialchars($tagName) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="bg-gray-500 p-[3px_8px] rounded-[10px] text-[12px]">Umum</span>
                                        <?php endif; ?>

                                        <span class="text-[12px] opacity-70 font-sans italic ml-1">
                                            <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : 'Unknown Date' ?>
                                        </span>
                            </div>
                        </div>
                        
                        <div class="w-full mt-3">
                            <form action="/add-comment" method="POST" class="flex gap-2.5">
                                <input type="hidden" name="problem_id" value="<?= $problem['id'] ?>">
                                <input type="text" name="content" placeholder="Tulis komentar..." required class="w-full box-border border border-[#d1d5db] rounded-[5px] bg-[rgba(31,41,51,0.15)] text-white py-2 px-2.5 outline-none placeholder-[#e6e6e6] focus:border-[#00ced1] transition-all duration-300 placeholder:transition-opacity placeholder:duration-300 focus:placeholder-opacity-30 flex-1">
                                <button type="submit" class="bg-[#00ced1] text-[#eeeeee] px-5 rounded-[5px] font-semibold cursor-pointer border-none transition-all duration-300 hover:opacity-80">
                                    Kirim
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-[1200px] mx-auto py-[15px] px-5 flex flex-col">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="pt-[5px] px-5 pb-[15px]">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-[#ccc] rounded-full shrink-0"></div>
                            <div>
                                <h3 class="m-0 text-[15px] font-bold text-[#222]">
                                    Anonim <span class="text-xs text-[#777] ml-1.5 font-normal">• <?= date('d M Y H:i', strtotime($comment['created_at'])) ?></span>
                                </h3>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-0">
                            <div>
                                <p class="mt-2 mb-[5px] text-sm text-[#555] break-words whitespace-pre-wrap"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                            </div>
                            
                            <div class="flex justify-between items-center p-0 gap-2 w-full">
                                <div class="flex gap-5 text-[#222831] justify-start">
                                    <span class="flex items-center gap-1.5 cursor-pointer font-semibold text-[13px] m-0 p-0">
                                        <button class="group border-none bg-transparent text-[#969696] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-1.5 hover:text-[#00ADB5] transition-colors">
                                            <iconify-icon icon="mdi:like-outline" class="text-[20px] w-5 h-5 text-[#969696] m-0 p-0 group-hover:text-[#00ADB5] transition-colors"></iconify-icon>Like
                                        </button>
                                    </span>
                                    <span class="flex items-center gap-1.5 cursor-pointer font-semibold text-[13px] m-0 p-0">
                                        <button class="group border-none bg-transparent text-[#969696] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-1.5 hover:text-[#00ADB5] transition-colors">
                                            <iconify-icon icon="mdi:share" class="text-[20px] w-5 h-5 text-[#969696] m-0 p-0 group-hover:text-[#00ADB5] transition-colors"></iconify-icon>Share
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-[#888] p-[30px]">
                    <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                </div>
            <?php endif; ?>
            </div>
        </main>
    </div>
    
    <script src="/js/landing.js?v=<?= time() ?>"></script>
</body>
</html>