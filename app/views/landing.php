<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>landing page</title>
    <style>
        /* SCROLLBAR DIPERBESAR (Tailwind standar belum memiliki utility scrollbar webkit tanpa plugin) */
        .post-scroll::-webkit-scrollbar {
            width: 10px;
            background: #f0f0f0;
        }
        .post-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }
        .post-scroll::-webkit-scrollbar-thumb {
            background: #848484;
            border-radius: 20px;
        }
        .post-scroll::-webkit-scrollbar-button {
            width: 10px;
            height: 0;
            display: none;
        }
        .post-scroll::-webkit-scrollbar-corner {
            background: transparent;
        }
    </style>
</head>
<body class="m-0 p-0 w-full h-full font-sans bg-[#f6f7fb]">
    <div class="flex min-h-screen h-screen">
        <?php require_once '../app/views/components/navbar.php'; ?>
        
        <main class="flex flex-col flex-1 h-screen p-0 m-0 box-border relative">
            
            <div class="w-full flex justify-center items-center relative bg-[#222831] text-white p-[15px_20px] mb-[15px] shadow-[0_1px_6px_rgba(0,0,0,0.06)] box-border">
                <iconify-icon icon="material-symbols:search" class="absolute left-[30px] top-[45%] -translate-y-1/2 text-[#222831] text-[32px] pointer-events-none w-[24px] h-[24px] align-middle"></iconify-icon>
                <input type="text" placeholder="Cari masalah" class="w-full border border-white rounded-[30px] p-[10px_10px_10px_52px] bg-white text-[#111] outline-none box-border">
            </div>

            <div class="post-scroll flex-1 px-[20px] -mt-[15px] overflow-y-auto box-border w-full max-w-full m-0">
                <div class="flex flex-col gap-[15px] m-0 pt-[20px] pb-[15px]">
                    
                    <?php if (!empty($problems)): ?>
                        <?php foreach ($problems as $problem): ?>
                            <div class="bg-white border border-[#EEEEEE] rounded-[10px] shadow-[0_1px_6px_rgba(0,0,0,0.08)] overflow-hidden h-[170px] box-border flex flex-col mx-auto justify-between w-full max-w-[1200px] transition duration-200 hover:scale-[1.03] hover:shadow-[0_1px_6px_rgba(0,0,0,0.2)]">
                                <div onclick="window.location.href='/problem-detail?id=<?= $problem['id'] ?>'" style="cursor: pointer;">
                                    <div class="flex items-center gap-[12px] p-[12px]">
                                        <div class="w-[40px] h-[40px] bg-[#ccc] rounded-full"></div>
                                        <div class="user">
                                            <h3 class="m-0 text-[#111] text-[16px]">Anonim</h3> 
                                            <span class="text-[13px] text-gray-500">Umum</span>
                                        </div>
                                    </div>
                                    <div class="px-[15px] pb-[15px] text-[#333] leading-[1.4] text-[16px] flex-1 break-words">
                                        <strong><?= htmlspecialchars($problem['title']) ?></strong>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center bg-[#2d3142] text-white p-[10px_15px] flex-wrap gap-[8px] mt-auto w-full box-border">
                                    <div class="flex gap-[20px]">
                                        <span class="text-[13px] text-white m-0 p-0">
                                            <button class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                                <iconify-icon icon="mdi:like-outline" class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle"></iconify-icon>Like
                                            </button>
                                        </span>
                                        <span class="text-[13px] text-white m-0 p-0">
                                            <button class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                                <iconify-icon icon="mdi:share" class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle"></iconify-icon>Share
                                            </button>
                                        </span>
                                        <span class="text-[13px] text-white m-0 p-0">
                                            <button class="bookmark-btn bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]" data-id="<?= $problem['id'] ?>">
                                                <iconify-icon 
                                                    icon="<?= (isset($problem['is_bookmarked']) && $problem['is_bookmarked'] == 1) ? 'material-symbols:bookmark' : 'material-symbols:bookmark-outline' ?>"
                                                    style="<?= (isset($problem['is_bookmarked']) && $problem['is_bookmarked'] == 1) ? 'color: #00ced1;' : '' ?>"
                                                    class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle">
                                                </iconify-icon>
                                                Bookmark
                                            </button>
                                        </span>
                                        <span class="text-[13px] text-white m-0 p-0">
                                            <button onclick="window.location.href='/problem-detail?id=<?= $problem['id'] ?>'" class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                                <svg class="w-[20px] h-[20px] fill-[#EEEEEE] transition duration-200 group-hover:fill-[#00ADB5]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.0015 1.09881e-07C8.10862 -0.000280442 6.25454 0.536679 4.65477 1.54846C3.05501 2.56025 1.77526 4.0053 0.964284 5.71564C0.153311 7.42599 -0.155579 9.33138 0.0735211 11.2103C0.302621 13.0893 1.0603 14.8646 2.25849 16.33L0.294488 18.293C0.154679 18.4329 0.0594721 18.611 0.0209045 18.805C-0.017663 18.9989 0.00214001 19.2 0.07781 19.3827C0.15348 19.5654 0.28162 19.7215 0.446029 19.8314C0.610439 19.9413 0.803738 20 1.00149 20H10.0015C12.6537 20 15.1972 18.9464 17.0726 17.0711C18.9479 15.1957 20.0015 12.6522 20.0015 10C20.0015 7.34784 18.9479 4.8043 17.0726 2.92893C15.1972 1.05357 12.6537 1.09881e-07 10.0015 1.09881e-07ZM7.00149 5H13.0015C13.2667 5 13.5211 5.10536 13.7086 5.29289C13.8961 5.48043 14.0015 5.73478 14.0015 6C14.0015 6.26522 13.8961 6.51957 13.7086 6.70711C13.5211 6.89464 13.2667 7 13.0015 7H7.00149C6.73627 7 6.48192 6.89464 6.29438 6.70711C6.10685 6.51957 6.00149 6.26522 6.00149 6C6.00149 5.73478 6.10685 5.48043 6.29438 5.29289C6.48192 5.10536 6.73627 5 7.00149 5ZM13.0015 15H7.00149C6.73627 15 6.48192 14.8946 6.29438 14.7071C6.10685 14.5196 6.00149 14.2652 6.00149 14C6.00149 13.7348 6.10685 13.4804 6.29438 13.2929C6.48192 13.1054 6.73627 13 7.00149 13H13.0015C13.2667 13 13.5211 13.1054 13.7086 13.2929C13.8961 13.4804 14.0015 13.7348 14.0015 14C14.0015 14.2652 13.8961 14.5196 13.7086 14.7071C13.5211 14.8946 13.2667 15 13.0015 15ZM15.0015 11H5.00149C4.73627 11 4.48192 10.8946 4.29438 10.7071C4.10685 10.5196 4.00149 10.2652 4.00149 10C4.00149 9.73478 4.10685 9.48043 4.29438 9.29289C4.48192 9.10536 4.73627 9 5.00149 9H15.0015C15.2667 9 15.5211 9.10536 15.7086 9.29289C15.8961 9 16.0015 9.73478 16.0015 10C16.0015 10.2652 15.8961 10.5196 15.7086 10.7071C15.5211 10.8946 15.2667 11 15.0015 11Z"/>
                                                </svg>Comment
                                            </button>
                                        </span>
                                    </div>
                                    <div class="flex gap-[8px] items-center text-white">
                                        <span class="bg-[#19b3b3] p-[3px_8px] rounded-[10px] text-[12px]">Problem</span>
                                        <span class="text-[12px] opacity-70 font-sans italic">
                                            <?= isset($problem['created_at']) ? date('d M Y', strtotime($problem['created_at'])) : 'Unknown Date' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-[#888] p-[50px]">
                            <p>Belum ada masalah yang diposting. Yuk, buat satu!</p>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white border border-[#EEEEEE] rounded-[10px] shadow-[0_1px_6px_rgba(0,0,0,0.08)] overflow-hidden h-[170px] box-border flex flex-col mx-auto justify-between w-full max-w-[1200px] transition duration-200 hover:scale-[1.03] hover:shadow-[0_1px_6px_rgba(0,0,0,0.2)]">
                        <div onclick="window.location.href='/problem-detail'" style="cursor: pointer;">
                            <div class="flex items-center gap-[12px] p-[12px]">
                                <div class="w-[40px] h-[40px] bg-[#ccc] rounded-full"></div>
                                <div class="user">
                                    <h3 class="m-0 text-[#111] text-[16px]">GPU</h3>
                                    <span class="text-[13px] text-gray-500">XI TKJ 2</span>
                                </div>
                            </div>
                            <div class="px-[15px] pb-[15px] text-[#333] leading-[1.4] text-[16px] flex-1 break-words">
                                Masalah pertama: browser error saat runtime.
                            </div>
                        </div>
                        <div class="flex justify-between items-center bg-[#2d3142] text-white p-[10px_15px] flex-wrap gap-[8px] mt-auto w-full box-border">
                            <div class="flex gap-[20px]">
                                <span class="text-[13px] text-white m-0 p-0">
                                    <button class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                        <iconify-icon icon="mdi:like-outline" class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle"></iconify-icon>Like
                                    </button>
                                </span>
                                <span class="text-[13px] text-white m-0 p-0">
                                    <button class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                        <iconify-icon icon="mdi:share" class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle"></iconify-icon>Share
                                    </button>
                                </span>
                                <span class="text-[13px] text-white m-0 p-0">
                                    <button class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                        <iconify-icon icon="material-symbols:bookmark-outline" class="text-[20px] w-[20px] h-[20px] text-[#eeeeee] group-hover:text-[#00ADB5] align-middle"></iconify-icon>Bookmark
                                    </button>
                                </span>
                                <span class="text-[13px] text-white m-0 p-0">
                                    <button onclick="window.location.href='/detail'" class="bg-transparent text-[#EEEEEE] font-semibold p-0 m-0 text-[13px] cursor-pointer inline-flex items-center gap-[5px] border-none group hover:text-[#00ADB5]">
                                        <svg class="w-[20px] h-[20px] fill-[#EEEEEE] transition duration-200 group-hover:fill-[#00ADB5]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0015 1.09881e-07C8.10862 -0.000280442 6.25454 0.536679 4.65477 1.54846C3.05501 2.56025 1.77526 4.0053 0.964284 5.71564C0.153311 7.42599 -0.155579 9.33138 0.0735211 11.2103C0.302621 13.0893 1.0603 14.8646 2.25849 16.33L0.294488 18.293C0.154679 18.4329 0.0594721 18.611 0.0209045 18.805C-0.017663 18.9989 0.00214001 19.2 0.07781 19.3827C0.15348 19.5654 0.28162 19.7215 0.446029 19.8314C0.610439 19.9413 0.803738 20 1.00149 20H10.0015C12.6537 20 15.1972 18.9464 17.0726 17.0711C18.9479 15.1957 20.0015 12.6522 20.0015 10C20.0015 7.34784 18.9479 4.8043 17.0726 2.92893C15.1972 1.05357 12.6537 1.09881e-07 10.0015 1.09881e-07ZM7.00149 5H13.0015C13.2667 5 13.5211 5.10536 13.7086 5.29289C13.8961 5.48043 14.0015 5.73478 14.0015 6C14.0015 6.26522 13.8961 6.51957 13.7086 6.70711C13.5211 6.89464 13.2667 7 13.0015 7H7.00149C6.73627 7 6.48192 6.89464 6.29438 6.70711C6.10685 6.51957 6.00149 6.26522 6.00149 6C6.00149 5.73478 6.10685 5.48043 6.29438 5.29289C6.48192 5.10536 6.73627 5 7.00149 5ZM13.0015 15H7.00149C6.73627 15 6.48192 14.8946 6.29438 14.7071C6.10685 14.5196 6.00149 14.2652 6.00149 14C6.00149 13.7348 6.10685 13.4804 6.29438 13.2929C6.48192 13.1054 6.73627 13 7.00149 13H13.0015C13.2667 13 13.5211 13.1054 13.7086 13.2929C13.8961 13.4804 14.0015 13.7348 14.0015 14C14.0015 14.2652 13.8961 14.5196 13.7086 14.7071C13.5211 14.8946 13.2667 15 13.0015 15ZM15.0015 11H5.00149C4.73627 11 4.48192 10.8946 4.29438 10.7071C4.10685 10.5196 4.00149 10.2652 4.00149 10C4.00149 9.73478 4.10685 9.48043 4.29438 9.29289C4.48192 9.10536 4.73627 9 5.00149 9H15.0015C15.2667 9 15.5211 9.10536 15.7086 9.29289C15.8961 9.48043 16.0015 9.73478 16.0015 10C16.0015 10.2652 15.8961 10.5196 15.7086 10.7071C15.5211 10.8946 15.2667 11 15.0015 11Z"/>
                                        </svg>Comment
                                    </button>
                                </span>
                            </div>
                            <div class="flex gap-[8px] items-center text-white">
                                <span class="bg-[#19b3b3] p-[3px_8px] rounded-[10px] text-[12px]">IPA</span>
                                <span class="bg-[#19b3b3] p-[3px_8px] rounded-[10px] text-[12px]">XI TKJ 2</span>
                                <span class="text-[12px] opacity-70 font-sans italic">Febuary 30th, 2067</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div onclick="window.location.href='/Problemcreate'" class="absolute bottom-[30px] right-[30px] w-[65px] h-[65px] bg-[#222831] rounded-[16px] flex justify-center items-center cursor-pointer border-2 border-transparent transition-all duration-300 z-[100] shadow-[0_4px_12px_rgba(0,0,0,0.15)] m-0 p-0 hover:scale-110 hover:border-[#00ADB5] hover:shadow-[0_6px_15px_rgba(0,173,181,0.25)] group">
                <div class="text-[#00ADB5] border-[3px] border-[#00ADB5] rounded-full flex items-center justify-center w-[38px] h-[38px] box-border">
                    <iconify-icon icon="mdi:plus" class="text-[26px] w-[26px] h-[26px] flex justify-center items-center m-0 p-0 align-middle"></iconify-icon>
                </div>
            </div>
            
        </main>
    </div>
    <script src="/js/landing.js?v=<?= time() ?>"></script>
</body>
</html>