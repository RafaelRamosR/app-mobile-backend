<?php

require_once './repositories/index.php';

class User extends RepositoryFactory
{
  private $repository;
  private $collection;

  public function __construct() {
    $this->repository = $this->make('Mysql');
    $this->collection = 'users';
  }

  public function getUsers()
  {
    $query = $this->repository->get($this->collection);
    return $query;
  }

  public function getOneUser(String $id)
  {
    $query = $this->repository->getById($this->collection, $id);
    return $query;
  }

  public function getUsersWithDetails()
  {
    $query = $this->repository->getJoin(
      't1.id, t1.name, t1.lastname, t1.phone, t2.name as document',
      $this->collection,
      'documents'
    );
    return $query;
  }

  public function editUser(Array $data, String $id)
  {
    $query = $this->repository->update($data, $id, $this->collection);
    return $query;
  }

  public function deleteUser($id)
  {
    $query = $this->repository->delete($id, $this->collection);
    return $query;
  }

  public function setUsers(Array $data)
  {
    $query = $this->repository->create($data, $this->collection);
    return $query;
  }
}
