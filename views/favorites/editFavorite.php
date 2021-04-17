<h1>Éditer un favori</h1>
<form autocomplete="off" action="/favorites/editFavorite/<?= $favorite['id'] ?>" method="POST">
    <!--
    'icon' => null
    'category_id' => null
  -->
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" value="<?= $favorite['name'] ?>">
    <label for="category">Catégorie</label>
    <input list="categories" name="category" id="category" value="<?= $favorite['category'] ?>">
    <datalist id="categories">
        <?php foreach($categories as $category) :?>
        <option><?=$category['name']?></option>
        <?php endforeach; ?>
    </datalist>
    <label for="url">URL</label>
    <input type="text" name="url" id="url" value="<?= $favorite['url'] ?>">
    <button type="submit">Modifier</button>

</form>