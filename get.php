<?php
function getIgData ($token) {
  //Get data from instagram api
  // $hashtag = 'max';
  //Query need client_id or access_token
  $query = array(
  	'access_token' => $token,
  	'count'		=> 1
  );
  // $url = 'https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?'.http_build_query($query);

  $url = "https://api.instagram.com/v1/users/self/media/recent/?" . http_build_query($query);
  try {
    $curl_connection = curl_init();
    // set URL and other appropriate options
    curl_setopt($curl_connection, CURLOPT_URL, $url);
  	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
  	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
  	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);

  	//Data are stored in $data
  	$data = json_decode(curl_exec($curl_connection), true);
  	curl_close($curl_connection);
    return $data;

  } catch(Exception $e) {
    return $e->getMessage();
  }
}

?>
