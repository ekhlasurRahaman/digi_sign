<?php
//require_once('signature/tcpdf_include.php');
require_once("../includes/session.php"); 
require_once('signature/tcpdf.php');
//require_once('pdf2text.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('eDigiSign');
$pdf->SetTitle('eDigiSign Demo');
$pdf->SetSubject('eDigiSign Demo');
$pdf->SetKeywords('eDigiSign, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'signature/lang/eng.php')) {
	require_once(dirname(__FILE__).'signature/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

/*
NOTES:
 - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
 - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
 - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
*/

// set certificate file

$certificate ='file://c:/wamp/www/digi_sign/signature_pad/signature/certificate/tcpdf.crt';
//$certificate = 'file://data/cert/tcpdf.crt';
  $public = $_SESSION["public"];
  $name = $public["first_name"];
  $client = $_SESSION["client"];
  $public_key= $client["public_key"];
// set additional information
$info = array(
	'Name' => $name,
	'Location' => 'Mirpur-1',
	'Reason' => $name,
	'ContactInfo' => $public_key,
	);

// set document signature
$pdf->setSignature($certificate, $certificate, 'eDigiSign', '', 2, $info);

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// print a line of text
//$text = strings();
$content = $_SESSION["content"];
//$text = $name;
$pdf->writeHTML($content, true, 0, true, 0);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// *** set signature appearance ***

// create content for signature (image and/or text)
$pdf->Image('public_signature.png', 160, 262, 35, 10, 'PNG');

// define active area for signature appearance
$pdf->setSignatureAppearance(160, 262, 35, 10);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// *** set an empty signature appearance ***
//$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

// ---------------------------------------------------------
$file_name = $_SESSION["upload_file"];
//Close and output PDF document
$pdf->Output($file_name , 'D');
//============================================================+
// END OF FILE
//============================================================+

?>
