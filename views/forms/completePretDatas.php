<section class="signup">
    <div class="container w-50">
        <div class="signup-content">
            <div class="">
                <?php if ( isset($error) ): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif ?>
                <h4 class="form-title">Completez les informations</h4>
                <form method="POST" class="register-form" id="register-form" action="<?= $router->url('updateUser') ?>">
                    <div class="form-group">
                        <label for="profession"><i class="zmdi zmdi-run material-icons-name"></i></label>
                        <input type="text" name="profession" id="profession" class="u_input" placeholder="Profession"/>
                    </div>
                    <div class="form-group">
                        <label for="country"><i class="zmdi zmdi-globe material-icons-name"></i></label>
                        <input type="text" name="country" id="country" class="u_input" placeholder="Country"/>
                    </div>
                    <div class="form-group">
                        <label for="city"><i class="zmdi zmdi-city material-icons-name"></i></label>
                        <input type="text" name="city" id="city" class="u_input" placeholder="City"/>
                    </div>
                    <div class="form-group">
                        <label for="salary"><i class="zmdi zmdi-money material-icons-name"></i></label>
                        <input type="number" name="salary" id="salary" class="u_input" placeholder="Salary"/>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Valider"/>
                    </div>
                </form>
            </div>
            <div class="signup-image my-auto">
                <h5>Information</h5>
                <p>Ces Informations sont importantes car elles nous aident dans le processus de validation d'un Prễt</p>
                <p>Elles doivent donc être juste et valide</p>
                <!--<figure><img src="/images/signup-image.jpg" alt="sing up image"></figure>-->
            </div>
        </div>
    </div>
</section>