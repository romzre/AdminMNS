<?php require '../core/View.php';



abstract class Controller {

    abstract public function index();

    protected function renderView(string $path, array $data, string $layOut)
    {
        $view= new View($path, $data, $layOut);
        $view->render();
    }

}