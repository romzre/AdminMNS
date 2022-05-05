<?php require_once 'PdoManager.php';
require_once '../src/Entity/Training.php';

class TrainingManager {

    use PdoManager; 

    public function getTraining($id_user)
    {
        $pdo=PdoManager::getPdo();

        $sql= 'SELECT * FROM training INNER JOIN trainee_training on training.id_training = trainee_training.id_training WHERE id_user=:id_user';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=> $id_user,
        ]);

        $training = $req->fetch(PDO::FETCH_ASSOC);

        return $obj= (new Training())->hydrate($training);
    }

    public function getDocumentsByTraining(string $id_training)
    {
        echo($id_training);
        $pdo=PdoManager::getPdo();

        $sql= 'SELECT * FROM training INNER JOIN training_typeOfDoc on training.id_training = training_typeOfDoc.id_training INNER JOIN typeOfDoc on typeOfDoc.id_typeOfDoc = training_typeOfDoc.id_typeOfDoc WHERE training.id_training=:id_training';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_training'=> $id_training,
        ]);
        
        return $trainingInfos = $req->fetch(PDO::FETCH_ASSOC);


    }
}