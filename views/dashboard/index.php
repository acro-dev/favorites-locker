<h1>Dashboard</h1>

<div class="quickAdd">
    <form action="/favorites/addFavorite" method="POST">
        <input type="text" id="url" name="url" placeholder="Ajout rapide d'url">
        <button type="submit">➕</button>
    </form>
</div>

<?php if (!empty($favorites)) : ?>
    <div class="urlTable">
        <?php foreach ($favorites as $favorite) : ?>
            <div class="link-item">
                <div class="url"><a href="<?= $favorite['url']; ?>" target=_blank><?= $favorite['url']; ?></a></div>
                <div class="delete"><a href="/favorites/deleteFavorite/<?= $favorite['id'] ?>">❌</a></div>
                <div class="modify"><a href="/favorites/editFavorite/<?= $favorite['id'] ?>">📄</a></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>