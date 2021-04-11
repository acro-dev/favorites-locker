<!-- Sort by name -->
<?php

$currentCategory = 'No Category Set';
$listCategory = array();

foreach ($data['favorites'] as $fav) {
  $category = ($fav['category'] != NULL) ? $fav['category'] : 'Divers';
  if (!in_array($category, $listCategory)) {
    array_push($listCategory, $category);
  }
}
sort($listCategory);


if ($_COOKIE['sort_fav-' . $_SESSION['userID']] === "category") {
  require_once '../views/dashboard/sortByCategory.php';
} else {
  require_once '../views/dashboard/sortByName.php';
}
