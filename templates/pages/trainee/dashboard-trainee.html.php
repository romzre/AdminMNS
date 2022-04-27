
<link rel="stylesheet" href="../style/dashboard-trainee.css">
<div class="container-titre-dashboard">
    <h2>Bienvenue sur votre tableau de bord ! </h2>
</div>
<div class="container-dashboard">
    <div class="dashboard-personal-info">
        <div class="personal-info-content">
            <h2>Formation : </h2>
            <div class='personal-data'>
                <p><strong>Vos informations personnelles :</strong></p>
                <p>Prénom : <?= $trainee->getFirstName();?></p>
                <p>Nom : <?=$trainee->getFamilyName() ?></p>
                <p>Email : <?=$trainee->getEmail() ?></p>
            </div>
        </div>
    </div>
    <div class="profile-pic">
        <img src="ressources">
    </div>
</div>
