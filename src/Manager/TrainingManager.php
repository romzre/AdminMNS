<?php 
require_once 'PdoManager.php';

require '../src/Entity/Training.php';

class TrainingManager {

    use PdoManager;

    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $pdo=PdoManager::getPdo();

        $currentYear = date('Y');
        $sql= "SELECT * FROM `training` WHERE trainingYear = $currentYear";
        $req = $pdo->prepare($sql);
        $req->execute();

        $trainings = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($trainings as $training) {
            $obj[] = (new Training())->hydrate($training);
        }
        return $obj;
    }

}