<div class="reset-password-form-container">
    <div class="reset-password-form-top">
        <h2>Réinitialisation du mot de passe</h2>
    </div>
    <form method='post' action='#'>
        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password"  name="password1" class="form-control" id="password_input" placeholder="tappez votre mot de passe">
            <?php if(!empty($error_password1)) : ?>
                <span class="message-alerte"><?=$error_password1;?></span>
                <img src="images/error.svg" alt="icone de validation" class="icone-verif">
            <?php endif ;?>    
        </div>
        <input type="hidden" name="action" value="update" />
        <div class="form-group">
            <label for="password">Confirmer votre nouveau de passe</label>
            <input type="password"  name="password2" class="form-control" id="password_input" placeholder="confirmez nouveau mot de passe">
            <?php if(!empty($error_password2)) : ?>
                <span class="message-alerte"><?=$error_password2;?></span>
                <img src="images/error.svg" alt="icone de validation" class="icone-verif">
            <?php endif ;?>    
        </div>
        <input type="hidden" name="email" value="<?=$email;?>"/>       
        <div class="container-button-center">
            <input type="submit" class="btn btn-primary" value="Valider" name="submit" />
        </div>
    </form>  
    <?php if(!empty($error_passwords)): ?>
        <div class="alert alert-danger alert-form" role="alert"><?=$error_passwords;?></div>
    <?php endif ;?>
</div>



<script src="scripts/login-check.js"></script>

<?php require '../templates/partials/inc_bottom.php';?>