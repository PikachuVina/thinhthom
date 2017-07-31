<?php
require_once('config.php');
require_once('myfunc.php');

if ($_GET['type'] === 'delete') {
  $json = '
  {
    "fields":[
      "get_started"
    ]
  }';
  requestDelete($json);
} elseif ($_GET['type'] === 'insert') {

  $json = '
  {
    "get_started":{
      "payload":"menu"
    }
  }';
  requestInsert($json);
}

?>