<?php

require_once '../../lib/dompdf/autoload.inc.php';
// Reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


$y = $_GET['pdf'];
$x = '<style type="text/css">
        table {
        border-collapse: collapse;
        border: 1px solid #000000;
        width: 100%;
        margin:auto
        }
        table td, table th {
          
          font-size: 12px;
          padding: 5px 10px;
          font-weight: 200;
        }
        thead{
          background: #6699ff;
          border-bottom: 2px solid #DDDDDD;
          
        }
        
        table thead th {
          font-size: 14 px;
          font-weight: bold;
        }
        
        img{
            padding-left: 520px
        }
    </style>
    
    <html>
        <body>
            <div>
                <img src="../../img/logo2.png" height="75" style=""/>
                <h2 style="margin-bottom:0">Listado de Asistentes</h2>
                <table style="padding-top:10px">'.$y.'</table>
            </div>
        </body>
    </html>';




$filename = "asistentes.pdf";

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