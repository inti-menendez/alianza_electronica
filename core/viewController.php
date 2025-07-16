<?php
class viewController
{
    private $allowedViews = ['home', 'customers', 'devices', 'users', 'tasks'];
    private $rolePermissions = [
        'super_admin' => ['home', 'customers', 'devices', 'users', 'tasks'],
        'admin' => ['home', 'customers', 'devices', 'users', 'tasks'],
        'user' => ['home', 'customers', 'devices', 'users', 'tasks']
    ];
    private function getToRender($view, $DIR = '')
    {
        return $DIR . "/views/" . $view;
    }

    private function canRenderView($view)
    {
        $userRole = $_SESSION['user']['role'];

        return in_array($view, $this->allowedViews) && in_array($view, $this->rolePermissions[$userRole] ?? []);
    }

    public static function render($view = 'home', $DIR = '')
    {
        
        $instance = new self();
        $viewPath = $instance->getToRender($view, $DIR);

        $canRender = $instance->canRenderView($view);


        require_once ($canRender ?  $viewPath : '403') . '.php';
    }

    public static function sendData($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    // public static function getDataToShow($dataControl)
    // {
    //     $instance = new self();

    //     $view = $instance->getToRender();
    //     $a = $instance->canRenderView($view);

    //     if ($a !== '404' & $a !== false) {
    //         $data = $dataControl->$view();

    //         return $data;
    //     }
    //     return;
    // }
}
