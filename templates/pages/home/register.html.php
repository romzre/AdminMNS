<?php 
require '../src/Entity/Form.php';

?> 
<head><link rel="stylesheet" href="style/register.css"></head>
<body>
<?php if($message != NULL): ?>
<p class="suc_err"><?= $message ?> </p>
<p class="btn-primary Return"><a href="index.php">Retour</a><p>
    <?php endif; ?>
<div class="contForm">
    <h1>Formulaire d'inscription</h1>
<form action="/?action=register" method="POST">
    <fieldset>
        <legend>Informations Personnelles</legend>
    <?php 

        $form = new Form();
        $form->createInputText('firstName','text','Prénom', 'space',(isset($_POST['firstName'])) ? $_POST['firstName'] : NULL);

        $form->createInputText('familyName','text','Nom', 'space',(isset($familyName)) ? $familyName : NULL);

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
        $form->createInputText('email','text','Adresse email', 'space',(isset($email)) ? $email : NULL);
       if($email != NULL): ?>
        <p><?= $email ?> </p>
        <?php endif; 
        $form->createInputText('password','password','Mot de passe', 'space',(isset($password)) ? $password : NULL); 
        $form->createInputText('confirm_password','password','Retapez votre mot de passe', 'space',(isset($confirm_password)) ? $confirm_password : NULL);
        
        if($samePass == false)
        {
            ?><p><?=$message?></p><?php
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
<p class="btn-primary Return"><a href="/">Retour</a><p>
</div>
<script src="scripts/register-check.js"></script>





