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

    public static function details($id)
    {
        return CustomerModel::findBy($id);
    }
}