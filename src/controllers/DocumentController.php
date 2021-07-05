<?php

require_once './models/Document.php';

class DocumentController
{
  public function documents()
  {
    $document = new Document();
    $documentData = array();
    $documentData['data'] = array();

    $res = $document->getDocuments();

    if ($res->rowCount()) {
      while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
          'id'   => $row['id'],
          'name' => $row['name'],
        );

        array_push($documentData['data'], $data);
      }

      echo json_encode($documentData);
    } else {
      echo json_encode(array('msg' => 'Not data'));
    }
  }
}
