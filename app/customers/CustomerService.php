<?php

class CustomerService
{
    public static function getListado()
    {
        return CustomerModel::all();
    }

    public static function guardar(array $datos)
    {
        return CustomerModel::table()->create($datos);
    }

    public static function actualizar($id, array $datos)
    {
        return CustomerModel::table()->update($id, $datos);
    }

    public static function eliminar($id)
    {
        return CustomerModel::table()->delete($id);
    }

    public static function getDetails($id)
    {
        return CustomerModel::findBy($id);
    }

        public static function getFullProfile($id)
    {
        $customer = CustomerModel::findBy($id);

        $devices = DeviceModel::table()
            ->where('customer_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->read();

        $tasks = TaskModel::table()
            ->where('customer_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->read();

        return [
            'customer' => $customer,
            'devices' => $devices,
            'tasks'   => $tasks
        ];
    }
}