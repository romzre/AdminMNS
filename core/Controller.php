<?php require '../core/View.php';

abstract class Controller {

    abstract public function index();

    protected function renderView(string $path, array $data)
    {
        $view= new View($path, $data);
        $view->render();
    }

}