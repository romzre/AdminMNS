<?php require '../templates/partials/inc_top.php';?>
<link rel="stylesheet" href="../style/dashboard-trainee.css">
<div class="container-titre-dashboard">
    <h2>Bienvenue sur votre tableau de bord ! </h2>
</div>
<div class="container-dashboard">
    <div class="dashboard-firstPart">
        <h2>Formation : </h2>
        <div class='personal-data'>
            <h3>Vos informations personnelles :</h3>
            <p>Prénom : <?= $trainee->getFirstName();?></p>
            <p>Nom : <?=$trainee->getFamilyName() ?></p>
            <p>Email : <?=$trainee->getEmail() ?></p>
        </div>
    </div>
    <div class="profile-pic">
        <img src="ressources">
    </div>
</div>

<?php require '../templates/partials/inc_bottom.php';?>