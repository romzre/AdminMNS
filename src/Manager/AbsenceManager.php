<?php

namespace App\Manager;


use App\Entity\Absence;
use App\Manager\ReportManager;
use PDO;

// require_once '../src/manager/ReportManager.php';
// require_once '../src/Entity/Absence.php';

class AbsenceManager extends ReportManager
{

    /**
     * getAll
     *
     * @return void
     */
    public function getAllAbsences()
    {
        $pdo = PdoManager::getPdo();

        $sql = 'SELECT * FROM absence ';
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
        $pdo = PdoManager::getPdo();
        $sql = 'SELECT *, DATEDIFF(NOW(), absence.startingDate_absence) as `deadline` FROM absence JOIN report on absence.id_report = report.id_report LEFT JOIN motif on motif.id_motif=report.id_motif WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => $id_user
        ]);

        $absences = $req->fetchAll(PDO::FETCH_ASSOC);

        return $absences;
    }

    public function getUnjustifiedAbsencesByUser(string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = 'SELECT * FROM absence INNER JOIN report on absence.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => intval($id_user)
        ]);

        $unjustifiedAbsences = $req->fetchall(PDO::FETCH_ASSOC);

        foreach ($unjustifiedAbsences as $absence) {
            $obj[] = (new Absence())->hydrate($absence);
        }

        return $obj;
    }


    public function getNbOfUnjustifiedAbsencesByUser(string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = 'SELECT * FROM absence INNER JOIN report on absence.id_report=report.id_report WHERE id_user=:id_user AND isJustified=0';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => intval($id_user)
        ]);

        $unjustifiedAbsences = $req->fetchall(PDO::FETCH_ASSOC);

        return $nbAbsences = count($unjustifiedAbsences);
    }

    public function getAbsencesToJustify(string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = "SELECT absence.id_report, DATE_FORMAT(startingDate_absence, '%d/%m/%Y') AS `date_de_début`, DATE_FORMAT(endDate_absence, '%d/%m/%Y') AS `date_de_fin`, DATEDIFF(endDate_absence, startingDate_absence) AS `durée`, report.id_motif as motif, report.isJustified as justificatif from absence inner join report on report.id_report = absence.id_report left join motif on motif.id_motif = report.id_motif left join absenceDocs on absenceDocs.id_report = report.id_report left join document on document.id_document = absenceDocs.id_document where report.isJustified is null and document.id_document is null and report.id_user=:id_user and DATEDIFF(NOW(), absence.startingDate_absence)<=2";


        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => intval($id_user)
        ]);

        $absencesToJustify = $req->fetchall(PDO::FETCH_ASSOC);

        return $absencesToJustify;
    }
}
