<h1>Dashboard</h1>
<div class="row">
    <h2>Ajout rapide :</h2>
    <form action="/favorites/addFavorite" method="POST">
        <div class="row">
            <div class="col-12 col-sm-4 mb-3">
                <input class="form-control" type="text" id="name" name="name" placeholder="Nom">
            </div>
            <div class="col-12 col-sm mb-3">
                <input class="form-control" type="text" id="url" name="url" placeholder="url *">
            </div>
            <div class="col-12 col-md-auto d-grid mb-3">
                <button class=" btn btn-primary" type="submit">Ajouter favori</button>
            </div>
        </div>
    </form>
</div>
<?php if (!empty($favorites)) : ?>
    <div class="row">
        <div class="col">
            Trier par : <a href="/dashboard/index/category">Categories</a> / <a href="/dashboard/index">Nom</a>
        </div>
    </div>
    <div class="row mt-5">
        <h2>Liste de vos favoris :</h2>
        <div class="col col-md-8 col-lg-6">
            <?php foreach ($favorites as $favorite) : ?>
                <div class="row">
                    <div class="col">
                        <a href="<?= $favorite['url']; ?>" target=_blank>
                            <?php if ($favorite['name'] != '') : ?>
                                <span class="name"><?= $favorite['name']; ?></span>
                            <?php else : ?>
                                📎 <?= $favorite['url']; ?>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="col">
                        <?php
                        $category = empty($favorite['category']) ? "Catégorie par défaut" : $favorite['category'];
                        echo $category;
                        ?>
                    </div>
                    <div class="col-auto"><a href="/favorites/deleteFavorite/<?= $favorite['id'] ?>">❌</a></div>
                    <div class="col-auto"><a href="/favorites/editFavorite/<?= $favorite['id'] ?>">📄</a></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>