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

    public function insert(string $id_motif, string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = "INSERT INTO `report` (id_motif, id_user)`id_motif`= :id_motif WHERE id_user = :id_user";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_user' => $id_user,
            'id_motif' => $id_motif
        ]);

        $id_report = $pdo->lastInsertId();

        return $id_report;
    }
}
