
<div class="form-group">
    <input type="text" class="form-control" name="name" value="<?= !empty($admin) ? $admin->getName():'' ?>" placeholder="Name">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="surname" value="<?= !empty($admin) ? $admin->getSurName():'' ?>" placeholder="Surname">
</div>
<div class="form-group">
    <select class="custom-select" name="sex" id="sexe">
        <option value="Masculin">Masculin</option>
        <option value="Feminin">Feminin</option>
    </select>
</div>
<div class="form-group">
    <input type="text" class="form-control" name="email" value="<?= !empty($admin) ? $admin->getEmail():'' ?>" placeholder="Email">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="tel" value="<?= !empty($admin) ? $admin->getTel():'' ?>" placeholder="Telephone">
</div>
<div class="form-group">
    <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Mot de passe">
</div>
<div class="form-group">
    <input type="password" class="form-control" name="re_pass" id="passwordInput" placeholder="Confirmer mot de passe">
</div>
