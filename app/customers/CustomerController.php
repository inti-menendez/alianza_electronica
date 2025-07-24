<?php

class CustomerController extends controller
{
    public static function index()
    {
        SessionManager::requireLogin();
        $clientes = CustomerService::getListado();
        self::render(
            __DIR__ . '/views/index.php', 
            ['clientes' =>$clientes]
        );
    }
    public function show($id)
    {
        SessionManager::requireLogin();
        $allCustomerData = CustomerService::getFullProfile($id);
        self::render(
            __DIR__ . '/views/showDetail.php',
            ['data' => $allCustomerData]);
    }

    public function store()
    {
        $datos = $_POST;
        CustomerService::guardar($datos);
        header('Location: /customers');
    }

    public function update($id)
    {
        $datos = $_POST;
        CustomerService::actualizar($id, $datos);
        header("Location: /customers/$id");
    }

    public function destroy($id)
    {
        CustomerService::eliminar($id);
        header('Location: /customers');
    }
}
