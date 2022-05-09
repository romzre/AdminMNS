<?php

namespace App\Controller\Admin;

use Core\Controller;
use App\Manager\TraineeManager;


class HomeController extends Controller {
    
    /**
     * index affiche la première page aprés la connexion lorsque l'utilisateur est administrateur
     *
     * @return void
     */
    public function index()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';
        $manager = new TraineeManager();

        $registered = $manager->getAllRegistered();

        

        $data = compact('admin', 'registered');
        $path= 'pages/admin/index.html.twig';
        $layOut='base-admin';
        
        $this->renderView($path, $data, $layOut);
    }
    
    /**
     * inscrits affiche les personnes qui souhaitent s'inscrire dans la formation. Ils ont fait la demande et doivent attendre le retour de l'adminsitrateur
     *
     * @return void
     */
    public function inscrits()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $registered = $manager->getAllRegistered();

        $data = compact('admin', 'registered');

        $path= 'pages/admin/index.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
    
    /**
     * candidates permet d'afficher les personnes qui doivent transmettre les pieces justificatives pour pouvoir etre stagiaire de la formation
     *
     * @return void
     */
    public function candidates()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $candidates = $manager->getAllCandidates();

        $data = compact('admin', 'candidates');

        $path= 'pages/admin/candidates.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
    
    /**
     * trainees permet d'afficher tout les stagiaires de la formation
     *
     * @return void
     */
    public function trainees()
    {
        require_once '../app/service/admin-check.php';
   
        require '../src/Manager/TraineeManager.php';

        $manager = new TraineeManager();

        $trainees = $manager->getAllTrainees();

        $data = compact('admin', 'trainees');

        $path= 'pages/admin/trainees.html.twig';
        $layOut='base-admin';
        $this->renderView($path, $data, $layOut);

    }
}