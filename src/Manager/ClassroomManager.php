<?php 

namespace App\Manager;

use PDO;
use App\Entity\Training;
use App\Entity\Classroom;
// require_once 'PdoManager.php';

// require '../src/Entity/Training.php';

class ClassroomManager {


    public function getAll()
    {
        $pdo=PdoManager::getPdo();

        $sql = "SELECT * FROM `classroom`";

        $req = $pdo->prepare($sql);
        $req->execute();
        
        $classrooms = $req->fetchAll(PDO::FETCH_ASSOC);
    
        if(!empty($classrooms))
        {
            foreach ($classrooms as $classroom) {
                $obj[] = (new Classroom())->hydrate($classroom);
            }
           
            return $obj;
        }
        else
        {
            return false;
        }

    }

    public function getClassroom($id)
    {
        $pdo = PdoManager::getPdo();

        $sql = "SELECT * FROM classroom WHERE id_classroom = :id_classroom";

        $req = $pdo->prepare($sql);
  
        $req->execute([
            'id_classroom' => $id
        ]);

        $classroom = $req->fetch(PDO::FETCH_ASSOC);
        
        $obj = (new Classroom())->hydrate($classroom);
     
        return $obj;
     
    }

    public function getClassroomsByTraining($id)
    {
        $pdo = PdoManager::getPdo();

        $sql = "SELECT * FROM 'classroom' WHERE id_training = :id_training";

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_training' => $id
        ]);

        $classrooms = $req->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($classrooms))
        {
            foreach ($classrooms as $classroom) {
                $obj[] = (new Classroom())->hydrate($classroom);
            }
            return $obj;
        }
        else
        {
            return false;
        }

    }


    public function insert($data)
    {
        $pdo = PdoManager::getPdo();

        $sql = "INSERT INTO `classroom`( `name`, `classroomMYB`, `classroomMYE`, `num_classroom`, `id_training`) VALUES ( :name, :classroomMYB, :classroomMYE, :num_classroom, :id_training)";

        $req = $pdo->prepare($sql);
        var_dump($sql);
        $stmt = $req->execute($data);

        return $stmt;
    }

    public function getAllWithTrainings()
    {
        $pdo=PdoManager::getPdo();

        $sql = "SELECT * FROM `classroom` 
        INNER JOIN training ON classroom.id_training = training.id_training";

        $req = $pdo->prepare($sql);
        $req->execute();
        
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function getClassroomsWithTrainee()
    {
        $pdo=PdoManager::getPdo();

        $sql = "SELECT * FROM `classroom` 
        INNER JOIN training ON classroom.id_training = training.id_training
        INNER JOIN trainee ON classroom.id_classroom = trainee.id_classroom";

        $req = $pdo->prepare($sql);
        $req->execute();
        
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }


    public function getClassroomWithTrainees($id)
    {
        $pdo=PdoManager::getPdo();

        $sql = "SELECT * FROM `classroom` 
        INNER JOIN trainee ON classroom.id_classroom = trainee.id_classroom WHERE id_classroom = :id_classroom";

        $req = $pdo->prepare($sql);
        $req->execute(['id_classroom' => $id]);
        
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }

}