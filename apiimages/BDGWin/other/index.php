<?php
function random_strings($length_of_string) {
    return substr(md5(time()), 0, $length_of_string);
}

header('Content-Type: application/xml; charset=utf-8');

$dom = new DOMDocument();
$dom->version = '1.0';
$dom->encoding = 'UTF-8';

$root = $dom->createElement('Error');
$dom->appendChild($root);

$code = $dom->createElement('Code', 'NoSuchKey');
$root->appendChild($code);

$message = $dom->createElement('Message', 'The specified key does not exist.');
$root->appendChild($message);

$requestId = strtoupper(random_strings(24));
if (!empty($requestId)) {
  $element = $dom->createElement('RequestId', $requestId);
  $root->appendChild($element);
}

$hostId = $dom->createElement('HostId', 'apiimages.91clubold.investment93.site.in');
$root->appendChild($hostId);

$key = $dom->createElement('Key', 'BDGWin/other');
$root->appendChild($key);

$ec = $dom->createElement('EC', '0026-00000001');
$root->appendChild($ec);

$recommendDoc = $dom->createElement('RecommendDoc', 'https://api.alibabacloud.com/troubleshoot?q=0026-00000001');
$root->appendChild($recommendDoc);

$dom->formatOutput = true;
echo $dom->saveXML();

?>