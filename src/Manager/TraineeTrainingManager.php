<?php require 'PdoManager.php';

class TraineeTrainingManager {

    use PdoManager; 

    public function getTraining($id_user)
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM training INNER JOIN trainee_training on training.id_training = trainee_training.id_user WHERE id_user=:id_user';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=> $id_user,
        ]);

        $training = $req->fetch(PDO::FETCH_ASSOC);

        return $training;
    }
}