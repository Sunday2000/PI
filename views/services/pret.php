<main>
    <div class="container-fluid">
        <?php if ( isset( $match['params']['login'] ) ): ?>
            <!--<div class="alert alert-success">
                Vous êtes bien connecté 
            </div>-->
        <?php endif ?>
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Prêt</li>
        </ol>
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
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="row card-body">
                        <span class="col-5">
                            Balance
                        </span>
                        <span class="offset-3 ml-auto">
                            <?= $user->getBalance() ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#" <?= $user->getBalance() > 0 ? 'data-toggle="modal" data-target="#modal"':""?>><?= $user->getBalance() > 0 ?"Retrait":"Attendre validation" ?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <?php if ( $user->getBalance() > 0 && $pret && $pret->getWithdrawal_way() == "Perfect Money" ): ?>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalTitle">Retrait Perfect Money</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?= $router->url('pret-perfect')?>">
                                    <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."perfect.php" ?>
                                    <?php if ( $pret ): ?>
                                        <input type="hidden" name="pret_id" value="<?= $pret->getId() ?>">
                                    <?php endif ?>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif( $user->getBalance() > 0 ): ?>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalTitle">Payement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">Prêt - Créer</div>
                    <div class="row card-body">
                        <span class="ml-3">
                            <?= $pret ? $pret->getCreated_at()->format('d-m-Y à H:i'):"Pas de pret en cours" ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">Prêt - Montant</div>
                    <div class="row card-body">
                        <span class="ml-3">
                            <?= $pret ? $pret->getAmountRated():"Pas de pret en cours"; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">Prêt - Temps restant</div>
                    <div class="row card-body">
                        <span class="ml-3">
                            <?= $pret ? $pret->timeRemain():"Pas de pret en cours"; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <h5>Fichiers</h5>
        <div class="row">
            <div class="col-12 mb-4">
                <?php if ( !empty($userFiles) ): ?>
                    <div class="row">
                        <?php foreach( $userFiles as $file): $name = explode(DIRECTORY_SEPARATOR, $file);?>
                            <div class="col-3">
                                <a href="<?= explode('public', $file)[1] ?>"><?= $name[count($name) - 1] ?></a>
                            </div>
                        <?php endforeach ?>
                    </div>                   
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <?php if ( !empty($pret_error) ): ?>
                    <div class="alert alert-danger">
                        <?= $pret_error ?>
                    </div>
                <?php endif ?>
                <?php if ( $pret_op === false): ?>
                    <div class="alert alert-danger">
                        Suppression non éffectuée
                    </div>
                <?php elseif( $pret_op === true): ?>
                    <div class="alert alert-success">
                        Suppression  éffectuée avec succès
                    </div>
                <?php endif?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-money-bill"></i>
                        <?php if ( $pret ): ?>
                            Modifier Prêt
                        <?php else :?>
                            Faire un Prêt
                        <?php endif ?>

                    </div>
                    <div class="card-body">
                        
                        <form action="<?= $pret ? $router->url('pret-update'): $router->url('pret-create')?>" method="post">
                            <?php include dirname(__DIR__).DIRECTORY_SEPARATOR.'forms'.DIRECTORY_SEPARATOR.'pret.php'; ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary d-inline"><?= $pret ? "Modifier":"Soumettre" ?></button>
                            </div>
                        </form>
                        <?php if ( $pret ): ?>
                            <form method="POST" action="<?= $router->url("pret-delete") ?>" class="form-group d-inline">
                               <button type="submit" class="btn btn-danger ml-auto">Supprimer</button>
                            </form >
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Etapes de Validation d'un prêt
                    </div>
                    <div class="card-body">
                        
                        <div class="list-group-item <?= $pret ? "list-group-item-primary":"" ?>">Remplir le formulaire à gauche</div>
                        <br>
                        <div class="list-group-item <?= $pret && $pret->processStart(ROOT) ? "list-group-item-primary":"" ?>">Remplir et soumettre les documents recus</div>
                            <?php if ( is_string($file_error) ): ?>
                                <div class="alert alert-danger mt-2">
                                    <?= $file_error ?>
                                </div>
                            <?php elseif (is_bool($file_error)): ?>
                                <div class="alert alert-success mt-2">
                                    Soumission réussie
                                </div>
                            <?php endif ?>
                            <?php if( $pret ): ?>
                                <form action="<?= $router->url("pret-file") ?>" method="post" enctype="multipart/form-data" class="mt-2">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Soumettre</button>
                                </form>
                            <?php endif ?>
                        <br>
                        <div class="list-group-item <?= $pret && $pret->getValidate() ?"list-group-item-primary":"" ?>">Demande Validée</div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
