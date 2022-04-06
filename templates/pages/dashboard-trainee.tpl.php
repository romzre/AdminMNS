<?php require '../templates/partials/inc_top.php';?>
<link rel="stylesheet" href="../style/dashboard-trainee.css">
<div class="container-titre-dashboard">
    <h2>Bienvenue sur votre tableau de bord <?=$user->getFirstName();?> ! </h2>
</div>
<div class="container-dashboard">
    <div>
        <p>Votre emploi du temps de la semaine</p>
    </div>
    <div class="recap-retards-absences">
        <p>Nombre d'absences en attente de justificatifs : <span>test<!-- <?=$absences['unjustified'];?>--></span></p>
        <p>Nombre de retards en attente de justificatifs : <span><!--<?=$retards['unjustified'];?>--></span></p>
    </div>
</div>

<?php require '../templates/partials/inc_bottom.php';?>