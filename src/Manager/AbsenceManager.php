<?php 

require '../src/Entity/ReportManager.php';

class AbsenceManager extends ReportManager {

    
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
    public function getUserAbsences(string $id_user)
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

    public function getUnjustifiedAbsencesByUser(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM abscence INNER JOIN on report WHERE absence.id_report=report.id_report WHERE id_user=:id_user AND isJustified = 0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $unjustifiedAbsences = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $unjustifiedAbsences;
    }



    
}