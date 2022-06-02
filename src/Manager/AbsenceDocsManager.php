<?php

namespace App\Manager;

use PDO;


// require_once '../src/manager/ReportManager.php';
// require_once '../src/Entity/Absence.php';

class AbsenceDocsManager
{

    /**
     * getAll
     *
     * @return void
     */
    public function getAllAbsences()
    {
    }

    public function insert(string $id_document, string $id_report)
    {
        $pdo = PdoManager::getPdo();

        $sql = 'INSERT INTO absenceDocs (id_document, id_report) VALUES (:id_document, :id_report) ';
        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_report' => $id_report,
            'id_document' => $id_document,
        ]);


        return $stmt;
    }
}
