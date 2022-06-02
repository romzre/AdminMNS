<?php

namespace App\Manager;

use PDO;

// require_once 'PdoManager.php';

class ReportManager
{
    use PdoManager;

    public function updateMotif(string $id_motif, string $id_report)
    {
        $pdo = PdoManager::getPdo();
        $sql = "UPDATE `report` SET `id_motif`= :id_motif WHERE id_report = :id_report";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_report' => $id_report,
            'id_motif' => $id_motif
        ]);

        return $stmt;
    }
}
