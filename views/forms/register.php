<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="">
                <?php if ( $pass_error ): ?>
                    <div class="alert alert-danger">
                        Les mot de passe ne sont pas identiques
                    </div>
                <?php endif ?>
                <?php if ( $error ): ?>
                    <div class="alert alert-danger">
                        <?=$error ?>
                    </div>
                <?php endif ?>
                <h2 class="form-title">Sign up</h2>
                <form method="POST" class="register-form" id="register-form" action="<?= $router->url('register') ?>">
                    
                    <div class="form-group">
                        <label for="surname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="surname" id="surname" class="u_input" placeholder="First name"/>
                    </div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" class="u_input" placeholder="Name"/>
                    </div>
                    <div class="form-group">
                        <label for="tel"><i class="zmdi zmdi-phone material-icons-name"></i></label>
                        <input type="tel" name="tel" id="tel" class="u_input" placeholder="Your Tel"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" class="u_input" placeholder="Your Email"/>
                    </div>
                    <div class="form-group">
                        <label for="sex"><i class="zmdi zmdi-male-female"></i></label>
                        <select name="sex" id="sex" class="">
                            <option value="M" selected >Masculin</option>
                            <option value="F">Feminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="pass" class="u_input" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" class="u_input" placeholder="Repeat your password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="" />
                        <label for="terms" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="/images/signup-image.jpg" alt="sing up image"></figure>
                <center><a href="<?= $router->url('login') ?>" class="text-primary m-auto">I am already member</a></center>
            </div>
        </div>
    </div>
</section>
