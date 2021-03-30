<h1>Dashboard</h1>

<div class="quickAdd">
    <form action="/favorites/addFavorite" method="POST">
        <input type="text" id="name" name="name" placeholder="Nom">
        <input type="text" id="url" name="url" placeholder="url *">
        <button type="submit">➕</button>
    </form>
</div>

<?php if (!empty($favorites)) : ?>
    <div class="urlTable">
        <?php foreach ($favorites as $favorite) : ?>
            <div class="link-item">
                <div class="url"><a href="<?= $favorite['url']; ?>" target=_blank>
                        <?php if ($favorite['name'] != '') : ?>
                            <span class="name"><?= $favorite['name']; ?></span>
                        <?php else : ?>
                            📎 <?= $favorite['url']; ?>
                        <?php endif; ?>
                    </a></div>

                <div class="delete"><a href="/favorites/deleteFavorite/<?= $favorite['id'] ?>">❌</a></div>
                <div class="modify"><a href="/favorites/editFavorite/<?= $favorite['id'] ?>">📄</a></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>