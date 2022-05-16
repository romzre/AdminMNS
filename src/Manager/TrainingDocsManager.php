<?php 

namespace App\Manager;

use PDO;

class TrainingDocsManager {

    public function getTrainingDocsByUser ($id_user, $id_training){

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