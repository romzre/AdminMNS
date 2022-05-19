<?php 

namespace App\Manager;

use PDO;

class TrainingDocsManager {

    public function getTrainingDocsByUser (int $id_user, int $id_training){

        $pdo=PdoManager::getPdo();
        $sql= 'SELECT document.id_document, trainingDocs.id_typeOfDoc, document.isValid, document.id_user FROM document INNER JOIN trainingDocs ON document.id_document = trainingDocs.id_document WHERE document.id_user=:id_user and trainingDocs.id_training =:id_training;';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>$id_user,
            'id_training'=>$id_training
        ]);
        
        $userTrainingDocs = $req->fetchall(PDO::FETCH_ASSOC);
        
        return $userTrainingDocs;
        
    }

    public function getAllTrainingInfosByTraining(int $id_training)
    {
        $pdo=PdoManager::getPdo();

       
        $sql= 'SELECT training.id_training, training.title_formation, training.capacity_training, training.trainingYear FROM `training` 
        LEFT JOIN training_typeOfDoc ON training.id_training = training_typeOfDoc.id_training
        LEFT JOIN typeOfDoc ON training_typeOfDoc.id_typeOfDoc = typeOfDoc.id_typeOfDoc WHERE training.id_training = :id_training';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_training' => $id_training
        ]);

        $trainings = $req->fetchAll(PDO::FETCH_ASSOC);

        return $trainings;
        
        
    }

    public function getAllTrainingDocs(int $id_training)
    {
        $pdo=PdoManager::getPdo();

       
        $sql= 'SELECT  typeOfDoc.id_typeOfDoc,  typeOfDoc.wording_typeOfDoc FROM `training` 
        LEFT JOIN training_typeOfDoc ON training.id_training = training_typeOfDoc.id_training
        LEFT JOIN typeOfDoc ON training_typeOfDoc.id_typeOfDoc = typeOfDoc.id_typeOfDoc WHERE training.id_training = :id_training';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_training' => $id_training
        ]);

        $trainings = $req->fetchAll(PDO::FETCH_ASSOC);

        return $trainings;
    }

    public function getAllDocTraining()
    {
        $pdo=PdoManager::getPdo();

       
        $sql= 'SELECT  training.id_training, title_formation   , COUNT(training.id_training) as nbDocs  FROM `training_typeOfDoc`
        INNER JOIN training ON training_typeOfDoc.id_training = training.id_training
        INNER JOIN typeOfDoc ON training_typeOfDoc.id_typeOfDoc = typeOfDoc.id_typeOfDoc
        GROUP BY title_formation';
        $req = $pdo->prepare($sql);
        $req->execute();

        $trainings = $req->fetchAll(PDO::FETCH_ASSOC);

        return $trainings;
    }

    public function getAllDocValid()
    {
        $pdo=PdoManager::getPdo();

       
        $sql= 'SELECT * FROM `trainingDocs` 
        INNER JOIN document ON trainingDocs.id_document = document.id_document
        WHERE isvalid = 1';

        $req = $pdo->prepare($sql);
        $req->execute();

        $docs = $req->fetchAll(PDO::FETCH_ASSOC);

        return $docs;
    }

    public function checkTrainingTypeOfDocExist(string $champ)
    {
        $pdo=PdoManager::getPdo();

        $sql= "SELECT `id_typeOfDoc`, `wording_typeOfDoc` FROM `typeOfDoc` WHERE wording_typeOfDoc = :champ";
        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'champ' => $champ
        ]);
      
        $typeOfDoc = $req->fetch(PDO::FETCH_ASSOC);

        return $typeOfDoc;
    }

    public function checkTrainingHasTypeOfDoc(int $id_training , int $idTypeOfDoc)
    {
        $pdo=PdoManager::getPdo();
 
        $sql= "SELECT * FROM `training_typeOfDoc` WHERE id_training = :id_training AND id_typeOfDoc = :id_typeOfDoc";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_training' => $id_training,
            'id_typeOfDoc' => $idTypeOfDoc
        ]);
        $typeOfDocExist = $req->fetch(PDO::FETCH_ASSOC);
  

        return $typeOfDocExist;
    }


    public function insertTypeOfDoc($champ)
    {
        $pdo=PdoManager::getPdo();

        $sql= "INSERT INTO `typeOfDoc`( `wording_typeOfDoc`) VALUES (:champ)";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'champ' => $champ
        ]);
        $id = $pdo->lastInsertId();
        return $id;
    }

    public function insertTrainingTypeOfDoc($id_training,$id_typeOfDoc)
    {
        $pdo=PdoManager::getPdo();

        $sql= "INSERT INTO `training_typeOfDoc`(`id_training`, `id_typeOfDoc`) VALUES (:id_training,:id_typeOfDoc)";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_training' => $id_training,
            'id_typeOfDoc' => $id_typeOfDoc
        ]);

        return $stmt;
    }


    public function updateWording_TypeOfDoc(int $id,string $doc)
    {
        $pdo=PdoManager::getPdo();

        $sql= "UPDATE `typeOfDoc` SET `wording_typeOfDoc`= :doc WHERE id_typeOfDoc = :id";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id' => $id,
            'doc' => $doc
        ]);

        return $stmt;
    }

    public function deleteTrainingDocs($id_training,$id_typeOfDoc)
    {
        $pdo=PdoManager::getPdo();
     

        $sql= "DELETE FROM `training_typeOfDoc` WHERE id_training = :id_training AND id_typeOfDoc = :id_typeOfDoc";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_training' => $id_training,
            'id_typeOfDoc' => $id_typeOfDoc
        ]);

        return $stmt;
    }

    // public function test(string $id_training, string $id_user)
    // {
    //     $pdo=PdoManager::getPdo();

    //     $sql= 'SELECT typeOfDoc.id_typeOfDoc, typeOfDoc.wording_typeOfDoc,document.isValid, document.id_user FROM trainingDocs INNER JOIN training_typeOfDoc on trainingDocs.id_training = training_typeOfDoc.id_training INNER JOIN typeOfDoc on typeOfDoc.id_typeOfDoc = training_typeOfDoc.id_typeOfDoc INNER JOIN trainingDocs ON document.id_document = trainingDocs.id_document WHERE training.id_training=:id_training AND document.id_user=:id_user';
    //     $req = $pdo->prepare($sql);
    //     $req->execute([
    //         'id_training'=> $id_training,
    //         'id_user'=> $id_user
    //     ]);
        
    //     return $trainingDocs = $req->fetchAll(PDO::FETCH_ASSOC);

    // }
}