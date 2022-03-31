<?php require '../app/Entity/Form.php' ?>

<div>
<form action="#" method="POST">
    <fieldset>
        <legend>Informations Personnelles</legend>
    <?php 
        $form = new Form();
        $form->createInputText('FirstName','text','Prénom', 'space');
        $form->createInputText('Name','text',null, 'space');
        $form->createInputText('Adress','text',null, 'space');
        $form->createInputText('CodeP','text', 'Code Postal', 'space');
        $form->createInputText('City','text',null, 'space');
        $form->createInputText('Phone','text',null, 'space');
        $form->createInputText('Email','text',null, 'space');
        $form->createInputText('Nationality','text',null, 'space');
    ?>
    </fieldset>
    <fieldset>
        <legend>Votre situation Actuelle</legend>
        <?php
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


    </fieldset>
    <fieldset>
        <legend>
            Formation Souhaitée
        </legend>
        <?php 
        $form->createSelect(['Tech','DEV','RH'],'Quelle formation vous intéresse','trainnings');
        ?>

    </fieldset>
    <fieldset>
        <legend>
            Motivation
        </legend>
        <?php 
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
        <?php 
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
        <?php 

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
        <?php 

        $form->createSelect(['FB','Google','Email'],'Comment avez-vous connu MNS ?','KnowingMns');
        $form->createBalise('Par un ancien stagiaire','p');
        $form->createInputText('FirstNameOldStag','text','Prénom', 'space');
        $form->createInputText('NameOldStag','text','Nom', 'space');
        $form->createInputText('TrainningOldStag','text','Prénom', 'space');

        $form->createSubmit('ContBtn','btn-primary','submit');
         ?>
    </fieldset>
</form>
</div>






