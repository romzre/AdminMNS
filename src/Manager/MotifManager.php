<?php

namespace App\Manager;

use PDO;
use App\Entity\Motif;


class MotifManager
{

    public function getAllMotif()
    {
        $pdo = PdoManager::getPdo();

        $sql = 'SELECT * FROM motif';
        $req = $pdo->prepare($sql);
        $req->execute();

        $motifs = $req->fetchAll(PDO::FETCH_ASSOC);

        return $motifs;
    }
}
