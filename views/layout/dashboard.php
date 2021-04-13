<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/dist/css/style.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <title>Dashboard</title>
</head>

<body>
  <div class="dashboard">
    <div class="sideMenu">
      <div class="sideMenuContent">
        <h2>Favlocker</h2>
        <h3><i class="far fa-star"></i> Mes favoris</h3>
        <ul>
          <li><i class="fas fa-angle-right"></i> <a href="/dashboard/sort-by/name">Lister par nom</a></li>
          <li><i class="fas fa-angle-right"></i> <a href="/dashboard/sort-by/categories">Lister par catégorie</a></li>
          <!-- <li>Mes favoris</li> -->
        </ul>
        <h3><i class="fas fa-filter"></i> Filtrer</h3>
        <ul>
          <?php foreach ($listCategory as $category) : ?>
            <li><i class="fas fa-angle-right"></i> <a href="/dashboard/show-category/<?= slugify($category) ?>"><?= $category ?></a></li>
          <?php endforeach; ?>
        </ul>
        <h3><i class="fas fa-user-edit"></i><?= $_SESSION['username'] ?></h3>
        <ul>
          <li><i class="fas fa-angle-right"></i> <a href="/users/edit/username/<?= $_SESSION['userID'] ?>">Modifier mon nom</li>
          <li><i class="fas fa-angle-right"></i> <a href="/users/edit/username/<?= $_SESSION['userID'] ?>">Modifier mon e-mail</li>
          <li><i class="fas fa-angle-right"></i> <a href="/users/edit/username/<?= $_SESSION['userID'] ?>">Modifier mon mot de passe</li>
        </ul>
        <a class="logout" href="/logout">Se déconnecter</a>
      </div>
    </div>

    <div class="content">
      <?= $content ?>
    </div>
  </div>
</body>

</html>