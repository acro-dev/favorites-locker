<!-- Sort by name -->
<?php

$currentCategory = 'No Category Set';
$listCategory = array();

foreach ($favorites as $fav) {
  $category = ($fav['category'] != NULL) ? $fav['category'] : 'Divers';
  if (!in_array($category, $listCategory)) {
    array_push($listCategory, $category);
  }
}
sort($listCategory);
?>

<div class="quickAdd">
  <form autocomplete="off" action="/favorites/addFavorite" method="POST">
    <input type="text" name="fav-name" id="qa-fav-name" placeholder="Nom du favori" />
    <input type="text" name="fav-url" id="qa-fav-url" placeholder="Url du favori" />
    <input type="submit" value="+" />
  </form>
</div>

<?php
if ($order === "name") {
  require_once '../views/dashboard/sortByName.php';
} else {
  require_once '../views/dashboard/sortByCategory.php';
}
