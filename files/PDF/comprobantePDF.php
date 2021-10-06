<?php

require_once '../../lib/dompdf/autoload.inc.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


$y = $_GET['pdf'];
$x = '<style type="text/css">
        table{
        width:70%;
        }
        
        img{
            padding-left: 475px
        }
        tr:nth-child(4n) {
            border-bottom: 1px solid #ddd;
          }

    </style>
    
    <html>
        <body>
            <div style="width:95%;margin: 30px auto 0">
            <h4> ¡Felicitaciones! Acá tenes tu comprobante</h4>
            <small>Recorda que podes presentarlo impreso o en formato digital el día del evento</small>
            </div>
            <br/>
            <div style="border-style: groove; width:95%;margin: 30px auto">
                <img src="../../img/logo2.png" height="75" style="margin-top:15px;margin-bottom:0; margin-right: 100px"/>
                
                <table style="padding:0 20px 25px">'.$y.'</table>
            </div>
        </body>
    </html>';




$filename = "comprobante.pdf";

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('debugKeepTemp', TRUE);
$options->set('isHtml5ParserEnabled', TRUE);
$options->set('chroot', '/');
$options->setIsRemoteEnabled(true);

// Instantiate and use the dompdf class
$dompdf = new Dompdf($options);

// Load HTML content
$dompdf->loadHtml($x);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper( 'A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename, array('Attachment'=>0));

?>