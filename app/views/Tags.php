<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tags</title>
    <link rel="stylesheet" href="/css/tag.css">

<div class="prob">
    <?php require_once '../app/views/components/navbar.php'?>
    
    <main>
        <h1 class="category-title">Kategori masalah</h1>

        <div class="category-group">
            <h3 class="group-header">Mapel</h3>
            <div class="tag-grid">
                <?php for($i=0; $i<12; $i++): ?>
                    <button class="tag-pill">IPA</button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="category-group">
            <h3 class="group-header">Angkatan</h3>
            <div class="tag-grid">
                <?php for($i=0; $i<12; $i++): ?>
                    <button class="tag-pill">IPA</button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="category-group">
            <h3 class="group-header">Materi</h3>
            <div class="tag-grid">
                <?php for($i=0; $i<10; $i++): ?>
                    <button class="tag-pill">IPA</button>
                <?php endfor; ?>
            </div>
        </div>
    </main>
</div>