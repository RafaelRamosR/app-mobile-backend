<?php

require_once './repositories/index.php';

class Document extends RepositoryFactory {
  private $repository;

  public function __construct() {
    $this->repository = $this->make('Mysql');
  }

  public function getDocuments()
  {
    $query = $this->repository->get('documents');

    return $query;
  }
}
