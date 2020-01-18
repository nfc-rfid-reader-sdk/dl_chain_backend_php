<?php

/**
 * BlockIS Test
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

    $data = json_decode(file_get_contents('php://input'), true);
    $client_api_key = $data['api_key'];
    $game_name=$data['game_name'];
    $aid=$data['aid'];
} else {
    $client_api_key = "8EF52BE409F2C4445A869F890358E7BAB5621C49FFE4641B0A6DF3851930ADDC";
    $game_name = "ginst";
    $aid="01234567890ABCDEF";
}


    echo "<pre>";
    print_r (hash_algos());
    echo "</pre>";

    
/*
checkApiKey($client_api_key);

//overide do not need to check

$config = parse_ini_file('db_config.ini'); 
// Create connection
$conn = new mysqli(
    $config['servername'], $config['username'],
    $config['password'], $config['dbname']
);
// Check connection
if ($conn->connect_error) {
    die("Error: Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `api_key`";
$result = $conn->query($sql);
if ($result == false) {
    echo("Error: " . $conn->error);
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

$table_name=$game_name . "_users";

$sql = "SELECT * FROM `$table_name` WHERE AID = '$aid';";
$result = $conn->query($sql);
if ($result == false) {
    echo("Error: " . $conn->error);
    $conn->close();
    exit;
}
if ($result->num_rows < 1) {
    die("Error: No player AID founded!");
}

$array = mysqli_fetch_all($result);
echo json_encode($array, JSON_FORCE_OBJECT);
*/
?>