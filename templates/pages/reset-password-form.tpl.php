<?php require '../templates/partials/inc_top.php'?>
<div class="container container-reset-password">

    <?php if(!empty($success)) : ?>
        <span class="alert alert-light" role="alert"><?=$success;?></span>
    <?php endif ;?>    
    <?php if(!empty($error)) : ?>
        <span class="alert alert-danger" role="alert"><?=$error;?></span>
    <?php endif ;?>  

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
            <?php endif ;?>    
        </div>
        <input type="hidden" name="action" value="update" />
        <div class="form-group">
            <label for="password">Confirmer votre nouveau de passe</label>
            <input type="password"  name="password2" class="form-control" id="password_input" placeholder="confirmez nouveau mot de passe">
            <?php if(!empty($error_password2)) : ?>
                <span class="message-alerte"><?=$error_password2;?></span>
            <?php endif ;?>    
        </div>
        <input type="hidden" name="email" value="<?=$email;?>"/>       
        <div class="container-button-center">
            <input type="submit" class="btn btn-primary" value="Valider" name="submit" />
        </div>
        <?php if(!empty($error_passwords)): ?>
        <span class="alert alert-danger" role="alert"><?=$error_passwords;?></span>
    <?php endif ;?> 
    </form>  
</div>

</div>


<script src="scripts/login-check.js"></script>

<?php require '../templates/partials/inc_bottom.php';?>