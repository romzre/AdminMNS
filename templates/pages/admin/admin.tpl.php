<?php require '../templates/partials/inc_top.php';?>
<div class='contBtnMenu'>
        <button type="button" class="active btn btn-primary btn-lg"><a href="/?page=admin">Inscrits</a></button>
        <button type="button" class="btn btn-primary btn-lg"><a href="/?page=candidats">Candidats</a></button>
        <button type="button" class="btn btn-primary btn-lg"><a href="/?page=trainees">Stagiaires</a></button>
</div>
<div class="contData">
    <table class="dataTable">
        <thead>
            <td class="headTable left">Prénom</td>
            <td class="headTable">Nom</td>
            <td class="headTable">Email</td>
            <td class="headTable right">Tel</td>
            <!-- <td>Formation</td> -->
        </thead>
        <tbody>
            <?php  foreach ($registered as $user) :?>
                <tr >
                <td class="cel" ><a class="anim-hover" href="index.php?page=profile&id=<?= $user['id_user'] ?>"><?= $user['firstName'] ?></a></td>
                <td class="cel"><a ><?= $user['familyName'] ?></a></td>
                <td class="cel"><a mailto="<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                <td class="cel"><a><?= $user['tel'] ?></a></td>
                <!-- <td>< ?= $user['formation'] ?></td> -->
                </tr>
            
            <?php endforeach ;?>
        </tbody>
    </table>
</div>
<script src="scripts/adminDash.js"></script>
<?php require '../templates/partials/inc_bottom.php'; ?>
