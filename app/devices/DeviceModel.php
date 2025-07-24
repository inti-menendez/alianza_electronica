<?php

class DeviceModel extends CRUD
{
    public static function table($name = 'devices')
    {
        return parent::table('devices');
    }

    public static function all()
    {
        return
            self::table()
            ->orderBy('name')
            ->read();
    }

    public static function findBy($value, $field = 'id')
    {
        return
            self::table()
                ->where($field, '=', $value)
                ->limit(1)
                ->read()[0] ?? 'Equipo no encontrado';
    }
}
