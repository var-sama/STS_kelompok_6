<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem create - WebIn</title>
    <link rel="stylesheet" href="/css/Problem.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <div class="prob">
        <?php require_once '../app/views/components/navbar.php'?>
        
        <main>
            <div class="editor-container">
                <div class="editor-card">
                    <input type="text" class="input-title" placeholder="tuliskan judul masalah yang ingin kamu bagikan">
                    
                    <textarea class="input-content" placeholder="tuliskan masalah yang ingin kamu bagikan"></textarea>
                    
                    <div class="tag-section">
                        <button class="btn-tag">+ tag</button>
                    </div>

                    <div class="card-footer">
                        <span class="footer-text">Lomen 67, 6767</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>