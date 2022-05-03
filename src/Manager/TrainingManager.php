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
}