<?php 

namespace App\Manager;


use PDO;
use App\Entity\Document;

class DocumentManager {

    private int $id_document;
    private string $path_file;
    private string $wording_file;
    private bool $is_valid ; 
    private int $id_user;

    public function checkTrainingDocsUser ()
    {
        "SELECT document.id_user, document.id_document , document.isValid , typeOfDoc.id_typeOfDoc , wording_typeOfDoc FROM document INNER JOIN trainingDocs ON trainingDocs.id_document = document.id_document INNER JOIN typeOfDoc ON trainingDocs.id_typeOfDoc = typeOfDoc.id_typeOfDoc WHERE id_user = :id_user";
    }

    public function insertUserFile (string $path_file, string $wording_file, string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= "INSERT into document (path_file, wording_file, isValid, id_user) VALUES (:path_file, :wording_file, null, :id_user)";

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user),
            'path_file'=>$path_file,
            'wording_file'=>$wording_file
        ]);

        return $id_document = $pdo->lastInsertId();

    }

    public function getAllDocsFromUser($id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= "SELECT document.id_document , wording_file, document.isValid, id_user , typeOfDoc.id_typeOfDoc , wording_typeOfDoc , training.id_training, title_formation FROM `document` INNER JOIN trainingDocs ON document.id_document = trainingDocs.id_document INNER JOIN typeOfDoc ON trainingDocs.id_typeOfDoc = typeOfDoc.id_typeOfDoc INNER JOIN training ON trainingDocs.id_training = training.id_training WHERE id_user = :id_user";

        $req = $pdo->prepare($sql);

        $req->execute([
            'id_user' => $id_user
        ]);

        $docs = $req->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($docs))
        {
            return $docs;
        }
        else
        {
            return false;
        }
    
    }

    public function unvalidateDoc($id_document)
    {
        $pdo=PdoManager::getPdo();
        $sql= "UPDATE `document` SET `isValid`= 0 WHERE id_document = :id_document";

        $req = $pdo->prepare($sql);

        $stmt = $req->execute([
            'id_document' => $id_document
        ]);

        return $stmt;
    }

}