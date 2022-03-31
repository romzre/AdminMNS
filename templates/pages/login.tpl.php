<?php require '../templates/partials/inc_top.php';?>

<div class="container">
    <div class="login-form-container">
        <div class="login-form-top">
            <h2>Connectez vous a votre espace ADMIN MNS</h2>
        </div>
        <form method='post' action='./?page=login'>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" class="form-control" id="email_input" placeholder="name@example.com">
                <div class='check-form'>
                    <img src="images/check.svg" alt="icone de validation" class="icone-verif login-js">
                    <span class="message-alerte login-js">Rentrez un email valide.</span>
                </div>
                <?php if(isset($_GET['email_error'])) {require '../templates/partials/inc_email-error.php';}?>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password"  name="password" class="form-control" id="password_input" placeholder="tappez votre mot de passe">
                <?php if(isset($_GET['password_error'])) require '../templates/partials/inc_password-error.php'?>
                <?php if(isset($_GET['account_error'])) require '../templates/partials/inc_account-error.php'?>
            </div>    
                <div class="container-btn">
                    <input type="submit" class="btn btn-primary" value="Se connecter" name="submit" />
                </div>
            <div class="password_forgotten"><a href="">mot de passe oublié ?</a></div>
        </form>    
    </div>
</div>
</div>
<script src="scripts/login-check.js"></script>

<?php require '../templates/partials/inc_bottom.php';?>