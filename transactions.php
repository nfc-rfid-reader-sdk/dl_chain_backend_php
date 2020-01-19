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
    $client_api_key = $_POST['api_key'];
    $certificate=$_POST['certificate'];
    $public_key=$_POST['public_key'];
    $date_from=$_POST['date_from'];
    $date_to=$_POST['date_to'];
    $order=$_POST['order'];
    $limit=$_POST['limit'];
} else {
    $client_api_key = "9b4761e0bfa9a2f8e536b26f6fc7e409a9a4942f23a3fd45c33ae52b8b6ce366";
    $certificate = "308202C73082024DA00302010202043B9ACA18300A06082A8648CE3D040303308193310B3009060355040613025253311B3019060355040A0C124469676974616C204C6F676963204C74642E31183016060355040B0C0F7777772E642D6C6F6769632E636F6D3127302506092A864886F70D010901161863657274696669636174657340642D6C6F6769632E636F6D3124302206035504030C1B4469676974616C204C6F6769632054657374204543432043412031301E170D3230303131373132323335355A170D3230303431383132323335355A305B310B300906035504061302525331173015060355040B0C0E456C656374726F6C757831323334311A301806035504030C11416C656B73616E646172204B72737469633117301506035504030C0E74656C3A303631313636363431303056301006072A8648CE3D020106052B8104000A03420004B06B082DBDE897C77678784307DBD61472F3DFC1241FF132136691C158521420020646FB3200D062BF79BA196DD0FEF905B51BCA8DF088B5D3F8F1445D23477CA381C83081C530090603551D1304023000301D0603551D0E0416041472123BBE6A2C16DF1928114763AC59CC36359CAB303F0603551D1F043830363034A032A030862E687474703A2F2F63612E642D6C6F6769632E636F6D2F63726C2F444C6F676963546573744563634341312E63726C301F0603551D23041830168014F55F2499349D8805EB3C712EE6A862B5A57A713D30270603551D110420301E811C616C656B73616E6461722E6B727374696340642D6C6F6769632E7273300E0603551D0F0101FF0404030206C0300A06082A8648CE3D040303036800306502307DF7CE4F7100C91CE82227A297C6DAC863A872EF680644E9C9BD1B7C705A142279EC6B75D3530F85FF2815018D235C820231008A9B604D44DE8878807CF392148CD76746D767B878EDAFF175A107BDFC088396733386B56459ED0FAA69A3ACFCEF36EF";
    $public_key = "0476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b2";
    $date_from = "2020-01-18 00:00:00";
    $date_to = "2020-01-18 23:59:59";
    $order = "ascending";
    $limit = 10;
}

$client_api_key = strtoupper($client_api_key);
checkApiKey($client_api_key);
checkHex($certificate);
checkHex($public_key);
checkDateString($date_from);
checkDateString($date_to);

if($order != "ascending" && $order != "descending")
{
    die("100;Order Parameters are Wrong.");
}
checkNumber($limit);

$certificate_bin = hex2bin($certificate);
$public_key_bin = hex2bin($public_key);

$table_name = "blockchain";



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
    die("SC50;Connection failed: API Key not found!");
}
$api_key = strtoupper(bin2hex($row[0]));
if ($client_api_key != $api_key) {
    die("SC50;Wrong API Key");
}

echo "0;100,5|2020-01-18 00:00:00||23,8|2020-01-18 10:23:50||23,8|2020-01-18 13:41:22"
?>