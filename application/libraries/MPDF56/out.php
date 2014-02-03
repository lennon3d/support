<?php
$html = $_POST['page'];
$html = str_replace("\\\"","\"",$html);
include("../mpdf.php");
$mpdf=new mPDF(); 
$mpdf->allow_charset_conversion=true;
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;



?>