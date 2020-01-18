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
    $certificate_receiver = "3082058c30820374a00302010202021002300d06092a864886f70d01010b05003081a6310b3009060355040613025253310f300d06035504080c06536572626961311a3018060355040a0c114469676974616c204c6f676963204c7464311a3018060355040b0c114469676974616c204c6f67696320526e443123302106035504030c1a4469676974616c204c6f67696320526e442054657374204341313129302706092a864886f70d010901161a7a6f72616e2e6a6f76616e6f76696340642d6c6f6769632e7273301e170d3138303232333133323430305a170d3139303330353133323430305a3081a2310b3009060355040613025253310f300d06035504080c065365726269613112301006035504070c09506f7a617265766163311a3018060355040a0c114469676974616c204c6f676963204c7464311a3018060355040b0c114469676974616c204c6f67696320526e443115301306035504030c0c5a6f72616e2052616a636963311f301d06092a864886f70d01090116107a6f72616e40642d6c6f6769632e727330820122300d06092a864886f70d01010105000382010f003082010a0282010100c7b62c2b3814412af9dd9ede70e8d742dbeff91ad098160213b8ae16fd1a3e763cb3f65b6490767e1beb9ef2ef42b907025d8277df014f375c9024a902114adbedb0fba01be77f27c57fe2b78f77175c003378eaea4aba33009326fab3758627dc82ae2f5a2f70c1d7df79e46fde028c6a54776e82f60e646a978379bb7b49bd29afecb3ad85d036b6aab457773abc078375866ea968f7980d623ade768d0786195957d248040872625241faa302c21c55c66a2b9f15f236b6a2da271fd9d0561c7fbeb3375bcce97f52526a1cf1cec8829f5a49ee21cfc1a77015bab766199c49ff6df8e0ccf9b8166c29480e7a202058c2618fac927a82ea1dce31ac6b86030203010001a381c53081c230090603551d1304023000301106096086480186f84201010404030205a0303306096086480186f842010d042616244f70656e53534c2047656e65726174656420436c69656e74204365727469666963617465301d0603551d0e04160414b32ce82dbc3af98908fbf3638a4b71f7d0820e13301f0603551d230418301680140faf265ff1f9b69d6a1f3e39b0f08672f6f7d6b1300e0603551d0f0101ff0404030205e0301d0603551d250416301406082b0601050507030206082b06010505070304300d06092a864886f70d01010b05000382020100806ff6b7238d1fdae8adeed6cca9e0d7e17358374f7acc773ad262f47d505aa0b4cbadda56aedc15112a2a018afb715c5139176d01ba16feceff35cf773575b39c2aee4c03893fbbca109b3c17a5962efd86ea4a582f424d60f953df2fbb12b13f6fcaf58cb4cbb05c2428aeadb709b5339d11984dc8c6b72f8ec4ffbee86ebebde3964706633c78598ebd45adcb13e4b1360c3849af149786bb687b3c0e2f4585ce2520150f6c876f1117a467c1bea903cd4744817c6c80d0ca487098b96e01723d8193d09a240bfca11af7d740cd7fd5f889b92e3d60235cc1e8ee9d42cc004ab1a6286fa6b6a417332577d11d73e4a43ece0e46b4a3f9d96b580685f02cd95985dc3071da981d3206d4512da0a9229620eba73aa0cb39526828da8729288258e12ddc75eb4a233c965ae98ff4f8bde29d364d1d1f8da75b776ea3fd90fb07ce2543180280fde5575dee297ec8e76326e120f83f0ea52e55b69bc8a93be50890b6df7990a2aa7828cda02915dedd9ea46daa6c9bfe390ad863873a076fe1cb9d746c81a8dc47be5060ff74f373427be4dbce3ef93c939787288e9dafc1ceaed2095aaf82674c8796fb61d1959d4284ea6d275cd206ded162299b4e9c5d389b81c8f3146578842a923cc46798b303082493077232aee5327f8ba8722163335d13da3f158a96f21de503c2b59b572403d8de98ea98c6f520aa3f76ba7ed34a18";
    $certificate_sender = "308202c130820246a00302010202043b9aca1d300a06082a8648ce3d040303308193310b3009060355040613025253311b3019060355040a0c124469676974616c204c6f676963204c74642e31183016060355040b0c0f7777772e642d6c6f6769632e636f6d3127302506092a864886f70d010901161863657274696669636174657340642d6c6f6769632e636f6d3124302206035504030c1b4469676974616c204c6f6769632054657374204543432043412031301e170d3230303131373134303434315a170d3230303431383134303434315a3054310b300906035504061302525331163014060355040b0c0d4469676974616c204c6f6769633111300f060355041413083131313131313131311a301806035504030c11416c656b73616e646172204b72737469633056301006072a8648ce3d020106052b8104000a03420004d42dc15636063bca765780e2ad3829923b8557a609049a9833ddf07e3638f18e99085fdd2a6ba653c1595bc3daebfa728944063f79747da6dfc8de9ade0abeeda381c83081c530090603551d1304023000301d0603551d0e04160414f99db8478e2e5c8933e7091aff724146c9693295303f0603551d1f043830363034a032a030862e687474703a2f2f63612e642d6c6f6769632e636f6d2f63726c2f444c6f676963546573744563634341312e63726c301f0603551d23041830168014f55f2499349d8805eb3c712ee6a862b5a57a713d30270603551d110420301e811c616c656b73616e6461722e6b727374696340642d6c6f6769632e7273300e0603551d0f0101ff0404030206c0300a06082a8648ce3d04030303690030660231009a29ccdee6825e3ed16b376b38c24803a8a9eea541b5e4f880885c09fa29a8b684bd5478882595cad71b07a7ac38adbc023100c1ecaa9d35d269c97db7613c15d14b8ee44a70f603f9f03b95a2ac92cebee28daf76667be3c71671627f539fd2d9c7fb";
    $transaction_block = "00000476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b204150de5a994932eaab1059bc9964aeceb7677b7892ba523ceada2c13f812999d8eab7e749684ecd15204a170d093fe50b6117c161d92bcdeff89c5d1b291b9283e803000000000000";
    $sha2_digest = "e7e6782229748b823671eb9e3cc30ea3c52bc19f0c79915961d76180f6465a20";
    $card_digital_signature = "3045022032afed8eeac7cebe2e5c81feaeb4d4027869d0062226e3f92598f0ec3d76ee2f0221008aa27feaeadd83dc8fdba16d53ab9ce0f80da7f0780a7af2b52443b559b2bd38";
}


