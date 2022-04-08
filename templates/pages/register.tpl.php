<?php 
require '../app/Entity/Form.php';
require '../templates/partials/inc_top.php'; 
?> 
<head><link rel="stylesheet" href="style/register.css"></head>
<body>
<?php if($message != NULL): ?>
<p class="suc_err"><?= $message ?> </p>
<p class="btn-primary Return"><a href="index.php">Retour</a><p>
    <?php endif; ?>
<div class="contForm">
    <h1>Formulaire d'inscription</h1>
<form action="index.php?page=register" method="POST">
    <fieldset>
        <legend>Informations Personnelles</legend>
    <?php 
        $form = new Form();
        $form->createInputText('firstName_user','text','Prénom', 'space',(isset($firstName_user)) ? $firstName_user : NULL);

        $form->createInputText('familyName_user','text','Nom', 'space',(isset($familyName_user)) ? $familyName_user : NULL);

        $form->createInputText('birthdate','date','Date de naissance', 'space',(isset($birthdate)) ? $birthdate : NULL);
        
    ?>
    
    </fieldset>
    <fieldset>
        <legend>Adresse</legend>
    <?php
        $form->createInputText('streetNumber','text','Numéro de voie', 'space',(isset($streetNumber)) ? $streetNumber : NULL);
        $form->createInputText('laneType','text','Type de voie', 'space',(isset($laneType)) ? $laneType : NULL);
        $form->createInputText('street','text','Nom de rue', 'space',(isset($street)) ? $street : NULL);
        $form->createInputText('addressComplement','text','Complément d adresse', 'space',(isset($addressComplement)) ? $addressComplement : NULL);
        $form->createInputText('postalCode','text', 'Code Postal', 'space',(isset($postalCode)) ? $postalCode : NULL);
        $form->createInputText('city','text','Ville', 'space',(isset($city)) ? $city : NULL);
        
    ?>
    </fieldset>
    <fieldset>
        <legend>Communication</legend>
    <?php
        $form->createInputText('tel','text','Numéro de téléphone', 'space',(isset($tel)) ? $tel : NULL);
        $form->createInputText('email_user','text','Adresse email', 'space',(isset($email_user)) ? $email_user : NULL);
       if($email != NULL): ?>
        <p><?= $email ?> </p>
        <?php endif; 
        $form->createInputText('password_user','password','Mot de passe', 'space',(isset($password_user)) ? $password_user : NULL); 
        $form->createInputText('confirm_password','password','Retapez votre mot de passe', 'space',(isset($confirm_password)) ? $confirm_password : NULL);
        
        if($samePass == false)
        {
            ?><p><?=$msg?></p><?php
        }
        
            
    ?>
    </fieldset>
    <fieldset>
        <legend>
            Formation Souhaitée
        </legend>
        <?php 
        $form->createSelect(['Tech','DEV','RH'],'Quelle formation vous intéresse','trainnings');
        ?>
        <?php $form->createSubmit('ContBtn','btn-primary','submit-register'); ?>
    </fieldset>
</form>
<p class="btn-primary Return"><a href="index.php">Retour</a><p>
</div>
<script src="scripts/register-check.js"></script>





