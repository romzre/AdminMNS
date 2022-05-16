<?php 

require_once '../src/Entity/Entity.php';

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

}