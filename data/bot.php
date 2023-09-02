<?php
include('navbar.php');
include('creds.php');

$dataArray = json_encode($streamArray);
$dataArray = json_decode($streamArray,true);
$dataCount = count($dataArray['data']);
$pagination = $dataArray['pagination']['cursor'];
echo "<pre>";

echo "DataCount: ".$dataCount.PHP_EOL;

for($i = 0;$i <= $dataCount-1; $i++){
    echo $dataArray['data'][$i]['user_name'].PHP_EOL;
}
echo "<hr>";
echo "Pagination: ".$pagination;
echo "<hr>";
echo "</pre>";


?>
<!DOCTYPE html>
<html>
<head>
    <script>
        // WebSocket-Verbindung herstellen
        var socket = new WebSocket('ws://rubizockt.de:8123');

        // WebSocket-Ereignis: Verbindung hergestellt
        socket.onopen = function(event) {
            console.log('WebSocket-Verbindung hergestellt');
        };

        // WebSocket-Ereignis: Nachricht empfangen
        socket.onmessage = function(event) {
            var message = event.data;
            console.log('Nachricht empfangen:', message);

            // Nachricht im DOM abbilden (z.B. in einem <div>-Element)
            var messageDiv = document.getElementById('messageDiv');
            messageDiv.innerHTML += '<p>' + message + '</p>';
        };

        // WebSocket-Ereignis: Verbindung geschlossen
        socket.onclose = function(event) {
            console.log('WebSocket-Verbindung geschlossen');
        };
    </script>
</head>
<body>
<div id="headline"><h1>Wenn gestreamt wird, könnt ihr hier den Chat lesen:</h1></div>
<div id="messageDiv"></div>
</body>
</html>