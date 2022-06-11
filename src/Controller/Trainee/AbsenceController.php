<?php

namespace App\Controller\Trainee;

use DateTime;
use Core\Controller;
use App\Manager\UserManager;
use App\Manager\MotifManager;
use App\Manager\ReportManager;
use App\Manager\AbsenceManager;
use App\Manager\TraineeManager;
use App\Manager\DocumentManager;
use App\Manager\AbsenceDocsManager;

class AbsenceController extends Controller
{

    public function index()
    {

        session_start();


        if (!empty($_SESSION['id_user'])) {

            // on récupère les absences du stagiaires
            $absenceManager = new AbsenceManager();
            $absences = $absenceManager->getUserAbsences($_SESSION['id_user']);

            //on traite les données de la date de début et de fin pour pouvoir l'afficher dans le template
            $indexTab = count($absences);
            $data['indexTab'] = $indexTab;
            $data['absences'] = $absences;

            $path = 'pages/trainee/absences.html.twig';

            $this->renderView($path, $data);
        } else $this->reLocate();
    }

    public function justify()
    {

        if (empty($_SESSION['id_user'])) session_start();


        if (!empty($_SESSION['id_user'])) {

            $hasAbsencesToJustify = false;

            if (isset($_POST)) {
                $message = $this->send_justificatif();
                $data['message'] = $message;
            }

            $absenceManager = new AbsenceManager();
            $absencesToJustify = $absenceManager->getAbsencesToJustify($_SESSION['id_user']);

            if (!empty($absencesToJustify)) {
                $hasAbsencesToJustify = true;
                $count = count($absencesToJustify);

                foreach ($absencesToJustify as  $absence) {
                    $keys = [];
                    foreach ($absence as $key => $value) {
                        $keys[] = $key;
                    }
                }
                unset($keys[0]);

                $nbColumns = count($keys);
                $motifManager = new MotifManager();
                $motifs = $motifManager->getAllMotif();

                $data['keys'] = $keys;
                $data['nb_absences'] = $count;
                $data['nb_columns'] = $nbColumns;
                $data['absences'] = $absencesToJustify;
                $data['motifs'] = $motifs;
            } else {
                $hasAbsencesToJustify = false;
            }
            $data['absencesToJustify'] = $hasAbsencesToJustify;
            $path = 'pages/trainee/justify_absence.html.twig';


            $this->renderView($path, $data);
        } else $this->reLocate();
    }


