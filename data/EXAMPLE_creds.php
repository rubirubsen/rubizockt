<?php
//SQL-Daten
$servername = "SQL_URL";
$username = "SQL_USER";
$password = "SQL_PASSWORD";
$dbname = "DATABASE";

//Twitch-Daten
$tw_client_id = 'CLIENT_ID';
$tw_client_secret= 'CLIENT_SECRET';

$tw_bearer = getTwitchBearer($tw_client_id,$tw_client_secret);
$streamArray = getDayZstreams($tw_bearer, $tw_client_id);


/**
 * @param $clientID string Twitch Client-ID
 * @param $clientSecret string Twitch Client-Secret
 * @return string Twitch Bearer-Token
 */
function getTwitchBearer($clientID, $clientSecret){
        $url = "https://id.twitch.tv/oauth2/token";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = 'client_id='.$clientID.'&client_secret='.$clientSecret.'&grant_type=client_credentials';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $respDecode = json_decode($resp,true);

        return $respDecode['access_token'];
    }


/**
 * @param $tw_bearer string Twitch Bearer-Token
 * @param $tw_client_id string Twitch Cliend ID
 * @return bool|string Response from Twitch
 */
function getDayZstreams($tw_bearer, $tw_client_id){
        $url = "https://api.twitch.tv/helix/streams?language=de&type=live&game_id=65632&first=100";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Bearer ".$tw_bearer,
            "Client-Id: ".$tw_client_id,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }
?>
