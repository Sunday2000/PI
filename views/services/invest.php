<main>
    <div class="container-fluid">
        <?php if ( !empty($invests) ): ?>
            <ol class="breadcrumb mb-4 mt-1">
                <li class="breadcrumb-item align-self-center">Investissement Total: <?= $user->totalInvest() ?></li>
                <!--<li class="btn btn-primary ml-auto" ></li>-->
                <li class="btn-group dropleft ml-auto">
                    <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."makeInvestButton.php" ?>
                </li>
            </ol>
        <?php endif ?>
        <?php if ( isset($match["params"]["days"]) && empty($match["params"]["days"]) ): ?>
            <div class="alert alert-danger">
                Veuillez attendre la fin des <?= $invest_days ?> jours
            </div>
        <?php endif ?>
        <?php if ( isset($match["params"]["success"]) && empty($match["params"]["success"]) ): ?>
            <div class="alert alert-danger">
                Erreur lors de la demande de retrait
            </div>
        <?php elseif (isset($match["params"]["success"]) && !empty($match["params"]["success"]) ): ?>
            <div class="alert alert-success">
                Demande éffectuée avec succès
            </div>
        <?php endif ?>
        <?php if ( !empty($pm_transfert_error) ): ?>
            <div class="alert alert-danger">
                <?= $pm_transfert_error ?>
            </div>
        <?php endif ?>
        <?php if ( !empty($pm_tranfert) ): ?>
            <div class="alert alert-success">
                <?= $pm_tranfert ?>
            </div>
        <?php endif ?>
        <div class="row">
            <?php if ( empty($invests) ): ?>
                <div class="col-4 mx-auto mt-5">
                    <div class="card text-center shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <h5 class="card-title ">Investissement</h5>
                            <p class="card-text">Faites vos Investissements en toute sécurité et Gagnez<b> 25% </b> à chaque investissement</p>
                            <div class="mb-1 font-weight-bold">Balance</div>
                            <div class="mb-3 font-weight-bold">0</div> 
                            <div class="btn-group dropright">
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."layout".DIRECTORY_SEPARATOR."makeInvestButton.php" ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach($invests as $invest) :?>
                    <div class="col-4 mt-3">
                        <div class="card text-center shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <h5 class="card-title ">Investissement</h5>
                                <div class="row">
                                    <div class="col-6 text-right">Dépot:</div>
                                    <div class="col-6 text-left"><?= $invest->getAmount() ?></div>                                
                                </div>
                                <div class="row">
                                    <div class="col-6 text-right">Jours:</div>
                                    <div class="col-6 text-left"><?= $invest->remainDays() ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-6 text-right">Profits:</div>
                                    <div class="col-6 text-left"><?= $invest->profit() ?>$</div>
                                </div>
                                <?php if ( empty($invest->getAmount()) && !empty($invest->getHashCode()) ) :?>
                                    <p class="text-muted mt-2">En attente de Validation</p>
                                <?php else: ?>
                                    <p class="text-muted mt-2">créer le <?= $invest->getCreated_at()->format('d-m-Y à H:i')?></p>
                                <?php endif ?>
                                
                                <?php if ( $invest->getAmount() > 0 ) :?>
                                    <form action="<?= $router->url("invest-crypto") ?>" method="post">
                                        <input type="text" name="makeRequest" value="<?= $invest->getId() ?>" hidden>
                                        <button class="btn btn-primary "><!--Demande de--> retrait</button>
                                    </form>
                                <?php elseif( $invest->getAmount() == 0 ): ?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#EnoughtAmount">Demande de retrait</button>
                                <?php endif ?>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach?>
            <?php endif ?>
            <!-- Modal -->
            <div class="modal fade" id="PerfectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Investir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $router->url("invest-perfect") ?>" method="POST">
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."perfect.php"?>
                                <input type="text" name="withdrawal_way" value="<?= $perfect ?>" hidden>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="CryptoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Envoyer le montant à </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h6>Adresse Blockchain</h6>
                            <div class="row">
                                <hr class="col-4">ou <hr class="col-4">
                            </div>
                            <h6>Adresse Bitcoin</h6>
                            <div class="row">
                                <hr class="col-4">ou <hr class="col-4">
                            </div>
                            <form action="<?= $router->url("invest-hash") ?>" method="POST">
                                <div class="form-group">
                                    <label for="hashCode">Code Hash du transfert</label>
                                    <input type="text" name="hash_code" class="form-control" id="hashCode" required>
                                    <input type="hidden" name="amount" value="0">
                                    <input type="hidden" name="date" value="<?= $invest_days ?>">
                                </div>
                                <div class="form-group">
                                    <label for="InputReceiver" >Compte Perfect recepteur</label>
                                    <input type="text" name="receiver" class="form-control" id="InputReceiver" required>
                                </div>
                                <input type="text" name="withdrawal_way" value="<?= $crypto ?>" hidden>
                                <button type="submit" class="btn btn-primary">Soumettre</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EnoughtAmount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Envoyer le montant à </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            Montant insuffisant <br>
                            Veuillez attendre la validation
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>