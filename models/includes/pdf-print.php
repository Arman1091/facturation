<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

require 'assets/includes/vendor/autoload.php';
$html2pdf = new Html2Pdf();

ob_start();
?>

<page>



    <div class="container" id="chequeDiv" style="position: relative;height: 40%;width: 100% ;left:0;">

         <img id="image" src="assets/img/cheque.webp" alt="sdd" style="width: 100%;position: absolute;
    top: 55%;"> 
        <h4 id="montantLettres" style="width: 100%;position: absolute;left:74%; top: 61%;">
            <?= 15 ?>
        </h4>
        <h2 id="montant" style="width: 100%;position: absolute; top: 67%;">
            <?= 16 ?>
        </h2>
        <h4 id="lieu" style="width: 100%;position: absolute; top: 71%;">
            Saint-Palais-sur-Mer
        </h4>
        <h4 id="dateCheque" style="width: 100%;position: absolute; top: 74%;">
            <?= 17 ?>
        </h4>

    </div>


</page>




<?php

$content = ob_get_clean();

try {

    $html2pdf->writeHTML($content);
    // $html2pdf->output('t.pdf');
     $html2pdf->pdf->IncludeJS('print()');
    $html2pdf->output('cheque.pdf');
} catch (Html2PdfException $e) {
    echo $e->getMessage();
}
