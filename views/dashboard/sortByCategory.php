<div class="categoryDisplay">
    <?php
    $currentCategory = 'No Category Set';
    ?>

    <?php foreach ($favorites as $fav) : ?>
        <?php
        if ($fav['category'] !== $currentCategory) {
            if ($currentCategory !== 'No Category Set') {
                echo '</div>';
            }
            echo '<div class="categoryList">';
            $category = $fav['category'] ?? 'Divers';
            echo '<h2>' . $category . '</h2>';
            $currentCategory = $fav['category'];
        }
        ?>

        <div class="fav-item">
            <a href="<?= $fav['url'] ?>" target=_blank>
                <div class="fav-top">
                    <div class="fav-link">
                        <?= $fav['name'] ?>
                    </div>
                    <div class="fas fa-external-link-alt"></div>
                </div>
            </a>
            <div class="fav-bottom">
                <div class="fav-delete">
                    <a href="/favorites/deleteFavorite/<?= $fav['id'] ?>">
                        <i class="far fa-trash-alt"></i> Delete
                    </a>
                </div>
                <div class="fav-modify">
                    <a href="/favorites/editFavorite/<?= $fav['id'] ?>">
                        <i class="far fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
</div>