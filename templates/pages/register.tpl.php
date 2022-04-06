<?php 
require '../app/Entity/Form.php';
require '../templates/partials/inc_top.php'; 
?>

<div class="contForm">
    <h1>Formulaire d'inscription</h1>
<form action="index.php?page=register" method="POST">
    <fieldset>
        <legend>Informations Personnelles</legend>
    <?php 
        $form = new Form();
        $form->createInputText('FirstName_user','text','Prénom', 'space');
        if(!empty($messageFN))
        {
            $form->createBalise($messageFN,'p');
        }

        $form->createInputText('familyName_user','text','Nom', 'space');
        if(!empty($messageFaN))
        {
            $form->createBalise($messageFaN,'p');
        }

        $form->createInputText('birthdate','date','Date de naissance', 'space');
        if(!empty($_POST['birthdate']))
        {
            $form->createBalise($messageDb,'p');
        }
        $form->createInputText('Nationality','text','Nationalité', 'space');
    ?>
    
    </fieldset>
    <fieldset>
        <legend>Adresse</legend>
    <?php
        $form->createInputText('streetNumber','text','Numéro de voie', 'space');
        $form->createInputText('laneType','text','Type de voie', 'space');
        $form->createInputText('street','text','Nom de rue', 'space');
        $form->createInputText('addressComplement','text','Complément d adresse', 'space');
        $form->createInputText('postalCode','text', 'Code Postal', 'space');
        $form->createInputText('city','text','Ville', 'space');
        
    ?>
    </fieldset>
    <fieldset>
        <legend>Communication</legend>
    <?php
        $form->createInputText('tel','text','Numéro de téléphone', 'space');
        $form->createInputText('email_user','text','Adresse email', 'space');
        if(!empty($messageEmail))
        {
            $form->createBalise($messageEmail,'p');
        }
        $form->createInputText('password_user','text','Mot de passe', 'space');
        if(!empty( $messagePass))
        {
            $form->createBalise( $messagePass,'p');
        }
        $form->createInputText('confirm_password','text','Retapez votre mot de passe', 'space');
        if(!empty($messageConfPass))
        {
            $form->createBalise($messageConfPass,'p');
        }
    ?>
    </fieldset>
    <!-- <fieldset>
        <legend>Votre situation Actuelle</legend>
        < ?php
        $form->createInputText('Diploma','text','Diplôme obtenu ou en cours d\'obtention', 'space');
        $form->createInputText('Trainning','text','Type de formation', 'space');

        $form->createBalise('Avez-vous besoin d\'aménagements ou d\'adaptations spécifiques ?','p');
        $form->createInputRadio('adaptspe','Oui','Y');
        $form->createInputRadio('adaptspe','Non','N');
        $form->createBalise('Si oui, lesquels ?','p');
        $form->createTextArea('adaptText',30,3);

        $form->createBalise('Avez-vous déjà bénéficié d\'un tiers-temps ?','p');
        $form->createInputRadio('ThreeTime','Oui','Yes');
        $form->createInputRadio('ThreeTime','Non','No');

        $form->createBalise('Quels langages de programmation connaissez-vous ?','p');
        $form->createTextArea('langProgText',30,3);

        $form->createBalise('Indiquez ici l\'adresse de consultation des projets que vous avez développé','p');
        $form->createTextArea('AdressProjectsText',30,3);
        ?>


    </fieldset> -->
    <fieldset>
        <legend>
            Formation Souhaitée
        </legend>
        <?php 
        $form->createSelect(['Tech','DEV','RH'],'Quelle formation vous intéresse','trainnings');
        ?>
        <?php $form->createSubmit('ContBtn','btn-primary','submit-register'); ?>
    </fieldset>
    <!-- <fieldset>
        <legend>
            Motivation
        </legend>
        < ?php 
       $form->createBalise('Pourquoi avoir choisi MNS ?','p');
       $form->createTextArea('MotChoiceSchoolText',30,3);

       $form->createBalise('Pourquoi avoir choisi cette formation ?','p');
       $form->createTextArea('MotChoiceTrainningText',30,3);

       $form->createBalise('Quel est votre projet professionnel à court et moyen terme ?','p');
       $form->createTextArea('ProProjectText',30,3);

       $form->createBalise('Dans quel secteur d’activité souhaitez-vous faire votre stage obligatoire ou votre alternance ?','p');
       $form->createTextArea('ActSecText',30,3);

       $form->createBalise('Quelles sont vos principales qualités ?','p');
       $form->createTextArea('SftSkillsText',30,3);

       $form->createBalise('Quelles sont vos principaux défauts ?','p');
       $form->createTextArea('SftDefText',30,3);

       $form->createBalise('Avez-vous des passions, des hobbies ? Pratiquez-vous un sport ? Etes-vous investi dans une association ?','p');
       $form->createTextArea('HobText',30,3);

     
        ?>

    </fieldset>
    <fieldset>
        <legend>
            Langues Etrangères
        </legend>
        < ?php 
        $form->createBalise('Pouvez-vous nous préciser votre niveau oral et écrit en anglais ?','p');
        $form->createTextArea('LevEngText',30,3);

        $form->createBalise('Pratiquez-vous une autre langue étrangère ?','p');
        $form->createInputRadio('LangBool','Oui','LangBoolY');
        $form->createInputRadio('LangBool','Non','LangBoolN');

        $form->createBalise('Si oui, laquelle ?','p');
        $form->createTextArea('LangText',30,3);
         ?>
    </fieldset>
    <fieldset>
        <legend>
          Votre Mobilité
        </legend>
        < ?php 

        $form->createBalise('Possédez-vous le permis B ?','p');
        $form->createInputRadio('DrivBool','Oui','DrivBoolY');
        $form->createInputRadio('DrivBool','Non','DrivBoolN');

        $form->createBalise('Possédez-vous un véhicule personnel ?','p');
        $form->createInputRadio('CarBool','Oui','CarBoolY');
        $form->createInputRadio('CarBool','Non','CarBoolN');

        $form->createBalise('Quelle est votre mobilité géographique ?','p');
        $form->createTextArea('GeoMobText',30,3);

        $form->createBalise('Seriez-vous prêt à vous expatrier dans une autre région française ou dans un autre pays européen lors de votre stage ?
        ','p');
        $form->createInputRadio('ExpRegBool','Oui','ExpRegBoolY');
        $form->createInputRadio('ExpRegBool','Non','ExpRegBoolN');
         ?>
    </fieldset>
    <fieldset>
        <legend>
        COMMENT AVEZ-VOUS CONNU MNS ?
        </legend>
        < ?php 

        $form->createSelect(['FB','Google','Email'],'Comment avez-vous connu MNS ?','KnowingMns');
        $form->createBalise('Par un ancien stagiaire','p');
        $form->createInputText('FirstNameOldStag','text','Prénom', 'space');
        $form->createInputText('NameOldStag','text','Nom', 'space');
        $form->createInputText('TrainningOldStag','text','Prénom', 'space');

        
         ?>
    </fieldset> -->
</form>
</div>
<script src="scripts/register-check.js"></script>





