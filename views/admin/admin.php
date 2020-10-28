<main>
    <div class="container-fluid">
        <h1 class="mt-4">Gestion des Administrateurs</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= $router->url("admin-admin") ?>">Administration</a></li>
            <li class="breadcrumb-item active">Liste</li>
        </ol>
        <?php if ( !empty($error) ): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif ?>
        <?php if ( !empty($delete_error) ): ?>
            <div class="alert alert-danger">
                <?= $delete_error ?>
            </div>
        <?php elseif(isset($delete_error)): ?>
            <?php dump($delete_error) ?>
            <div class="alert alert-success">
                Supression éffectuée avec succès
            </div>
        <?php endif ?>
        <?php if ( !empty($pass_error) ): ?>
            <div class="alert alert-danger">
                <?= $pass_error ?>
            </div>
        <?php endif ?>
        <div class="card mb-4">
            <div class="card-header row">
                <p><i class="fas fa-table mr-1"></i>Liste des Administrateurs</p>
                <a href="" data-toggle="modal" data-target="#create" class="btn btn-primary ml-auto mr-5">Créer</a>
            </div>
            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTitle">Créer Administrateur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $router->url("bpadmin-acreate")?>" id="register-form" method="POST">
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."admin.php"?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
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
                                <th>sexe</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>tel</th>
                                <th>sexe</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach( $admins as $admin): ?>
                                <?php if (is_object($admin) ):?>
                                    <tr>
                                        <td><?= $admin->getName() ?></td>
                                        <td><?= $admin->getSurname() ?></td>
                                        <td><?= $admin->getEmail()?></td>
                                        <td><?= $admin->getTel()?></td>
                                        <td><?= $admin->getSex()?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#update<?= $admin->getId() ?>" class="btn btn-secondary d-inline">Modifier</a>
                                            <a href="<?= $router->url('bpadmin-adelete').$admin->getId() ?>" class="btn btn-danger d-inline">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php  endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php foreach( $admins as $admin): ?>
            <div class="modal fade" id="update<?= $admin->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="updateTitle<?= $admin->getId() ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateTitle<?= $admin->getId() ?>">Mettre à jour le client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= $router->url("bpadmin-aupdate").$admin->getId() ?>" method="POST">
                                <?php include dirname(__DIR__).DIRECTORY_SEPARATOR."forms".DIRECTORY_SEPARATOR."admin.php"?>
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