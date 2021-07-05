<?php
require_once './config/db.php';
require_once './interfaces/Repository.php';

class Mysql extends DB implements Repository
{
  private function convertColumnsPdo(
    array $array_keys,
    String $pattern = '',
    Bool $double = false
  ): String {
    // $columns = array_map(fn($n) => $double ? "$n" . "$pattern" . "$n" : "$pattern" . "$n", $array_keys);
    $columns = array();
    foreach($array_keys as $key)
    {
      $pdoColumn = $double ? "$key" . "$pattern" . "$key" : "$pattern" . "$key";
      array_push($columns, $pdoColumn);
    }

    return implode(", ", $columns);
  }

  public function create(array $data, String $table): Bool
  {
    $insertColumns = $this->convertColumnsPdo(array_keys($data));
    $insertValues = $this->convertColumnsPdo(array_keys($data), ':');

    $sql = "INSERT INTO $table ($insertColumns) VALUES ($insertValues)";
    $stmt = $this->connect()->prepare($sql);
    $res = $stmt->execute($data);

    return $res;
  }

  public function delete(String $id, String $table): Bool
  {
    $sql = "DELETE FROM $table WHERE id = ?";
    $query = $this->connect()->prepare($sql);
    $res = $query->execute(array($id));

    return $res;
  }

  public function get(String $table): PDOStatement
  {
    $query = $this->connect()->query("SELECT * FROM $table");
    return $query;
  }

  public function getById(String $table, String $id): PDOStatement
  {
    $query = $this->connect()->prepare("SELECT * FROM $table WHERE id=:id");
    $query->execute(['id' => $id]);

    return $query;
  }

  public function getJoin(
    String $query,
    String $table1,
    String $table2
  ): PDOStatement {
    $joinColumn = substr($table2, 0, -1);
    $query = $this->connect()->query("SELECT $query FROM $table1 t1 INNER JOIN $table2 t2 ON t1.$joinColumn = t2.id");
    return $query;
  }

  public function update(
    array $data,
    String $id,
    String $table
  ): Bool {
    $insertColumns = $this->convertColumnsPdo(array_keys($data), '=:', true);
    $data['id'] = $id;

    $sql = "UPDATE $table SET $insertColumns WHERE id=:id";
    $stmt = $this->connect()->prepare($sql);
    $res = $stmt->execute($data);

    return $res;
  }
}
