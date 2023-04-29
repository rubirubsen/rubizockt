<?php
ob_start();

function loadEnv() {
  $path = __DIR__ . '/.env';
  if (!is_file($path)) {
    throw new InvalidArgumentException(sprintf('%s does not exist', $path));
  }
  
  $file = fopen($path, 'r');
  while (!feof($file)) {
    $line = fgets($file);
    if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
      list($name, $value) = explode('=', trim($line), 2);
      putenv(sprintf('%s=%s', $name, $value));
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
    }
  }
  fclose($file);
}

// Laden Sie die Umgebungsvariablen
loadEnv();

// Verwenden Sie die Umgebungsvariablen
$clientID = '6d7e02e2a1034ff19e9b4f317aa7b03e';
$redirect_uri = "https://rubizockt.de/callback.php"; 
$scope = "user-read-private user-read-email"; 

function getSpotifyAuth(){
    $authorize_url = "https://accounts.spotify.com/authorize?" . http_build_query(
        [ 
        "client_id" => $client_id, 
        "redirect_uri" => $redirect_uri, 
        "response_type" => "code", 
        "scope" => $scope, 
        ]
    ); 
    echo "<pre>";
    var_dump($authorize_url);
    echo "</pre>";
    
    header('Location: ' . $authorizeUrl);
    exit;
}
?>

