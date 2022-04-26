<?php 
require_once 'PdoManager.php';
require '../app/Entity/User.php';

class AbsenceManager {

    use PdoManager; 
    
    /**
     * getAll
     *
     * @return void
     */
    public function getAllAbsences()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM absences';
        $req = $pdo->prepare($sql);
        $req->execute();
        
        $absences = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $absences;
    }
    
    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserAbsences(int $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM abscence WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>$id_user
        ]);
        
        $absences = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $absences;
    }

    public function getUserAbsencesUnjustified(int $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM abscence WHERE id_user=:id_user INNER JOIN on report WHERE absence.id_report=report.id_report';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $absencesUnjustified = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $absencesUnjustified;
    }


}