<!-- Sort by name -->
<div class="quickAdd">
    <form autocomplete="off" action="/favorites/addFavorite" method="POST">
        <input type="text" name="fav-name" id="qa-fav-name" placeholder="Nom du favori"/>
        <input type="text" name="fav-url" id="qa-fav-url" placeholder="Url du favori"/>
        <input type="submit" value="+"/>
    </form>
</div>

<?php
if (!empty($favorites)) {
    if ($view === 'by-name') {
        require_once '../views/dashboard/sortByName.php';
    } else {
        require_once '../views/dashboard/sortByCategory.php';
    }
} else {
    echo 'Pas de favoris enregistré !';
}
