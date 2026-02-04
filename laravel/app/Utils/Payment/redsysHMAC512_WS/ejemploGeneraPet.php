<?php

// Se incluye la librería
include 'signatureUtils/signature.php';

//Datos de configuración
$version = "HMAC_SHA512_V2";
$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES

// Valores de entrada que no hemos cmbiado para ningun ejemplo
$fuc = "999008881";
$terminal = "999";
$moneda = "978";
$transactionType = "0";
$url = ""; // URL para recibir notificaciones del pago
$order = time();
$amount = "145";

$currentUrl = Utils::getCurrentUrl();
$pos = strpos($currentUrl, basename(__FILE__));
$urlOKKO = substr($currentUrl, 0, $pos) . "ejemploRecepcionaPet.php";

// Se Rellenan los campos
$data = array(
	"DS_MERCHANT_AMOUNT" => $amount,
	"DS_MERCHANT_ORDER" => $order,
	"DS_MERCHANT_MERCHANTCODE" => $fuc,
	"DS_MERCHANT_CURRENCY" => $moneda,
	"DS_MERCHANT_TRANSACTIONTYPE" => $transactionType,
	"DS_MERCHANT_TERMINAL" => $terminal,
	"DS_MERCHANT_MERCHANTURL" => $url,
	"DS_MERCHANT_URLOK" => $urlOKKO,
	"DS_MERCHANT_URLKO" => $urlOKKO,
	"DS_MERCHANT_DIRECTPAYMENT" => true
);

// Se generan los parámetros de la petición
$params = Utils::arrayToXmlString($data, "DATOSENTRADA");
$signature = Signature::createMerchantSignature($kc, $params, $order);
$nuevaEntrada = "<REQUEST>" . $params . "<DS_SIGNATUREVERSION>HMAC_SHA512_V2</DS_SIGNATUREVERSION><DS_SIGNATURE>" . $signature . "</DS_SIGNATURE></REQUEST>";
echo "<pre>" . htmlspecialchars($nuevaEntrada) . "</pre>";



$soap_request  = "<?xml version=\"1.0\"?>\n";
$soap_request .= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservice.sis.sermepa.es">';
$soap_request .= '<soapenv:Header/>';
$soap_request .= '<soapenv:Body>';
$soap_request .= '<web:trataPeticion>';
$soap_request .= '<web:datoEntrada><![CDATA[' . $nuevaEntrada . ']]></web:datoEntrada>';
$soap_request .= '</web:trataPeticion>';
$soap_request .= '</soapenv:Body>';
$soap_request .= '</soapenv:Envelope>';

$header = array(
	"Content-type: text/xml;charset=\"utf-8\"",
	"Accept: text/xml",
	"Cache-Control: no-cache",
	"Pragma: no-cache",
	"SOAPAction: \"run\"",
	"Content-length: ". strlen($soap_request),
);

$soap_do = curl_init();
curl_setopt($soap_do, CURLOPT_URL, "https://sis-i.redsys.es:25443/sis/services/SerClsWSEntrada" );
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($soap_do, CURLOPT_POST,           true );
curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);

$data = curl_exec($soap_do);

var_dump($data);
die;

if($data === false) {
	$err = 'Curl error: ' . curl_error($soap_do);
	curl_close($soap_do);
	print $err;
} else {
	$tag = array ();
	preg_match ( "/<p[0-9]+:trataPeticionReturn>/", $data, $tag );
	$result = htmlspecialchars_decode ( Utils::getTagContent ( str_replace ( "<", "", str_replace ( ">", "", $tag [0] ) ), $data ) );

	print "<xmp>".$result."</xmp>";
	curl_close($soap_do);

	$signatureValues = Utils::getTagContent($result,"Ds_Amount");
	$signatureValues .= $order;
	$signatureValues .= Utils::getTagContent($result,"Ds_MerchantCode");
	$signatureValues .= Utils::getTagContent($result,"Ds_Currency");
	$signatureValues .= Utils::getTagContent($result,"Ds_Response");
	$signatureValues .= Utils::getTagContent($result,"Ds_TransactionType");
	$signatureValues .= Utils::getTagContent($result,"Ds_SecurePayment");

	echo $signatureValues."<br/>";
	echo Signature::createMerchantSignature($kc, $signatureValues, $order);
}
