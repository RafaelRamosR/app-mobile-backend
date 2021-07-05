<?php

interface Repository
{
  public function create(array $data, String $table): Bool;

  public function delete(String $id, String $table): Bool;

  public function get(String $table): PDOStatement;

  public function getById(String $table, String $id): PDOStatement;

  public function getJoin(String $query, String $table1, String $table2): PDOStatement;

  public function update(Array $data, String $id, String $table): Bool;
}
