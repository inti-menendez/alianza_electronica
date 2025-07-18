<?php

class CRUD
{
    protected static $conn;
    protected static $table;
    protected static $wheres = [];
    protected static $orderBy = '';
    protected static $groupBy = '';
    protected static $limit = '';
    protected static $bindings = [];
    protected static $joins = [];
    protected static $sql = '';

    public static function connect()
    {
        self::$conn = db::connectDB();
    }

    public static function table(string $nombre)
    {
        self::connect();
        self::reset();
        self::$table = $nombre;
        return new static;
    }

    public static function create(array $data)
    {
        if (!self::$table) {
            throw new Exception("No table specified for create operation");
        }

        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO "
            . self::$table
            . " ({$fields})
         VALUES ({$placeholders})";

        self::$sql = $sql;
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($data);
    }

    public static function read(array $data = [])
    {
        $table = self::$table;
        if (!$table) {
            throw new Exception("No table specified for read operation");
        }
        if (empty($data)) {
            $data = '*';
        } elseif (is_array($data)) {
            $data = implode(', ', $data);
        }
        $sql = "SELECT $data FROM {$table}";

        if (self::$joins) {
            $sql .= ' ' . implode(' ', self::$joins);
        }

        if (self::$wheres) {
            $sql .= ' WHERE ' . implode(' AND ', self::$wheres);
        }

        if (self::$orderBy) {
            $sql .= ' ' . self::$orderBy;
        }

        if (self::$groupBy) {
            $sql .= ' ' . self::$groupBy;
        }

        if (self::$limit) {
            $sql .= ' ' . self::$limit;
        }
        self::$sql = $sql;

        $stmt = self::$conn->prepare($sql);
        $stmt->execute(self::$bindings);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update($id, array $data, $key = 'id')
    {
        $fields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $table = self::$table;
        if (!$table) {
            throw new Exception("No table specified for update operation");
        }
        $sql = "UPDATE {$table} SET {$fields} WHERE {$key} = :id";

        $data['id'] = $id;
        self::$sql = $sql;
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete($id, $primaryKey = 'id')
    {
        $table = self::$table;
        if (!$table) {
            throw new Exception("No table specified for delete operation");
        }
        $sql = "DELETE FROM {$table} WHERE {$primaryKey} = :id";

        self::$sql = $sql;

        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // UTILS O CONTEXTO PARA CONSTRUIR CONSULTAS

    public static function join(string $table, string $condition, string $type = 'INNER')
    {
        $type = strtoupper($type);
        $validos = ['INNER', 'LEFT', 'RIGHT'];
        if (!in_array($type, $validos)) {
            throw new Exception("JOIN inválido: {$type}");
        }

        self::$joins[] = "{$type} JOIN {$table} ON {$condition}";
        return new static;
    }

    public static function where(string $field, string $operator, mixed $value)
    {
        
        $param = str_replace('.', '_', $field) . count(self::$wheres);

        switch (strtoupper($operator)) {
            case 'IN':
                if (!is_array($value)) throw new Exception("Valor para IN debe ser un array");
                $placeholders = [];
                foreach ($value as $i => $v) {
                    $alias = "{$param}_{$i}";
                    $placeholders[] = ":{$alias}";
                    self::$bindings[$alias] = $v;
                }
                self::$wheres[] = "{$field} IN (" . implode(', ', $placeholders) . ")";
                break;

            case 'BETWEEN':
                if (!is_array($value) || count($value) !== 2) throw new Exception("Valor para BETWEEN debe ser array con 2 elementos");
                $alias1 = "{$param}_1";
                $alias2 = "{$param}_2";
                self::$bindings[$alias1] = $value[0];
                self::$bindings[$alias2] = $value[1];
                self::$wheres[] = "{$field} BETWEEN :{$alias1} AND :{$alias2}";
                break;

            case 'LIKE':
            case '!=':
            case '<>':
            case '=':
            case '<':
            case '>':
            case '<=':
            case '>=':
                self::$wheres[] = "{$field} {$operator} :{$param}";
                self::$bindings[$param] = $value;
                break;

            default:
                throw new Exception("Operador no soportado: {$operator}");
        }

        return new static;
    }

    public static function orWhere(string $field, string $operator, mixed $value)
    {
        $param = preg_replace('/[^a-zA-Z0-9_]/', '_', $field) . count(self::$wheres);
        $clausula = "{$field} {$operator} :{$param}";
        self::$bindings[$param] = $value;

        if (self::$wheres) {
            $last = array_pop(self::$wheres);
            self::$wheres[] = "(" . $last . " OR " . $clausula . ")";
        } else {
            self::$wheres[] = $clausula;
        }

        return new static;
    }

    public static function whereGroup(callable $grupo)
    {
        $oldWheres = self::$wheres;
        $oldBindings = self::$bindings;

        self::$wheres = [];
        self::$bindings = [];

        $grupo(new static);

        $grouped = implode(' AND ', self::$wheres);
        self::$wheres = $oldWheres;
        self::$wheres[] = "(" . $grouped . ")";
        $groupBindings = self::$bindings;
        self::$bindings = $oldBindings + $groupBindings;

        return new static;
    }

    public static function orderBy(string $field, string $direction = 'ASC')
    {
        self::$orderBy = "ORDER BY {$field} {$direction}";
        return new static;
    }

    public static function groupBy(string $field)
    {
        self::$groupBy = "GROUP BY {$field}";
        return new static;
    }

    public static function limit(int $n)
    {
        self::$limit = "LIMIT {$n}";
        return new static;
    }

    public static function getSql()
    {
        $sql = self::$sql;
        foreach (self::$bindings as $key => $value) {
            $v = is_numeric($value) ? $value : "'" . addslashes($value) . "'";
            $sql = str_replace(":{$key}", $v, $sql);
        }
        return $sql;
    }

    protected static function reset()
    {
        self::$table = '';
        self::$wheres = [];
        self::$bindings = [];
        self::$orderBy = '';
        self::$groupBy = '';
        self::$limit = '';
        self::$joins = [];
        self::$sql = '';
    }
}