    public function send_justificatif()
    {

        $message = '';

        $doc_reports = [];

        //on récupère l'id_typeOfWord qui étaient passés dans l'attribut name de l'input de chaque document et on les stocke dans le tableau $id_typeOfDoc

        // on crée un tableau regroupant les infos du document pour chaque document envoyé (si name n'est pas nul, on considère qu'un doc a été envoyé)
        foreach ($_FILES as $id_report => $data_doc) {
            if ($data_doc['name'] != '') {
                $data_doc['id_report'] = $id_report;
                $doc_reports[] = $data_doc;
            }
        }

        //on compte le nombre de document envoyé
        $nbDocs = count($doc_reports);


        for ($i = 0; $i < $nbDocs; $i++) {
            $doc_report = $doc_reports[$i];


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

                            $id_report = $doc_report['id_report'];

                            // On regarde si l'internaute a indiqué un motif pour son absence

                            if (isset($_POST['absence'][$id_report]) && isset(($_POST['absence'][$id_report]['id_motif']))) {
                                $id_motif = ($_POST['absence'][$id_report]['id_motif']);

                                //on met à jour le motif de l'absence dans la base de données 
                                $reportManager = new ReportManager();
                                $motif = $reportManager->updateMotif($id_motif, $id_report);


                                //si le motif a bien été inséré dans la base on déplace le fichier
                                if ($motif) {
                                    $directory = "../uploads/" . $_SESSION['id_user'] . "/absences/" . $id_report;

                                    //on vérifie que le dossier existe sinon on le créé
                                    if (is_dir($directory) == false) {
                                        mkdir($directory, 0777);
                                    }

                                    if (is_dir($directory) == true) {
                                        $path_file = "../uploads/" . $_SESSION['id_user'] . "/absences/" . $id_report . "/" . $wording_file;
                                        move_uploaded_file($doc_report['tmp_name'], $path_file);

                                        $documentManager = new DocumentManager();
                                        $id_document = $documentManager->insertUserFile($path_file, $wording_file, $_SESSION['id_user']);

                                        //on relie l'id_document et l'id_report dans la table absenceDocs
                                        $absenceDocsManager = new AbsenceDocsManager();
                                        $absenceDoc = $absenceDocsManager->insert($id_document, $id_report);


                                        if ($absenceDoc) {
                                            return $message .= "<p>Votre justificatif a bien été envoyé, vous recevrez un email lorsque l'administration aura revu votre document</p>";
                                        }
                                    } else {
                                        $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
                                    }
                                } else {
                                    $message .= "<p>Merci de préciser le motif</p>";
                                }
                            } else {
                                $message .= "<p>Merci de préciser le motif</p>";
                            }
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
                $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
            }
        }
        return $message;
    }

    public function

    declare()
    {

        if (empty($_SESSION['id_user'])) session_start();


        if (!empty($_SESSION['id_user'])) {
            $message = "";

            if (isset($_POST['btn-declare-abs'])) {

                $message = "";

                if (empty($_POST['startingDate_absence'])) {
                    $message .= "<p>Merci de préciser une date de début</p>";
                } else $startingDate_absence = $_POST['startingDate_absence'];
                if (empty($_POST['endDate_absence'])) {
                    $message .= "<p>Merci de préciser une date de fin</p>";
                } else $endDate_absence = $_POST['endDate_absence'];

                if (empty($_POST['id_motif']) || $_POST['id_motif'] == 'null') {
                    $message .= "<p>Merci de préciser le motif de votre absence</p>";
                } else $id_motif = $_POST['id_motif'];

                if (isset($startingDate_absence) && isset($endDate_absence) && isset($id_motif)) {

                    if ($endDate_absence > $startingDate_absence) {

                        // on créé un nouveau report 
                        $reportManager = new ReportManager();
                        $id_report = $reportManager->insert($id_motif, $_SESSION['id_user']);

                        if ($id_report) {
                            //on ajoute le report à la table absence

                            $absenceManager = new AbsenceManager();
                            $absenceAdded = $absenceManager->insertAbsence($id_report, $startingDate_absence, $endDate_absence);

                            if ($absenceAdded) {

                                //on regarde si l'utilisateur a coché la case "transmettre justificatif"
                                if (isset($_POST['checkbox_justificatif'])) {

                                    //si c'est le cas, on vérifie son document
                                    $documentManager = new DocumentManager();
                                    $documentChecked = $documentManager->checkDocNewReport($_FILES);

                                    //la méthode checkDcoNewReport nous renvoie un tabl avec un booléan (vrai ou faux) si le doc a bien été vérifié, le wording_file, et le tmp_name

                                    $message .= $documentChecked['message'];

                                    //si le doc a été vérifié, on insère le doc dans la BDD et on le déplace dans le fichier uploads
                                    if ($documentChecked['isChecked']) {

                                        $id_document = $documentManager->move_absence_file($_SESSION['id_user'], $id_report, $documentChecked['wording_file'], $documentChecked['tmp_name']);
                                        if ($id_document) {
                                            //on relie l'id_document et l'id_report dans la table absenceDocs

                                            $absenceDocsManager = new AbsenceDocsManager();
                                            $absenceDoc = $absenceDocsManager->insert($id_document, $id_report);

                                            if ($absenceDoc) {

                                                $message .= "<p>Votre absence a bien été enregistrée. Vous recevrez un email lorsque l'administration aura revu votre document</p>";
                                            } else $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
                                        } else $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
                                    }
                                } else $message .= "<p>Votre absence a bien été enregistrée, merci de nous faire parvenir votre justificatif au plus vite</p>";
                            } else $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
                        } else $message .= "<p>Oups, il y a eu un problème lors de l'envoi, merci de renouveller l'opération </p>";
                    } else $message .= "<p>La date de fin de votre absence doit être postérieure à la date de début</p>";;
                }
            }

            $motifManager = new MotifManager();
            $motifs = $motifManager->getAllMotif();

            $data['message'] = $message;
            $data['motifs'] = $motifs;

            $path = 'pages/trainee/declare_absence.html.twig';
            $this->renderView($path, $data);
        } else $this->reLocate();
    }
}
