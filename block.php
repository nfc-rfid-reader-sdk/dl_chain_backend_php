<?php

/**
 * DL Blockchain
 *
 * PHP version 7
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   BlockChain
 * @package    PackageName
 * @author     Digital Logic <razvoj@d-logic.rs>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://local
 * @since      File available
 * @deprecated File deprecated
 */

define('DEBUG', false);

require 'dl_tools/dl_sql_tools.php';
require 'dl_tools/dl_re_tools.php';
$date = new DateTime("2010-07-05T06:00:00Z");

$date->setTimeZone(new DateTimeZone("Europe/Belgrade"));

if (!DEBUG) {
    /*
    $client_api_key = $_POST['api_key'];
    $game_name = $_POST['game_name'];
    $player_name = $_POST['player_name'];
    $score = $_POST['score'];
    */

    $client_api_key = $_POST['api_key'];
    $certificate_receiver=$_POST['certificate_receiver'];
    $certificate_sender=$_POST['certificate_sender'];
    $transaction_block=$_POST['transaction_block'];
    $sha2_digest=$_POST['sha2_digest'];
    $card_digital_signature=$_POST['card_digital_signature'];
    

} else {
    $client_api_key = "9b4761e0bfa9a2f8e536b26f6fc7e409a9a4942f23a3fd45c33ae52b8b6ce366";
    $certificate_receiver=$data['certificate_receiver'];
    $certificate_sender=$data['certificate_sender'];
    $transaction_block = "00000476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b204150de5a994932eaab1059bc9964aeceb7677b7892ba523ceada2c13f812999d8eab7e749684ecd15204a170d093fe50b6117c161d92bcdeff89c5d1b291b9283e803000000000000";
    $sha2_digest = "e7e6782229748b823671eb9e3cc30ea3c52bc19f0c79915961d76180f6465a20";
    $card_digital_signature = "3045022032afed8eeac7cebe2e5c81feaeb4d4027869d0062226e3f92598f0ec3d76ee2f0221008aa27feaeadd83dc8fdba16d53ab9ce0f80da7f0780a7af2b52443b559b2bd38";
    
    //information for verify when extracted
    $transaction_version_ver = "0000";
    $receiver_public_key_ver = "0476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b2";
    $sender_public_key_ver = "04150de5a994932eaab1059bc9964aeceb7677b7892ba523ceada2c13f812999d8eab7e749684ecd15204a170d093fe50b6117c161d92bcdeff89c5d1b291b9283";
}

    $client_api_key = strtoupper($client_api_key);
    $certificate_receiver=strtoupper($certificate_receiver);
    $certificate_sender=strtoupper($certificate_sender);
    $transaction_block=strtoupper($transaction_block);
    $sha2_digest=strtoupper($sha2_digest);
    $card_digital_signature=strtoupper($card_digital_signature);
    
checkApiKey($client_api_key);

$config = parse_ini_file('db_config.ini'); 
// Create connection
$conn = new mysqli(
    $config['servername'], $config['username'],
    $config['password'], $config['dbname']
);
// Check connection
if ($conn->connect_error) {
    die("SC50;Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `api_key`";
$result = $conn->query($sql);
if ($result == false) {
    echo("SC50;Connection failed: " . $conn->error);
    $conn->close();
    exit;
}
$row = $result->fetch_row();
if ($row == null) {
    $conn->close();
    die("Error: Username not found");
}
$api_key = strtoupper(bin2hex($row[0]));
if ($client_api_key != $api_key) {
    die("Error: Wrong API Key");
}

echo "SC80;Data succesfully added to blockchain."
?>