<?php require '../core/Controller.php';
require '../src/manager/AdminManager.php';

class AdminController extends Controller {

    public function index()
    {
        require_once '../app/service/admin-check.php';
        $data = compact('admin');
        
        $path= '../templates/pages/admin/index.html.php';
        $this->renderView($path, $data);
    }
    
}