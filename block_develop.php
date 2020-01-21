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
require 'dl_tools/dl_sig_tools.php';
require 'dl_tools/dl_blockchain.php';

$date = new DateTime("2010-07-05T06:00:00Z");

$date->setTimeZone(new DateTimeZone("Europe/Belgrade"));

if (!DEBUG) {
    $client_api_key = $_POST['api_key'];
    $certificate_receiver=$_POST['certificate_receiver'];
    $certificate_sender=$_POST['certificate_sender'];
    $transaction_block=$_POST['transaction_block'];
    //$sha2_digest=$_POST['sha2_digest'];
    //$card_digital_signature=$_POST['card_digital_signature'];
} else {
    $client_api_key = "9b4761e0bfa9a2f8e536b26f6fc7e409a9a4942f23a3fd45c33ae52b8b6ce366";
    $certificate_receiver = "308202C73082024DA00302010202043B9ACA18300A06082A8648CE3D040303308193310B3009060355040613025253311B3019060355040A0C124469676974616C204C6F676963204C74642E31183016060355040B0C0F7777772E642D6C6F6769632E636F6D3127302506092A864886F70D010901161863657274696669636174657340642D6C6F6769632E636F6D3124302206035504030C1B4469676974616C204C6F6769632054657374204543432043412031301E170D3230303131373132323335355A170D3230303431383132323335355A305B310B300906035504061302525331173015060355040B0C0E456C656374726F6C757831323334311A301806035504030C11416C656B73616E646172204B72737469633117301506035504030C0E74656C3A303631313636363431303056301006072A8648CE3D020106052B8104000A03420004B06B082DBDE897C77678784307DBD61472F3DFC1241FF132136691C158521420020646FB3200D062BF79BA196DD0FEF905B51BCA8DF088B5D3F8F1445D23477CA381C83081C530090603551D1304023000301D0603551D0E0416041472123BBE6A2C16DF1928114763AC59CC36359CAB303F0603551D1F043830363034A032A030862E687474703A2F2F63612E642D6C6F6769632E636F6D2F63726C2F444C6F676963546573744563634341312E63726C301F0603551D23041830168014F55F2499349D8805EB3C712EE6A862B5A57A713D30270603551D110420301E811C616C656B73616E6461722E6B727374696340642D6C6F6769632E7273300E0603551D0F0101FF0404030206C0300A06082A8648CE3D040303036800306502307DF7CE4F7100C91CE82227A297C6DAC863A872EF680644E9C9BD1B7C705A142279EC6B75D3530F85FF2815018D235C820231008A9B604D44DE8878807CF392148CD76746D767B878EDAFF175A107BDFC088396733386B56459ED0FAA69A3ACFCEF36EF";
    $certificate_sender = "308202c130820246a00302010202043b9aca1d300a06082a8648ce3d040303308193310b3009060355040613025253311b3019060355040a0c124469676974616c204c6f676963204c74642e31183016060355040b0c0f7777772e642d6c6f6769632e636f6d3127302506092a864886f70d010901161863657274696669636174657340642d6c6f6769632e636f6d3124302206035504030c1b4469676974616c204c6f6769632054657374204543432043412031301e170d3230303131373134303434315a170d3230303431383134303434315a3054310b300906035504061302525331163014060355040b0c0d4469676974616c204c6f6769633111300f060355041413083131313131313131311a301806035504030c11416c656b73616e646172204b72737469633056301006072a8648ce3d020106052b8104000a03420004d42dc15636063bca765780e2ad3829923b8557a609049a9833ddf07e3638f18e99085fdd2a6ba653c1595bc3daebfa728944063f79747da6dfc8de9ade0abeeda381c83081c530090603551d1304023000301d0603551d0e04160414f99db8478e2e5c8933e7091aff724146c9693295303f0603551d1f043830363034a032a030862e687474703a2f2f63612e642d6c6f6769632e636f6d2f63726c2f444c6f676963546573744563634341312e63726c301f0603551d23041830168014f55f2499349d8805eb3c712ee6a862b5a57a713d30270603551d110420301e811c616c656b73616e6461722e6b727374696340642d6c6f6769632e7273300e0603551d0f0101ff0404030206c0300a06082a8648ce3d04030303690030660231009a29ccdee6825e3ed16b376b38c24803a8a9eea541b5e4f880885c09fa29a8b684bd5478882595cad71b07a7ac38adbc023100c1ecaa9d35d269c97db7613c15d14b8ee44a70f603f9f03b95a2ac92cebee28daf76667be3c71671627f539fd2d9c7fb";
    $transaction_block = "00000476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b204150de5a994932eaab1059bc9964aeceb7677b7892ba523ceada2c13f812999d8eab7e749684ecd15204a170d093fe50b6117c161d92bcdeff89c5d1b291b9283e803000000000000";
    $sha2_digest = "bacf0bf602b05f52367c3aba0fc9b2e6ab5784ea601172095dd3d88b58e07773";
    $card_digital_signature = "3046022100da4872d35c6027b7dcb79e792d19fa08de5d6206c98c3439b2391de16f333ef1022100b1b27421c280b2831267226dac769e98f5adc98f68a0e17334e629f1290da826";
}


$client_api_key = strtoupper($client_api_key);
checkApiKey($client_api_key);
checkHex($certificate_receiver);
checkHex($certificate_sender);
checkHex($transaction_block);


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

$sql = "SELECT api_key FROM `api_key`";
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


$transaction_block_obj = new TransactionBlockClass;
$transaction_block_obj->getDataFromTransactionBlock($transaction_block);

//checking digest
$calculated_digest_bin = hash('sha256', $transaction_block_obj->transaction_before_digest_bin, true);
if($transaction_block_obj->sha2_digest_bin != $calculated_digest_bin)
{
    die("SC70;Wrong Digest.");
}

//checking signature
$result = checkTransactionBlock($transaction_block_obj);
if($result == false)
{
    die("SC70;". $status_msg);
}



$sql = "INSERT INTO `$table_name` (transaction_block, date_time, transaction_version, receiver_public_key, 
    sender_public_key, transaction_amount, cash_back_amount,
    transaction_fee, aki, data_digest, authority_digital_signature) 
    VALUES (X'$transaction_block', '$date_time', '$transaction_version', X'$receiver_public_key',
    X'$sender_public_key', '$transaction_amount',
    '$cash_back_amount', '$transaction_fee',
    '$aki', X'$data_digest', X'$authority_digital_signature');";
$result = $conn->query($sql);
if ($result == false) {
    echo("SC50;Connection failed: " . $conn->error);
    $conn->close();
    exit;
}

echo "SC80;Data succesfully added to blockchain."
?>