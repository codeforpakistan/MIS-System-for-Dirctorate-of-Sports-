<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require("dompdf/autoload.inc.php");

// instantiate and use the dompdf class
$dompdf = new Dompdf\Dompdf();
// Load HTML content
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

//print_r($dompdf->render()); die();

// Output the generated PDF to Browser
$dompdf->stream();


}
?>