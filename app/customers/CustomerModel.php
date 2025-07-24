
<?php
class CustomerModel extends CRUD
{
    public static function table($name = 'customers')
    {
        return parent::table('customers');
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
                ->read()[0] ?? 'cliente no encontrado';
    }
}
