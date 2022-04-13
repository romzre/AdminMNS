<?php require '../templates/partials/inc_top.php';?>
<div class='contBtnMenu'>
        <button type="button" class="active btn btn-primary btn-lg"><a href="/?page=admin">Inscrits</a></button>
        <button type="button" class="btn btn-primary btn-lg"><a href="/?page=candidats">Candidats</a></button>
        <button type="button" class="btn btn-primary btn-lg"><a href="/?page=trainees">Stagiaires</a></button>
</div>
<div class="contData">
    <table class="dataTable">
        <thead>
            <th class="headTable left">Prénom</th>
            <th class="headTable">Nom</th>
            <th class="headTable">Email</th>
            <th class="headTable right">Tel</th>
            <!-- <td>Formation</td> --> 
        </thead>
        <tbody>
            <?php  foreach ($registered as $user) :?>
                <tr >
                <td class="cel" data-info="Prénom" ><a class="anim-hover" href="index.php?page=profile&id=<?= $user['id_user'] ?>"><?= $user['firstName'] ?></a></td>
                <td class="cel" data-info="Nom" ><a ><?= $user['familyName'] ?></a></td>
                <td class="cel" data-info="Email" ><a mailto="<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                <td class="cel" data-info="Tel" ><a><?= $user['tel'] ?></a></td>
                <!-- <td>< ?= $user['formation'] ?></td> -->
                </tr>
            
            <?php endforeach ;?>
        </tbody>
    </table>
</div>
<script src="scripts/adminDash.js"></script>
<?php require '../templates/partials/inc_bottom.php'; ?>
