<?php

require_once './models/User.php';

class UserController
{
  public function users()
  {
    $user = new User();
    $userData = array();
    $userData['data'] = array();

    $res = $user->getUsers();

    if ($res->rowCount()) {
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
          'id'    => $row['id'],
          'name'  => $row['name'] . " " . $row['lastname'],
          'phone' => $row['phone'],
        );

        array_push($userData['data'], $data);
      }

      echo json_encode($userData);
    } else {
      echo json_encode(array('msg' => 'Not data'));
    }
  }

  public function user()
  {
    $user = new User();
    $userData = array();
    $userData['data'] = array();

    $id = $_GET['id'];
    $res = $user->getOneUser($id);

    if ($res->rowCount()) {
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
          'id'       => $row['id'],
          'name'     => $row['name'],
          'lastName' => $row['lastname'],
          'phone'    => $row['phone'],
          'document' => $row['document'],
        );

        array_push($userData['data'], $data);
      }

      echo json_encode($userData);
    } else {
      echo json_encode(array('msg' => 'Not data'));
    }
  }

  public function user_list()
  {
    $user = new User();
    $userData = array();
    $userData['data'] = array();

    $res = $user->getUsersWithDetails();

    if ($res->rowCount()) {
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
          'id'       => $row['id'],
          'name'     => $row['name'] . " " . $row['lastname'],
          'phone'    => $row['phone'],
          'document' => $row['document'],
        );

        array_push($userData['data'], $data);
      }

      echo json_encode($userData);
    } else {
      echo json_encode(array('msg' => 'Not data'));
    }
  }

  public function edit_user()
  {
    $user = new User();
    $data = array();
    $id = $_GET['id'];

    $data['id']       = $id;
    $data['document'] = $_POST['document'];
    $data['name']     = $_POST['name'];
    $data['lastName'] = $_POST['lastName'];
    $data['phone']    = $_POST['phone'];

    $res = $user->editUser($data);

    if ($res) {
      echo json_encode(array('msg' => 'Datos editados con éxito.'));
    } else {
      echo json_encode(array('msg' => 'Hubo un error al guardar'));
    }
  }

  public function delete_user()
  {
    $user = new User();
    $id = $_GET['id'];
    $res = $user->deleteUser($id);

    if ($res) {
      echo json_encode(array('msg' => 'Datos eliminados con éxito.'));
    } else {
      echo json_encode(array('msg' => 'Hubo un error al guardar'));
    }
  }

  public function save_user()
  {
    $user = new User();

    $data = array();
    $data['document'] = $_POST['document'];
    $data['name']     = $_POST['name'];
    $data['lastname'] = $_POST['lastName'];
    $data['phone']    = $_POST['phone'];

    $res = $user->setUsers($data);

    if ($res) {
      echo json_encode(array('msg' => 'Datos guardados con éxito.'));
    } else {
      echo json_encode(array('msg' => 'Hubo un error al guardar'));
    }
  }
}
