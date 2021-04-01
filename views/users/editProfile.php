<h1>Modifier votre <?= $data['propertyName']; ?></h1>

<form action="/users/editProfile/<?= $data['property']; ?>" method="POST">
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <input type="text" name="<?= $data['property']; ?>" id="<?= $data['property']; ?>" value="<?= $data[$property]; ?>">
    <span class='error'><?= $data['error'] ?></span>
    <button type="submit">Modifier</button>
</form>