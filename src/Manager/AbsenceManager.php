<?php 

namespace App\Manager;

use PDO;
use App\Entity\Absence;

// require_once '../src/manager/ReportManager.php';
// require_once '../src/Entity/Absence.php';

class AbsenceManager extends ReportManager {

    /**
     * getAll
     *
     * @return void
     */
    public function getAllAbsences()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM absence';
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
        $sql= 'SELECT * FROM absence INNER JOIN report on absence.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $unjustifiedAbsences = $req->fetchall(PDO::FETCH_ASSOC);
        
        foreach ($unjustifiedAbsences as $absence) 
        {
                $obj[]=(new Absence())->hydrate($absence);
        }
        
        return $obj;
    }

    
    public function getNbOfUnjustifiedAbsencesByUser(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM absence INNER JOIN report on absence.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $unjustifiedAbsences = $req->fetchall(PDO::FETCH_ASSOC);
        
       return $nbAbsences = count($unjustifiedAbsences);
        

    }




    
}