<main>
    <div class="container-fluid">
        <h1 class="mt-4">Gestion des Investissements</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= $router->url("admin-invest") ?>">Investissement</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
        <?php if ( isset($invest_op) ): ?>
            <div class="alert alert-danger">
                Suppression non éffectuée
            </div>
        <?php endif ?>
        <?php if ( isset($update_error) ): ?>
            <div class="alert alert-danger">
                <?= $update_error ?>
            </div>
        <?php endif ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
               Investissement/Bitcoin-Blockchain
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="<?= $router->url("admin-setprice") ?>" method = "POST">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>tel</th>
                                    <th>Amount</th>
                                    <th>Insérer</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>tel</th>
                                    <th>Amount</th>
                                    <th>Insérer</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach( $crypt_invests as $crypt_invest): $invest_user = $crypt_invest->getUser() ?>
                                    <?php if (is_object($invest_user) ):?>
                                        <tr>
                                            <td><?= $invest_user->getName() ?></td>
                                            <td><?= $invest_user->getSurname() ?></td>
                                            <td><?= $invest_user->getEmail()?></td>
                                            <td><?= $invest_user->getTel()?></td>
                                            <td><?= $crypt_invest->getAmount() ?></td>
                                            <td class="form-group w-25"><input class="form-control" type="number" name="price[<?= $crypt_invest->getId() ?>]"></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <button type="submit" class="ml-auto btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
               Investissement/ A Payer
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>tel</th>
                                <th>Amount</th>
                                <th>Adresse Crypto</th>
                                <th>Payé</th>
                                <th>Update</th>
                                <th>Sup.</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>tel</th>
                                <th>Amount</th>
                                <th>Adresse Crypto</th>
                                <th>Payé</th>
                                <th>Update</th>
                                <th>Sup.</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach( $to_pays as $to_pay): $invest_user = $to_pay->getUser() ?>
                                <?php if (is_object($invest_user) ):?>
                                    <tr>
                                        <td><?= $invest_user->getName() ?></a></td>
                                        <td><?= $invest_user->getSurname() ?></td>
                                        <td><?= $invest_user->getEmail()?></td>
                                        <td><?= $invest_user->getTel()?></td>
                                        <td><?= $to_pay->getAmount() ?></td>
                                        <td><?= $to_pay->getReceiver() ?? "-" ?></td>
                                        <?php if ($to_pay->getWithdrawal_way() == $type): ?>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#transfert<?= $to_pay->getId() ?>">Payer</a>
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                --
                                            </td>
                                        <?php endif ?>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#update<?= $to_pay->getId() ?>" class="btn btn-secondary ml-auto">Modifier</a>
                                        </td>
                                        <td>
                                            <a href="<?= $router->url('bpadmin-idelete').$to_pay->getId() ?>" class="btn btn-danger ml-auto">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php  endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
               Investissement/ En cours
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>tel</th>
                                <th>Amount</th>
                                <th>Adresse Crypto</th>
                                <th>Temps Restant</th>
                                <th>Update</th>
                                <th>Sup</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>tel</th>
                                <th>Amount</th>
                                <th>Adresse Crypto</th>
                                <th>Temps Restant</th>
                                <th>Update</th>
                                <th>Sup</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach( $current_invests as $current_invest): $invest_user = $current_invest->getUser() ?>
                                <?php if (is_object($invest_user) ):?>
                                    <tr>
                                        <td><?= $invest_user->getName() ?></a></td>
                                        <td><?= $invest_user->getSurname() ?></td>
                                        <td><?= $invest_user->getEmail()?></td>
                                        <td><?= $invest_user->getTel()?></td>
                                        <td><?= $current_invest->getAmount() ?></td>
                                        <td><?= $current_invest->getReceiver() ?? "-" ?></td>
                                        <td><?= $current_invest->remainDays()?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#update<?= $current_invest->getId() ?>" class="btn btn-secondary ml-auto">Modifier</a>
                                        </td>
                                        <td>
                                            <a href="<?= $router->url('bpadmin-idelete').$current_invest->getId() ?>" class="btn btn-danger ml-auto">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php  endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php foreach ($to_pays as $to_pay): ?>
            <div class="modal fade" id="transfert<?= $to_pay->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="transfertTitle<?= $to_pay->getId() ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transfertTitle<?= $to_pay->getId() ?>">Payer Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $router->url("bpadmin-ipaiement") ?>" method="POST" enctype="multipart/form-data">
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."perfect.php" ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php foreach( $all as $invest): $invest_user = $invest->getUser() ?>
            <div class="modal fade" id="update<?= $invest->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="updateTitle<?= $invest->getId() ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateTitle<?= $invest->getId() ?>">Mettre à jour le client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $router->url("bpadmin-iupdate").$invest->getId() ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="amount">Montant</label>
                                    <input type="number" name="amount" id="amount" value="<?= $invest->getAmount() ?>" class="form-control">
                                </div>
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."invest.php"?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</main>