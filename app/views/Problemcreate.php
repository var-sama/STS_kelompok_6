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
                    
                    <div class="p-[15px_20px] relative flex flex-wrap items-center gap-2 border-b border-[#ccc] min-h-[65px]">
                        
                        <div id="selected-tags-container" class="flex flex-wrap items-center gap-2"></div>

                        <div class="relative inline-flex items-center">
                            <button type="button" id="btn-toggle-tag" class="bg-[#343a40] hover:bg-[#495057] text-white border-none px-4 rounded-[20px] cursor-pointer text-sm transition-colors duration-200 h-[30px] inline-flex items-center justify-center leading-none">
                                <span class="relative top-[-1px]">+ tag</span>
                            </button>

                            <div id="tag-popup" class="hidden absolute bottom-[130%] w-[250px] bg-white border border-[#ccc] rounded-lg shadow-xl z-50 p-3 flex flex-col gap-2 transition-all">
                                <input type="text" id="search-tag-input" placeholder="Cari tag..." 
                                       class="w-full p-2 text-xs border border-[#ccc] rounded outline-none focus:border-[#00ADB5]">
                                
                                <div id="tag-list-results" class="max-h-[150px] overflow-y-auto flex flex-col gap-1">
                                    </div>
                            </div>
                        </div>

                        <div id="hidden-inputs-container"></div>
                    </div>

                    <div class="bg-262d35 bg-[#262d35] text-[#aaa] p-[10px_20px] text-xs flex justify-between items-center">
                        <span class="text-left">Lomen 67, 6767</span>
                        <button type="submit" class="bg-[#00ADB5] hover:bg-[#008c92] text-white border-none p-[8px_18px] rounded-lg cursor-pointer font-bold transition-colors duration-200">Bagikan</button> 
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script>
        const masterTags = <?php echo json_encode(isset($tags) ? $tags : []); ?>;
        let selectedTags = []; 

        const btnToggleTag = document.getElementById('btn-toggle-tag');
        const tagPopup = document.getElementById('tag-popup');
        const searchTagInput = document.getElementById('search-tag-input');
        const tagListResults = document.getElementById('tag-list-results');
        const selectedTagsContainer = document.getElementById('selected-tags-container');
        const hiddenInputsContainer = document.getElementById('hidden-inputs-container');

        btnToggleTag.addEventListener('click', (e) => {
            e.stopPropagation();
            tagPopup.classList.toggle('hidden');
            
            if (!tagPopup.classList.contains('hidden')) {
                const rect = btnToggleTag.getBoundingClientRect();
                const distanceToRightEdge = window.innerWidth - rect.right;
                
                if (distanceToRightEdge < 280) {
                    tagPopup.classList.remove('left-0');
                    tagPopup.classList.add('right-0');
                } else {
                    tagPopup.classList.remove('right-0');
                    tagPopup.classList.add('left-0');
                }

                searchTagInput.value = '';
                searchTagInput.focus();
                renderAvailableTags('');
            }
        });

        searchTagInput.addEventListener('input', (e) => {
            renderAvailableTags(e.target.value);
        });

        document.addEventListener('click', (e) => {
            if (!tagPopup.contains(e.target) && e.target !== btnToggleTag) {
                tagPopup.classList.add('hidden');
            }
        });

        function renderAvailableTags(query) {
            tagListResults.innerHTML = '';
            
            const filtered = masterTags.filter(tag => {
                const matchesQuery = tag.name.toLowerCase().includes(query.toLowerCase());
                const isNotSelected = !selectedTags.some(sel => sel.id == tag.id);
                return matchesQuery && isNotSelected;
            });

            if (filtered.length === 0) {
                tagListResults.innerHTML = `<span class="text-xs text-grey-500/[0.3] italic p-1">Tag tidak tersedia</span>`;
                return;
            }

            filtered.forEach(tag => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'w-full text-left p-1.5 text-xs text-gray-700 hover:bg-[#00ADB5] hover:text-white rounded transition-colors duration-150';
                btn.textContent = tag.name;
                btn.addEventListener('click', () => {
                    addTag(tag.id, tag.name);
                });
                tagListResults.appendChild(btn);
            });
        }

        function addTag(id, name) {
            selectedTags.push({ id, name });
            updateSelectedTagsUI();
            tagPopup.classList.add('hidden'); 
        }

        function removeTag(id) {
            selectedTags = selectedTags.filter(tag => tag.id != id);
            updateSelectedTagsUI();
        }

        // Tampilan Tag yang Dipilih
        function updateSelectedTagsUI() {
            selectedTagsContainer.innerHTML = '';
            hiddenInputsContainer.innerHTML = '';

            selectedTags.forEach(tag => {
                const badge = document.createElement('span');
                // PERBAIKAN: Gunakan inline-flex, hapus padding Y, gunakan leading-none
                badge.className = 'inline-flex items-center justify-center gap-1 bg-[#00ADB5] text-white px-3 h-[30px] rounded-[20px] text-xs font-medium animate-fade-in box-border leading-none';
                badge.innerHTML = `
                    <span class="relative top-[-1px]">${tag.name}</span>
                    <button type="button" class="ml-0.5 flex items-center justify-center bg-transparent border-none text-white cursor-pointer hover:text-red-200 transition-colors focus:outline-none" onclick="removeTag(${tag.id})">
                        <iconify-icon icon="mdi:close" class="text-[14px]"></iconify-icon>
                    </button>
                `;
                selectedTagsContainer.appendChild(badge);

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'tags[]';
                hiddenInput.value = tag.id;
                hiddenInputsContainer.appendChild(hiddenInput);
            });
        }
    </script>
</body>
</html>