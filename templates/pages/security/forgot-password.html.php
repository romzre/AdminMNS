<div class="container container-login">
    <div class='container-button-back'>
        <a href="/"><button type="button" class="btn btn-primary btn-back">Retour</button></a>
    </div>
    <?php if(!empty($success)) : ?>
            <span class="alert alert-success" role="alert"><?=$success;?></span>
    <?php endif ;?>  
    <div class="login-form-container">
        <div class="login-form-top">
            <h2>Réinitialisation du mot de passe</h2>
        </div>
        <form class='reset-container-form' method='post' action='/?controller=security&action=forgotPassword'>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" class="form-control" id="email_input" placeholder="name@example.com">
                <div class='check-form'>
                    <img src="images/check.svg" alt="icone de validation" class="icone-verif login-js">
                    <span class="message-alerte login-js">Rentrez un email valide.</span>
                </div>
                <?php if(!empty($message)) : ?>
                    <span class="message-alerte"><?=$message;?></span>
                <?php endif ;?>
            </div>
            <div class="container-button-center">
                <input type="submit" class="btn btn-primary" value="Valider" name="submit" />
            </div>
        </form>    
        <?php if(!empty($messageErrorEmail)) : ?>
                    <span class="message-alerte"><?=$messageErrorEmail;?></span>
                <?php endif ;?>
        <div class="password-forgotten-text">
                <h3>Vous avez changé d'adresse email ?</h3>
                <p>Si vous n’utilisez plus l’adresse email associée à votre compte MNS, merci de prendre contact avec l’équipe de MNS soit par email à l’adresse contact@metznumericschool.fr ou par téléphone au 03 87 16 07 17</p>
            </div>
    </div>
</div>
</div>
<script src="scripts/login-check.js"></script>
