<?php 

namespace App\Manager;

use PDO;

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

}