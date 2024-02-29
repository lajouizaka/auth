<?php

namespace Core\support;

use Core\database\DB;

class Model
{
    protected string $table;
    protected array $fillable;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Select Methods
     */
    public function count(array $conditions): int
    {
        $stm = DB::rawQuery("SELECT COUNT(id) AS count FROM ". $this->getTable() ." " . $this->conditionsString($conditions) .";");
        return $stm->fetch()["count"];
    }

    public function columnsString(array $columns): string
    {
        return (
            empty($columns)
                ? "*"
                : implode(", ", $columns)
        );
    }

    public function conditionsString(array $conditions): string
    {

        if (empty($conditions)) {
            return "";
        }

        $string = "WHERE ";

        foreach ($conditions as $column => $condition) {
            if (is_array($condition)) {

                if (is_array($condition[0])) {
                    $string.= " ( ";

                    foreach ($condition as $cond) {
                        $string .= " $column ". $cond[0] ." ". $cond[1] . " OR ";
                    }

                    $string.= " ) ";

                    $string.= " AND";

                } else {
                    $string.= " $column ". $condition[0] ." ". $condition[1] . " AND";
                }

            } else {
                $string.= " $column = $condition AND";
            }
        }

        $string = substr($string, 0, -4);

        return $string;
    }

    public function select(array $columns, array $conditions = []): array | bool
    {
        $query = "SELECT "
                    . $this->columnsString($columns)
                    . " FROM " . $this->getTable() . " " . $this->conditionsString($conditions) ." ;";

        $stm = DB::rawQuery($query);

        $data = $stm->fetchAll();

        return $data;
    }

    public static function all(array $columns = []): array | bool
    {
        return (new static())->select($columns);
    }

    public function allWithPagination(array $columns, $conditions): object | bool
    {
        // Validate Page Value
        $page = (int)($_GET["page"] ?? 1);
        $lastPage = (int) ceil($this->count($conditions) / 10);

        if ($lastPage === 0) {
            return (object)[
                "data"      => [],
                "pagination"    => false
            ];
        }

        $out_of_scope = $page < 0 || $page > $lastPage;
        if ($out_of_scope) {
            return false;
        }

        if ($lastPage <= 2) {
            return (object)[
                "data"      => $this->select($columns, $conditions),
                "pagination"    => false
            ];
        }

        $perPage = 10;
        $offset = ($page - 1) * 10;
        $stm = DB::rawQuery("SELECT " . $this->columnsString($columns) . " FROM ". $this->getTable() ." LIMIT $perPage OFFSET $offset;");

        $data = $stm->fetchAll();

        $links = [];

        // Links of surronded pages
        if ($lastPage < 5) {
            for ($i = 0; $i < $lastPage; $i++) {
                $links[] = $i + 1;
            }
        } else {
            if ($page < 3) {
                $start = 1;
            } elseif ($page + 3 > $lastPage) {
                $start = $lastPage - 4;
            } else {
                $start = $page - 2;
            }

            for ($i = $start; $i < $start + 5; $i++) {
                $links[] = (int) $i;
            }
        }

        return (object) [
            "data"  => $data,
            "pagination"  => (object) [
                "last"      => $lastPage,
                "links"      => $links,
                "previous"  => $page === 1 ? null : $page - 1,
                "next"      => $page === $lastPage ? null : $page + 1,
            ]
        ];
    }

    public static function paginate(array $columns = [], array $conditions = []): object | bool
    {
        return (new static())->allWithPagination($columns, $conditions);
    }

    public static function find(int $id, array $columns = []): array | bool
    {
        $result =(new static())->select($columns, ["id" => $id]);
        return $result ? $result[0] : false;
    }

    /**
     * Insertion Methods
     */
    protected function insertQueryParams($fields)
    {
        $columns=[];
        $values=[];

        foreach ($fields as $column => $value) {
            if (in_array($column, $this->fillable)) {
                $columns[] = $column;
                $values[] = $value;
            }
        }

        return [
            "( " . implode(", ", $columns) . " )",
            "( " . substr(str_repeat("?, ", sizeof($values)), 0, -2) . " )",
            $values
        ];

    }

    protected function insertManyQueryParams(array $entities)
    {
        $columns    = [];
        $values     = [];

        foreach ($entities[0] as $column => $_) {
            $columns[] = $column;
        }

        foreach ($entities as $entity) {
            foreach ($columns as $column) {
                $values[] = $entity[$column];
            }
        }

        return [
            " ( " . $this->columnsString($columns) . " ) ",
            substr(
                str_repeat(
                    " ( " .
                    substr(
                        str_repeat(
                            "?, ",
                            sizeof($columns)
                        ),
                        0,
                        -2
                    )
                    . " ), ",
                    sizeof($entities)
                ),
                0,
                -2
            ),
            $values
        ];
    }

    public function insert(array $fields)
    {
        [ $columns, $placeholders, $values ] = isset($fields[0]) && is_array($fields[0])
                                                ? $this->insertManyQueryParams($fields)
                                                : $this->insertQueryParams($fields);

        $query = "INSERT INTO " . $this->getTable() . " " . $columns . " VALUES " . $placeholders . " ;";

        $stm = DB::query($query);

        $stm->execute($values);

        return DB::lastID();
    }

    public static function save(array $fields)
    {
        return (new static())->insert($fields);
    }

    public static function saveMany(array $entities)
    {
        return (new static())->insert($entities);
    }

    /**
     * Update Methods
     */

    public function updatesString(array $fields): array
    {
        $setters = "";
        $values=[];

        foreach ($fields as $column => $value) {
            if (in_array($column, $this->fillable)) {
                $setters .="$column = ? , ";
                $values[] = $value;
            }
        }

        return [
            substr($setters, 0, -2),
            $values
        ];
    }

    public function updateEntity(int $id, array $entity): bool
    {
        [$setters,$values] = $this->updatesString($entity);

        $query = "UPDATE " . $this->getTable() . " SET " . $setters . "WHERE id = ? ;";

        array_push($values, $id);

        $stm = DB::query($query);

        $stm->execute($values);

        return (bool)$stm->rowCount();
    }

    public static function update(int $id, array $entity): bool
    {
        return (new static())->updateEntity($id, $entity);
    }

    /**
     * 🤯 Destroying Methods
     */    public function del(int $id = null): bool
    {
        $query = "DELETE FROM " . $this->getTable() . (
            $id
            ? " WHERE id = ? "
            : ""
        ).";";
        $stm = DB::query($query);
        $stm->execute([$id]);
        return $stm->rowCount();
    }

    public static function destroy(int $id): bool
    {
        return(new static())->del($id);
    }

    public static function clear(): bool
    {
        return(new static())->del();
    }
}
