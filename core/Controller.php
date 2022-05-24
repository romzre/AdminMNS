<?php

namespace Core;

abstract class Controller
{

    abstract public function index();

    protected function renderView(string $path, array $data)
    {
        $view = new View($path, $data);
        $view->render();
    }

    protected function reLocate(string $path)
    {
        header('Location: /' . $path);
    }
}
