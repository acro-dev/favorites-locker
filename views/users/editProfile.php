<form action="/users/editProfile/<?= $data['property']; ?>" method="POST">
    <?php var_dump($data); ?>
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <input type="text" name="<?= $data['property']; ?>" id="<?= $data['property']; ?>" value="<?= $data[$property]; ?>">
    <button type="submit">Modifier</button>

</form>