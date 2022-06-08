<?php

namespace App\Manager;


use PDO;
use App\Entity\Document;

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

    public function getAllDocsFromUser($id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = "SELECT document.id_document , wording_file, document.isValid, id_user , typeOfDoc.id_typeOfDoc , wording_typeOfDoc , training.id_training, title_formation FROM `document` INNER JOIN trainingDocs ON document.id_document = trainingDocs.id_document INNER JOIN typeOfDoc ON trainingDocs.id_typeOfDoc = typeOfDoc.id_typeOfDoc INNER JOIN training ON trainingDocs.id_training = training.id_training WHERE id_user = :id_user";

        $req = $pdo->prepare($sql);

        $req->execute([
            'id_user' => $id_user
        ]);

        $docs = $req->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($docs)) {
            return $docs;
        } else {
            return false;
        }
    }

    public function unvalidateDoc($id_document)
    {
        $pdo = PdoManager::getPdo();
        $sql = "UPDATE `document` SET `isValid`= 0 WHERE id_document = :id_document";

        $req = $pdo->prepare($sql);

        $stmt = $req->execute([
            'id_document' => $id_document
        ]);

        return $stmt;
    }

    public function validateDoc($id_document)
    {
        $pdo = PdoManager::getPdo();
        $sql = "UPDATE `document` SET `isValid`= 1 WHERE id_document = :id_document";

        $req = $pdo->prepare($sql);

        $stmt = $req->execute([
            'id_document' => $id_document
        ]);

        return $stmt;
    }

    public function Delete($id_document)
    {
        $pdo = PdoManager::getPdo();


        $sql = "DELETE FROM `document` WHERE id_document = :id_document";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_document' => $id_document
        ]);

        return $stmt;
    }

    public function getDocById($id_document)
    {
        $pdo = PdoManager::getPdo();


        $sql = "SELECT * FROM `document`  WHERE id_document = :id_document";
        $req = $pdo->prepare($sql);
        $stmt =  $req->execute([
            'id_document' => $id_document
        ]);

        $doc = $req->fetch(PDO::FETCH_ASSOC);

        $obj = (new Document())->hydrate($doc);

        return $obj;
    }

    public function checkDocNewReport(array $docToCheck)
    {
        $dataToReturn = [];
        $message = '';
        $docChecked = false;

        //on compte le nombre de document envoyé

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
        $dataToReturn['wording_file'] = $wording_file;
        $dataToReturn['tmp_name'] = $doc_report['tmp_name'];
        $dataToReturn['isChecked'] = $docChecked;
        return $dataToReturn;
    }

    function move_absence_file(string $id_user, string $id_report, string $wording_file, string $tmp_name)
    {
        //si le motif a bien été inséré dans la base on déplace le fichier
        $first_directory = "../uploads/" . $id_user . "/absences";

        //on vérifie que le dossier existe sinon on le créé
        if (is_dir($first_directory) == false) {
            mkdir($first_directory, 0777);
        }
        $second_directory = "../uploads/" . $id_user . "/absences/" . $id_report;

        if (is_dir($second_directory) == false) {
            mkdir($second_directory, 0777);
        }

        if (is_dir($second_directory) == true) {
            $path_file = "../uploads/" . $id_user . "/absences/" . $id_report . "/" . $wording_file;
            move_uploaded_file($tmp_name, $path_file);

            $documentManager = new DocumentManager();
            $id_document = $documentManager->insertUserFile($path_file, $wording_file, $_SESSION['id_user']);

            return $id_document;
        }
    }
}
