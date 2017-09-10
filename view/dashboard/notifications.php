
<?PHP
  //send notif avec tag (chaque user a des tags = au SaloonID dans lesquels il se trouve)
  function sendMessageTag($saloonID, $message){
    $content = array(
      "en" => "$message"
    );

    $fields = array(
      'app_id' => "37aeaf38-a492-4dd8-b071-96599ef3883f",
      'filters' => array(array("field" => "tag", "key" => "$saloonID", "relation" => "exists")),  //check si la key qui est = à keyN (représenté par $saloonID) existe pour l'user ou pas.
      'data' => array("foo" => "bar"),
      'contents' => $content
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
    'Authorization: Basic CODE A CHANGER PR EN LIGNE'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }

  //sendMessageTag('key1', 'bonjour monsieur le jeune hoomme');
  /*$response = sendMessageTag('key1', 'heloooooooo');
  $return["allresponses"] = $response;
  $return = json_encode( $return);

  print("\n\nJSON received:\n");
  print($return);
  print("\n");*/



  //send notif a tt le monde
  function sendMessage($message){
    $content = array(
      "en" => "$message"
    );

    $fields = array(
      'app_id' => "37aeaf38-a492-4dd8-b071-96599ef3883f",
      'included_segments' => array('All'),
      'data' => array("foo" => "bar"),
      'contents' => $content
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
    'Authorization: Basic CODE A CHANGER PR EN LIGNE'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }
  /*$response = sendMessage('hello');
  $return["allresponses"] = $response;
  $return = json_encode( $return);

  print("\n\nJSON received:\n");
  print($return);
  print("\n");*/
?>
