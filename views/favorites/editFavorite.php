<h1>Editer un favori</h1>
<form action="/favorites/editFavorite/<?= $favorite['id'] ?>" method="POST">
    <!--
    'icon' => null
    'category_id' => null
  -->
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" value="<?= $favorite['name']; ?>">
    <label for="category">Catégorie</label>
    <input type="text" name="category" id="category" value="<?= $favorite['category']; ?>">
    <label for="url">URL</label>
    <input type="text" name="url" id="url" value="<?= $favorite['url']; ?>">
    <button type="submit">Modifier</button>

</form>