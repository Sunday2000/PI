<main>
    <div class="container">
        <h2 class="mt-4">Gestion des Prêts</h2>
        
        <ol class="breadcrumb mx-auto mb-4 ">
            <li class="breadcrumb-item"><a href="<?= $router->url("admin") ?>">Prêt</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
        <?php if ( !empty($pm_transfert_error) ): ?>
            <div class="alert alert-danger">
                <?= $pm_transfert_error ?>
            </div>
        <?php endif ?>
        <?php if ( !empty($pret_error) ): ?>
            <div class="alert alert-danger">
                <?= $pret_error ?>
            </div>
        <?php endif ?>
        <?php if ( !empty($pm_tranfert) ): ?>
            <div class="alert alert-success">
                <?= $pm_tranfert ?>
            </div>
        <?php endif ?>
        <?php if ( is_string($file_error) ): ?>
            <div class="alert alert-danger mt-2">
                <?= $file_error ?>
            </div>
        <?php elseif (is_bool($file_error)): ?>
            <div class="alert alert-success mt-2">
                Soumission réussie
            </div>
        <?php endif ?>
        <?php if ( isset($pret_op) ): ?>
            <div class="alert alert-danger">
                Suppression non éffectuée
            </div>
        <?php endif ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Liste Personne - Prêt
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="<?= $router->url("bpadmin-validate") ?>" method = "POST">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Amount</th>
                                    <th>Retrait</th>
                                    <th>Payé</th>
                                    <th>Fichiers</th>
                                    <th>Val.</th>
                                    <th>Trans</th>
                                    <th>Update.</th>
                                    <th>Sup.</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Amount</th>
                                    <th>Retrait</th>
                                    <th>Payé</th>
                                    <th>Fichiers</th>
                                    <th>Val</th>
                                    <th>Trans</th>
                                    <th>Update</th>
                                    <th>Sup.</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach( $prets as $pret): $pret_user = $pret->getUser() ?>
                                    <tr>
                                        <td><a href="#" data-toggle="modal" data-target="#modal<?= $pret_user->getId() ?>"><?= $pret_user->getName() ?></a></td>
                                        <td><?= $pret_user->getSurname() ?></td>
                                        <td><?= $pret->getAmount() ?></td>
                                        <td><?= $pret->withdrawalWay() ?></td>
                                        <td><?= $pret->checkPayement() ?></td>
                                        <td>
                                            <?php $files = $pret->files(ROOT); ?>
                                            <?php if ( !empty($files) ): ?>
                                                <?php foreach( $files as $file): $name = explode(DIRECTORY_SEPARATOR, $file)?>
                                                    <a href="<?= explode("public", $file)[1] ?>"><?= $name[count($name) - 1] ?></a>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                Aucun
                                            <?php endif ?>
                                        </td>
                                        <td><input type="checkbox" name="validate[]" value="<?=$pret->getId()?>" <?= $pret->getValidate() ? "checked":"" ?>></td>
                                        <?php if ( !empty( $pret->getReceiver() ) ):?>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#transfert<?= $pret_user->getId() ?>">Payer</a>
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                --
                                            </td>
                                        <?php endif ?>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#update<?= $pret_user->getId() ?>" class="btn btn-secondary ml-auto">Mettre à jour</a>
                                        </td>
                                        <td>
                                            <a href="<?= $router->url('bpadmin-delete').$pret->getId() ?>" class="btn btn-danger ml-auto">Supprimer</a>    
                                        </td>
                                    </tr>
                        
                                    <div class="modal fade" id="modal<?= $pret_user->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTitle<?= $pret_user->getId() ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalTitle<?= $pret_user->getId() ?>">Client</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row"><div class="col-3">Nom:</div><?= $pret_user->getName() ?></div>
                                                    <div class="row"><div class="col-3">Prénom:</div><?= $pret_user->getSurname() ?></div>
                                                    <div class="row"><div class="col-3">Email:</div><?= $pret_user->getEmail()?></div>
                                                    <div class="row"><div class="col-3">Profession:</div> <?= $pret_user->getProfession()?></div>
                                                    <div class="row"><div class="col-3">Pays:</div>       <?= $pret_user->getCountry()?></div>
                                                    <div class="row"><div class="col-3">Ville:</div>      <?= $pret_user->getCity()?></div>
                                                    <div class="row"><div class="col-3">Sexe:</div>       <?= $pret_user->getSex()?></div>
                                                    <div class="row"><div class="col-3">Salaire</div>     <?= $pret_user->getSalary()?></div>
                                                    <div class="row"><div class="col-3">Téléphone:</div>  <?= $pret_user->getTel()?></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <button type="submit" class="ml-auto btn btn-primary">Valider</button>
                    </form>
                    <?php foreach( $prets as $pret): $pret_user = $pret->getUser() ?>
                        <div class="modal fade" id="update<?= $pret_user->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="updateTitle<?= $pret_user->getId() ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateTitle<?= $pret_user->getId() ?>">Mettre à jour le client</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= $router->url("admin-pupdate").$pret->getId() ?>" method="POST" enctype="multipart/form-data">
                                            <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."pret.php" ?>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="transfert<?= $pret_user->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="transfertTitle<?= $pret_user->getId() ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transfertTitle<?= $pret_user->getId() ?>">Payer Client</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= $router->url("bpadmin-paiement") ?>" method="POST" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                    <input type="number" hidden name="pret_id" value="<?= $pret->getId() ?>">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </div>
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
                </div>
            </div>
        </div>
    </div>
</main>