//information for verify when extracted
$transaction_version = "0000";
$receiver_public_key = "0476ee5c36cc9e4b8db96b7161a7be4147eb568e0c1907e1d4e2e5bcd93c352f5f488b7c8f4851ad16d1c4832ee50657d2e971359a53d1c35e54b3c55d7906a9b2";
$sender_public_key = "04150de5a994932eaab1059bc9964aeceb7677b7892ba523ceada2c13f812999d8eab7e749684ecd15204a170d093fe50b6117c161d92bcdeff89c5d1b291b9283";
$transaction_amount = 100;
$cash_back_amount = 10;
$transaction_fee = 1;
$aki=1;
//dummy data digest for test
$data_digest = strtoupper("e7e6782229748b823671eb9e3cc30ea3c52bc19f0c79915961d76180f6465a20");
$authority_digital_signature = strtoupper("e7e6782229748b823671eb9e3cc30ea3c52bc19f0c79915961d76180f6465a20");


$client_api_key = strtoupper($client_api_key);
$certificate_receiver_bin = hex2bin($certificate_receiver);
$certificate_sender_bin = hex2bin($certificate_sender);
$transaction_block_bin = hex2bin($transaction_block);
$sha2_digest_bin=hex2bin($sha2_digest);
$card_digital_signature_bin=hex2bin($card_digital_signature);


$receiver_public_key_bin = hex2bin($receiver_public_key);
$sender_public_key_bin = hex2bin($sender_public_key);
$data_digest_bin = hex2bin($data_digest);
$authority_digital_signature_bin = hex2bin($authority_digital_signature);


$table_name = "blockchain";

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
    die("SC50;Connection failed: API Key not found!");
}
$api_key = strtoupper(bin2hex($row[0]));
if ($client_api_key != $api_key) {
    die("SC50;Wrong API Key");
}

$sql = "INSERT INTO `$table_name` (TRANSACTION_BLOCK, RECEIVER_PUBLIC_KEY, 
    SENDER_PUBLIC_KEY, TRANSACTION_AMOUNT, CASH_BACK_AMOUNT,
    TRANSACTION_FEE, AKI,
    DATA_DIGEST, AUTHORITY_DIGITAL_SIGNATURE) 
    VALUES ('$transaction_block_bin', '$receiver_public_key_bin',
    '$sender_public_key_bin', '$transaction_amount',
    '$cash_back_amount', '$transaction_fee',
    '$aki', '$data_digest_bin', '$authority_digital_signature_bin');";
$result = $conn->query($sql);
if ($result == false) {
    echo("SC50;Connection failed: " . $conn->error);
    $conn->close();
    exit;
}

echo "SC80;Data succesfully added to blockchain."
?>