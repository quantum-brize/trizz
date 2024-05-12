<?php  
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @Quotation com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');



class MYPDF extends TCPDF {

//Page header
public function Header() {
// Logo
 
// Set font
$this->SetFont('helvetica', 'B', 20);
// Title
$this->Cell(0, 2, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
}

// Page footer
public function Footer() {
// Position at 15 mm from bottom
$this->SetY(-8);
// Set font
$this->SetFont('helvetica', 'N', 8);
// Page number

$this->Cell(-2, 5, 'B - 15, 1st Floor Shankar Garden Vikas Puri, Near Janakpuri West Metro Station,New Delhi, Pin Code: 110018', 0, false, 'C', 0, '', 0, false, 'T', 'M');
$image_file = 'logo_example.jpg';
$this->Image($image_file, 100, 282, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
}
}



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Voucher');
$pdf->SetTitle('Voucher');
$pdf->SetSubject('Voucher');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins('5', '0', '5');
 

// remove default footer
$pdf->setPrintHeader(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 48);

// add a page
// set font
$pdf->SetFont('dejavusans', '', 8);
 




 $pdf->AddPage();


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$border = array(
            'LRTB' => array('width' => 1,   'dash' => 0, 'color' => array(0, 0, 0,0))
        );
 
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();
 
$t = file_get_contents($_GET['pageurl']);
$html = $t;

// output the HTML content
$pdf->writeHTML($html, false, false, false, false, '');

 

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
//$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
if($_REQUEST['download']!=1 && $_REQUEST['savetoserver']!=1){
$pdf->Output('Quotation.pdf', 'I');
} 

if($_REQUEST['download']==1){
header("Content-Type: application/octet-stream");
$pdf->Output('Quotation.pdf','D');
}

if($_REQUEST['downloadonserver']==1){
$pdf->Output('Quotation.pdf', 'F');
}

 


if($_REQUEST['savetoserver']==1){
ob_clean();
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'tcpdf/examples/Quotation/'.$_REQUEST['Quotationnumber'].'-Quotation.pdf', 'F'); 
}



//============================================================+
// END OF FILE
//============================================================+
