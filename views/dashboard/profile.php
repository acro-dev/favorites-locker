<h1>Profile</h1>
<div>
    Nom d'utilisateur : <?= ucfirst($data['username']); ?>
    <div><a href="/users/editProfile/username">Modifier</a></div>
</div>
<div>
    Adresse Email : <?= $data['email']; ?>
    <div><a href="/users/editProfile/email">Modifier</a></div>
</div>