<div class="container container-reset-password">

    <?php if(!empty($success)) : ?>
        <span class="alert alert-light" role="alert"><?=$success;?></span>
    <?php endif ;?>    
    <?php if(!empty($error)) : ?>
        <span class="alert alert-danger" role="alert"><?=$error;?></span>
    <?php endif ;?> 
    <?php ($form) ? require 'reset-password-form.tpl.php': null;?> 

</div>

<script src="scripts/login-check.js"></script>

