<?php


abstract class DbManager {
    private $connection;
    protected $table;

    /**
     * DbManager constructor.
     * @param $connection
     */
    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=demo_php', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

        function persist($object) {
            $values = array_values((array) $object);
            try {
                $interrogation = array_fill(0, count($values), '?');
                $placers = implode(',', $interrogation);
                var_dump($interrogation);
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} VALUES ({$placers})"
                );
                $statement->execute($values);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }

    function fetchAllInArray() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print $e->getMessage()." pour fetchallinarray".$this->table;
        }
    }

    function updateTable($object) {
        $values = get_object_vars($object);
        try {
            $setSql = array();

            foreach ($values as $column => $value) {
                $setSql[] = "`{$column}` = :{$column}";
            }

            $setString = implode(', ', $setSql);
            $statement = $this->connection->prepare(
                "UPDATE {$this->table} SET {$setString} WHERE pk = :pk"
            );
            $statement->execute($values);
        } catch(PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetchOne($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function erase($pk) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            if($statement->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return false;
    }

}