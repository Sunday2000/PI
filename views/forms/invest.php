<div class="form-group">
    <label for="withdrawal_way">Moyen de Retrait</label>
    <input type="text" name="withdrawal_way" id="withdrawal_way" value="<?= $invest->getWithdrawal_way() ?>" class="form-control">
</div>
<div class="form-group">
    <label for="receiver">Compte recepteur</label>
    <input type="text" name="receiver" id="receiver" value="<?= $invest->getReceiver() ?>" class="form-control">
</div>
<div class="form-group">
    <label for="hash_code">Code Hash</label>
    <input type="text" name="hash_code" id="hash_code" value="<?= $invest->getHashCode() ?>" class="form-control">
</div>
<input type="hidden" name="invest_id" value="<?= $invest->getId() ?>">