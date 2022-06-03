<?php

namespace App\Manager;

use PDO;

class DocumentManager
{

    private int $id_document;
    private string $path_file;
    private string $wording_file;
    private bool $is_valid;
    private int $id_user;

    public function checkTrainingDocsUser()
    {
        "SELECT document.id_user, document.id_document , document.isValid , typeOfDoc.id_typeOfDoc , wording_typeOfDoc FROM document INNER JOIN trainingDocs ON trainingDocs.id_document = document.id_document INNER JOIN typeOfDoc ON trainingDocs.id_typeOfDoc = typeOfDoc.id_typeOfDoc WHERE id_user = :id_user";
    }

    public function insertUserFile(string $path_file, string $wording_file, string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = "INSERT into document (path_file, wording_file, isValid, id_user) VALUES (:path_file, :wording_file, null, :id_user)";

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => intval($id_user),
            'path_file' => $path_file,
            'wording_file' => $wording_file
        ]);

        return $id_document = $pdo->lastInsertId();
    }

    public function getDoc($id_document)
    {
        $pdo = PdoManager::getPdo();
        $sql = "SELECT * FROM `document` WHERE id_document = :id_document";

        $req = $pdo->prepare($sql);

        $req->execute([
            'id_document' => $id_document
        ]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function checkDocNewReport(array $docToCheck)
    {
        $dataToReturn = [];
        $message = '';
        $docChecked = false;

        //on compte le nombre de document envoyé
        var_dump($docToCheck);

        $doc_report = $docToCheck['report_justificatif'];

        if ($doc_report['error'] == 0) {
            // Testons si le fichier n'est pas trop gros (max 5Mo)
            if ($doc_report['size'] <= 5000000) {

                if ($doc_report['name'] !== '') {

                    $wording_file = basename($doc_report['name']);

                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($doc_report['name']);

                    $extension_upload = $infosfichier['extension'];

                    $extensions_autorisees = array('pdf', 'jpg', 'jpeg');

                    $mime_type = mime_content_type($doc_report['tmp_name']);
                    $allowed_file_types = ['image/jpeg', 'image/jpg', 'application/pdf'];

                    if (in_array($extension_upload, $extensions_autorisees) && in_array($mime_type, $allowed_file_types)) {

                        // On regarde si l'internaute a indiqué un motif pour son absence
                        $docChecked = true;
                        $id_report = $doc_report['id_report'];
                        $dataToReturn['id_report'] = $id_report;
                    } else {
                        $message .= "<p>Seules les extensions pdf, jpeg et jpg sont autorisées !</p>";
                    }
                } else {
                    $message .= '<p>Le fichier doit avoir un titre</p>';
                }
            } else {
                $message .= '<p>Le fichier est trop volumineux</p>';
            }
        } else {
            $message .= "<p>Oups il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
        }
        $dataToReturn['message'] = $message;
        $dataToReturn['docChecked'] = $docChecked;
        return $dataToReturn;
    }
}
