<?php

require_once('db.php');
require_once('../model/task.php');
require_once('../model/response.php');

// attempt to set up connections to read and write db connections
try {
  $writeDB = DB::connectWriteDB();
  $readDB = DB::connectReadDB();
}
catch(PDOException $ex) {
  // log connection error for troubleshooting and return a json error response
  error_log("Connection Error: ".$ex, 0);
  $response = new Response();
  $response->setHttpStatusCode(500);
  $response->setSuccess(false);
  $response->addMessage("Database connection error");
  $response->send();
  exit;
}

// within this if/elseif statement, it is important to get the correct order (if query string GET param is used in multiple routes)
// check if taskid is in the url e.g. /tasks/1

// check if taskid is in the url e.g. /tasks/1

// get tasks that have submitted a SonMakine filter

// handle getting all tasks page of 20 at a time

// handle getting all tasks or creating a new one

  // if request is a GET e.g. get tasks
  if($_SERVER['REQUEST_METHOD'] === 'GET') {

    // attempt to query the database
    try {
      // create db query

      //$sql= 'SELECT id,UrunKodu,HedefSayi,HedefSure,UretimMiktari,Ortalama,Sure,HedefIslem,IslemSuresi,MakinaNo,Personel,SonMakine from tbltasks';
      $sql = "SELECT UrunKodu, AVG(IslemSuresi) AS MAKINAORT FROM tbltasks GROUP BY UrunKodu";


      $query = $readDB->prepare($sql);
      $query->execute();

      // get row count

      // create task array to store returned tasks
      $taskArray = array();

      // for each row returned
      while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        // create new task object for each row
        $task = new Task($row['UrunKodu'],$row['MAKINAORT']);

        // create task and store in array for return in json data
        $taskArray[] = $task->returnTaskAsArray();
      }

      // bundle tasks and rows returned into an array to return in the json data
      $returnData = array();
      $returnData = $taskArray;

      // set up response for successful return
      $response = new Response();
      $response->setData($returnData);
      $response->send();
      exit;
    }
    // if error with sql query return a json error
    catch(TaskException $ex) {
      $response = new Response();
      $response->setHttpStatusCode(500);
      $response->setSuccess(false);
      $response->addMessage($ex->getMessage());
      $response->send();
      exit;
    }
    
   
  }



