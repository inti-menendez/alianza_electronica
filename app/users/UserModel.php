<?php 


class UserModel extends CRUD
{
    public static function table($name = 'users')
    {
        return parent::table('users');
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
                ->read()[0] ?? 'Usuario no encontrado';
    }


}