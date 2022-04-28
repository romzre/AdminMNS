<div class="container-titre-dashboard">
    <h2>Bienvenue sur votre tableau de bord ! </h2>
</div>
<div class="container-dashboard">
    <div class="dashboard-personal-info">
        <div class="personal-info-content">
            <h2>Formation : <?= $training['title_formation'];?></h2>
            <div class='personal-data'>
                <p><strong>Vos informations personnelles :</strong></p>
                <p>Prénom : <?= $trainee->getFirstName();?></p>
                <p>Nom : <?=$trainee->getFamilyName() ?></p>
                <p>Email : <?=$trainee->getEmail() ?></p>
            </div>
        </div>
    </div>
    <div class="profile-pic&recap-report">
        <img src="ressources" alt='photo-profil'>
        <div class="recap">
            <p>Nombre d'abscences non justifiées :<span class='dash-unjustified-report'> /5 </span></p>
            <p>Nombre de retards non justifiées : <span class='dash-unjustified-report'> /10 </span></p>
        </div>
    </div>
</div>

