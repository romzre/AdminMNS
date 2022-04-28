<?php 

require_once '../src/manager/ReportManager.php';
require_once '../src/Entity/Delay.php';

class DelayManager extends ReportManager {

    /**
     * getAll
     *
     * @return void
     */
    public function getAllDelays()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM delay';
        $req = $pdo->query($sql);
        
        $delays = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $delays;
    }
    
    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserDelay(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM delay WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>$id_user
        ]);
        
        $absences = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $absences;
    }

    public function getUnjustifiedDelaysByUser(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM delay INNER JOIN report on delay.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $unjustifiedDelays = $req->fetchall(PDO::FETCH_ASSOC);
        
        foreach ($unjustifiedDelays as $delay) 
        {
                $obj[]=(new Delay())->hydrate($delay);
        }
        
        return $obj;
    }


    public function getNbOfUnjustifiedDelaysByUser(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM delay INNER JOIN report on delay.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $unjustifiedDelays = $req->fetchall(PDO::FETCH_ASSOC);
        
        return count($unjustifiedDelays);
    }

    
}