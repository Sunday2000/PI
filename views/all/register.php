<!-- Sign up form -->
<?php

use App\App;

$error = null;

$pdo = App::getPDO();

$query = $pdo->prepare("SELECT id, name FROM service");
$query->execute();
$services = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_POST)
{

    $insert = App::getAuth();

    $error = ($_POST['password'] === $_POST['re_pass']) ? false : true;

    if ( ! $error)
    {

        if ( ! (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['tel']) || 
        empty($_POST['email']) || empty($_POST['password']) || empty($_POST['terms']) || empty($_POST['service']) ) )
        {
            $success = $insert->register($_POST);
            
            if ( $success )
            {
                $login_path = $router->url('register-success').'success';
                header("Location: $login_path ");
            }
        }
        
    }

}
    
?>

<section class="signup">
    <div class="container">
        <?php if ( $error ): ?>
            <div class="alert alert-danger">
                Les mot de passe ne sont pas identiques
            </div>
        <?php endif ?>
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" class="register-form" id="register-form" method ="<?= $router->url('register') ?>">
                    <div class="form-group">
                        <label for="surname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="surname" id="surname" class="u_input" placeholder="Your first name"/>
                    </div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" class="u_input" placeholder="Your Name"/>
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
                        <label for="services"><i class="zmdi zmdi-functions"></i></label>
                        <select name="service" id="services" class="">
                            <option disabled selected >Service...</option>
                            <?php foreach($services as $service): ?>
                                <option value="<?= $service['id'] ?>"><?=$service['name'] ?></option>
                            <?php endforeach ?>
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
                <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                <a href="<?= $router->url('login') ?>" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>
