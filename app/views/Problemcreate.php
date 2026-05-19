<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem create - WebIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <div class="flex p-0 m-0 min-h-screen bg-[#f6f7fb]">
        
        <?php require_once '../app/views/components/navbar.php'?>
        
        <main class="flex-1 flex justify-start p-6">
            <form action="/Problemcreate<?= isset($_GET['team_id']) ? '?team_id=' . $_GET['team_id'] : '' ?>" method="POST" class="w-full max-w-[1900px]">
                
                <div class="bg-white rounded-lg border border-[#ccc] overflow-hidden flex flex-col">
                    
                    <input type="text" name="title" placeholder="tuliskan judul masalah yang ingin kamu bagikan" required
                           class="w-full p-[15px_20px] text-base border-0 border-b border-[#ccc] outline-none text-[#666] box-border rounded-[4px] transition-all duration-300 ease-in-out placeholder:transition-opacity placeholder:duration-300 focus:outline-none focus:border-[#00ADB5] focus:shadow-[0_0_0_2px_rgba(0,173,181,0.2),0_0_8px_rgba(0,173,181,0.3)] focus:placeholder:opacity-30">
                    
                    <textarea name="content" placeholder="tuliskan masalah yang ingin kamu bagikan" required
                              class="w-full min-h-[150px] p-5 text-sm border-0 border-b border-[#ccc] outline-none resize-none text-[#888] box-border overflow-y-auto rounded-[4px] transition-all duration-300 ease-in-out placeholder:transition-opacity placeholder:duration-300 focus:outline-none focus:border-[#00ADB5] focus:shadow-[0_0_0_2px_rgba(0,173,181,0.2),0_0_8px_rgba(0,173,181,0.3)] focus:placeholder:opacity-30"></textarea>
                    
                    <div class="p-[15px_20px]">
                        <button type="button" class="bg-[#343a40] hover:bg-[#495057] text-white border-none p-[5px_15px] rounded-[20px] cursor-pointer text-sm transition-colors duration-200">+ tag</button>
                    </div>

                    <div class="bg-262d35 bg-[#262d35] text-[#aaa] p-[10px_20px] text-xs flex justify-between items-center">
                        <span class="text-left">Lomen 67, 6767</span>
                        <button type="submit" class="bg-[#00ADB5] hover:bg-[#008c92] text-white border-none p-[8px_18px] rounded-lg cursor-pointer font-bold transition-colors duration-200">Bagikan</button> 
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>