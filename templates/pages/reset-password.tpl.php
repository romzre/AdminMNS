<?php require '../templates/partials/inc_top.php'?>

<div class="container container-reset-password">

    <?php if(!empty($success)) : ?>
        <span class="alert alert-light" role="alert"><?=$success;?></span>
    <?php endif ;?>    
    <?php if(!empty($error)) : ?>
        <span class="alert alert-danger" role="alert"><?=$error;?></span>
    <?php endif ;?>  
        
</div>

<script src="scripts/login-check.js"></script>

<?php require '../templates/partials/inc_bottom.php';?>