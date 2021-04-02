<h1>Modifier votre <?= $data['propertyName']; ?></h1>

<form class="inlineForm" action="/users/editProfile/<?= $data['property']; ?>" method="POST">
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <div class="row">
        <div class="col-12 col-sm col-xl-4 mb-3">
            <input class="form-control" type="text" name="<?= $data['property']; ?>" id="<?= $data['property']; ?>" value="<?= $data[$property]; ?>">
            <div class="form-text text-danger"><?= $data['error'] ?></div>
        </div>
        <div class="col-12 col-sm-auto d-grid d-sm-block">
            <button class="btn btn-primary" type="submit">Modifier</button>
        </div>
    </div>
</form>