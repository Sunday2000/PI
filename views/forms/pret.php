<div class="form-group">
    <label for="formGroupExampleInput">Montant</label>
    <input type="number" class="form-control" name="amount" min="0" value="<?= !empty($pret) ? $pret->getAmount():"" ?>" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
    <label for="formGroupExampleInput2">Nombre de mois</label>
    <input type="number" class="form-control" name="date" value="" min="1" id="formGroupExampleInput2" placeholder="">
</div>
<div class="form-group">
    <label for="formGroupExampleInput">Banque</label>
    <input type="text" class="form-control" name="bank" value="<?= !empty($pret) ? $pret->getBank():"" ?>" id="formGroupExampleInput" placeholder="">
</div>
<div class="form-group">
    <label for="formGroupExampleInput2">Numero de compte</label>
    <input type="number" class="form-control" name="bank_number" value="<?= !empty($pret) ? $pret->getBankNumber():"" ?>" min="0" id="formGroupExampleInput2" placeholder="">
</div>
<div class="input-group mb-3">
    <label for="">Si vous n’avez pas un compte en Banque veuillez choisir un mode de paiement </label>
    <select class="custom-select" name="withdrawal_way" id="inputGroupSelect01">
        <option value=""<?= empty($pret) ?"selected":"" ?>>Choose...</option>
        <option value="Western Union" <?= !empty($pret) && $pret->getWithdrawal_way() == "Western Union"?"selected":"" ?>>Western Union</option>
        <option value="Money Gram" <?= !empty($pret) && $pret->getWithdrawal_way() == "Money Gram"?"selected":"" ?>>Money Gram</option>
        <option value="Banco Santander" <?= !empty($pret) && $pret->getWithdrawal_way() == "Banco Santander"?"selected":"" ?>>Banco Santander</option>
        <option value="Perfect Money" <?= !empty($pret) && $pret->getWithdrawal_way() == "Perfect Money"?"selected":"" ?>>Perfect Money</option>
    </select>
</div>