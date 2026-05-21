<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tags</title>
    <link rel="stylesheet" href="/css/output.css">
</head>
<body>
    <div class="flex min-h-screen w-full overflow-x-hidden">
    <?php require_once '../app/views/components/navbar.php'?>
    
    <main class="flex-1 flex flex-col p-[30px_40px] bg-white gap-5">
        <h1 class="text-[26px] font-bold text-black mb-2.5">Kategori masalah</h1>

        <div class="flex flex-col gap-2.5">
            <h3 class="text-[14px] font-bold text-black">Mapel</h3>
            <div class="grid grid-cols-[repeat(auto-fill,minmax(140px,1fr))] gap-3 w-full">
                <?php for($i=0; $i<1; $i++): ?>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">PPL</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">PDL</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">PWL</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">PJOK</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">BI</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">ING</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">MAN</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">DAMI</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">PKN</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TLJ</a>
                    <a href="Problemcreate" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">SJRH</a>
                <?php endfor; ?>
            </div>
        </div>

        <div class="flex flex-col gap-2.5">
            <h3 class="text-[14px] font-bold text-black">Angkatan</h3>
            <div class="grid grid-cols-[repeat(auto-fill,minmax(140px,1fr))] gap-3 w-full">
                <?php for($i=0; $i<1; $i++): ?>
                    <a href="" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TKJ</a>
                    <a href="" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">AKL</a>
                    <a href="" class="block w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center no-underline cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">BID</a>
                <?php endfor; ?>
            </div>
        </div>

        <div class="flex flex-col gap-2.5">
            <h3 class="text-[14px] font-bold text-black">Materi</h3>
            <div class="grid grid-cols-[repeat(auto-fill,minmax(140px,1fr))] gap-3 w-full">
                <?php for($i=0; $i<1; $i++): ?>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 1</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 2</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 3</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 4</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 5</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 6</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 7</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 8</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 9</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 10</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 11</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 12</button>
                    <button class="w-full bg-[#00a8a8] text-white py-2 rounded-[20px] text-[13px] text-center border-none cursor-pointer transition-colors duration-200 hover:bg-[#008b8b]">TP 13</button>
                <?php endfor; ?>
            </div>
        </div>
    </main>
</div>
</body>
