<?php

require_once './repositories/mysql/Mysql.php';

class RepositoryFactory
{
  public function make($repository)
  {
    return new $repository();
  }
}
