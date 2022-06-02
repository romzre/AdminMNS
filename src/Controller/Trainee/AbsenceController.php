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
            foreach ($absences as $key => $absence) {
                $startingDate = $absence['startingDate_absence'];
                $endDate = $absence['endDate_absence'];

                $format = 'Y-m-d H:i:s';
                $startingDate = DateTime::createFromFormat($format, $startingDate);
                $newStartingDate = $startingDate->format('d-m-Y');

                $endDate = DateTime::createFromFormat($format, $endDate);
                $newEndDate = $endDate->format('d-m-Y');

                $interval = $startingDate->diff($endDate);
                $duration = $interval->format('%a');

                $absence['startingDate_absence'] = $newStartingDate;
                $absence['endDate_absence'] = $newEndDate;
                $absence['duration'] = $duration;

                $absences[$key] = $absence;
            }

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

            if (isset($_POST['form-button-abs'])) {
                $message = $this->send_file();
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
        }
    }

    public function send_file()
    {

        $message = '';


        //on compte le nombre de document envoyé
        $nbDocs = count($_FILES);

        $doc_report = [];

        //on récupère l'id_typeOfWord qui étaient passés dans l'attribut name de l'input de chaque document et on les stocke dans le tableau $id_typeOfDoc

        // on crée un tableau dans regroupant les infos du document pour chaque document 
        foreach ($_FILES as $id_report => $data_doc) {
            $data_doc['id_report'] = $id_report;
            $doc_reports[] = $data_doc;
        }

        for ($i = 0; $i < $nbDocs; $i++) {
            $doc_report = $doc_reports[$i];
            if ($doc_report['error'] == 0) {
                // Testons si le fichier n'est pas trop gros (max 5Mo)
                if ($doc_report['size'] <= 5000000) {

                    if ($doc_report['name'] !== '') {

                        $wording_file = basename($doc_report['name']);
                        echo $wording_file;

                        // Testons si l'extension est autorisée
                        $infosfichier = pathinfo($doc_report['name']);

                        $extension_upload = $infosfichier['extension'];

                        $extensions_autorisees = array('pdf', 'jpg', 'jpeg', 'png');

                        if (in_array($extension_upload, $extensions_autorisees)) {

                            // On regarde si l'internaute a indiqué un motif pour son absence

                            $id_report = $doc_report['id_report'];

                            if (isset($_POST['absence'][$id_report]) && isset(($_POST['absence'][$id_report]['id_motif']))) {
                                $id_motif = ($_POST['absence'][$id_report]['id_motif']);

                                //on insere le motif dans la base de données 
                                $reportManager = new ReportManager();
                                $motif = $reportManager->updateMotif($id_motif, $id_report);

                                //si le motif a bien été inséré on déplace le fichier
                                if ($motif) {
                                    $directory = "../uploads/" . $_SESSION['id_user'] . "/absences/" . $id_report;

                                    //on vérifie que le dossier existe sinon on le créé
                                    if (is_dir($directory) == false) {
                                        mkdir($directory, 0777);
                                    }

                                    $path_file = "../uploads/" . $_SESSION['id_user'] . "/absences/" . $id_report . "/" . $wording_file;
                                    move_uploaded_file($doc_report['tmp_name'], $path_file);

                                    $documentManager = new DocumentManager();
                                    $id_document = $documentManager->insertUserFile($path_file, $wording_file, $_SESSION['id_user']);

                                    //on relie l'id_document et l'id_report dans la table absenceDocs
                                    $absenceDocsManager = new AbsenceDocsManager();
                                    $absenceDoc = $absenceDocsManager->insert($id_document, $id_report);

                                    if ($absenceDoc) {

                                        return $message .= "<p>Votre justificatif a bien été renvoyé, vous recevrez un email lorsque l'administration aura revu votre document</p>";
                                    }
                                } else {
                                    $message .= "<p>Merci de préciser le motif</p>";
                                }
                            } else {
                                $message .= "<p>Merci de préciser le motif</p>";
                            }
                        } else {
                            $message .= "<p>Seules les extensions pdf, jpeg, jpg et png sont autorisées !</p>";
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

            return $message;
        }
    }
}
