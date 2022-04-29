<?php 

require '../templates/partials/inc_top.php'; 
?> 
<head><link rel="stylesheet" href="style/register.css"></head>
<body>

   
<div class="contForm">
    <h1>Formulaire d'inscription</h1>
    <?php if($message != NULL): ?>
<p class="suc_err"><?= $message ?> </p>
<p class="btn-primary Return"><a href="index.php">Retour</a><p>
    <?php endif; ?>
</div>
<script src="scripts/register-check.js"></script>





