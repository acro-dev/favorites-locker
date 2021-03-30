<form action="/favorites/editFavorite" method="POST">
    <!--
  'icon' => null
  'category_id' => null
-->
    <input type="hidden" name="id" value="<?= $favorite['id']; ?>">
    <input type="text" name="name" id="name" value="<?= $favorite['name']; ?>">
    <input type="text" name="url" id="url" value="<?= $favorite['url']; ?>">
    <button type="submit">Modifier</button>

</form>