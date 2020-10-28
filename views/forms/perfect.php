<div class="form-group">
    <label for="InputLogin">Login</label>
    <input type="text" name="pm_login" class="form-control" id="InputLogin" aria-describedby="login" placeholder="Perfect login">
    <small id="emailHelp" class="form-text text-muted">your Perfect Money login</small>
</div>
<div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" name="pm_pass" class="form-control" id="InputPassword" placeholder="Password">
</div>
<?php if( $router->url("admin") != $_SERVER["REQUEST_URI"] || $router->url("admin-invest") != $_SERVER["REQUEST_URI"]): ?>
    <div class="form-group">
        <label for="WalletId">Wallet_ID</label>
        <input type="text" name="wallet_id" class="form-control" id="WalletId" placeholder="Id de la devise">
    </div>
<?php endif ?>
<div class="form-group">
    <label for="InputReceiver" <?=($router->url("admin") == $_SERVER["REQUEST_URI"] && isset($pret)) || ($router->url("admin-invest") == $_SERVER["REQUEST_URI"] && isset($to_pay)) || ($router->url("bpadmin-paiement") == $_SERVER["REQUEST_URI"] && isset($pret)) ? "hidden":""?> >Compte Perfect recepteur</label>
    <input type="text" name="receiver" class="form-control" id="InputReceiver" <?= ($router->url("admin") == $_SERVER["REQUEST_URI"] && isset($pret)) || ($router->url("bpadmin-paiement") == $_SERVER["REQUEST_URI"] && isset($pret) ) ? "hidden value=".$pret->getReceiver():""?> <?=$router->url("admin-invest") == $_SERVER["REQUEST_URI"] && isset($to_pay) ? "hidden value=".$to_pay->getReceiver():""?> required>
</div>

<div class="form-group">
    <label for="PerfectAmount">Montant à Transférer</label>
    <input type="number" name="pm_amount" class="form-control" id="PerfectAmount" placeholder="Montant à transférer">
</div>
