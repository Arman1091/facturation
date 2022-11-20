<?php
// if (isset($_POST['societe'],$_POST['montantLettres'],$_POST['montant']) 
//     && !empty($_POST['societe']) && !empty($_POST['montantLettres']) && !empty($_POST['montant'])) {
//     try {
//         $societe = strip_tags(htmlspecialchars($_POST['societe']));
//         $montantLettres = strip_tags(htmlspecialchars($_POST['montantLettres']));
//         $montant = strip_tags(htmlspecialchars($_POST['montant']));

       
     
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//         die();
//     }
// }

// echo ' 
//             <div class="row cheque-row  mt-3  p-2" style="height:100%">
//                 <div class="col-sm-8"  style="height:40%">
//                     <div id="cheque_lines_div" class="mt-3">
//                         <ul class=" list-unstyled">
//                             <li>
//                                 <p class="montant-horizontal-line1"><small class="text-danger text-somme-lettres text-end">dfdf</small> </p>
//                             </li>
//                             <li class="mt-3">
//                                 <p class="montant-horizontal-line2" style="display: none;"><span id="somme-plier"> </p>
//                             </li>
//                             <li>
//                                 <p class="societe-horizontal-line">A <span id="societe-row"> *******************</span> </p>
//                             </li>

//                         </ul>
//                     </div>
//                     <div class="row">
//                         <div class="col-sm-6 ">
//                             <div>
//                                 <p class="banque-text"style="line-height: 0.5em;">ETOILS SECOURS</p>
//                                 <p class="banque-text"style="line-height: 0.5em;">18 RUE DE LA BANQUE</p>
//                                 <p class="banque-text"style="line-height: 0.5em;">87000 LIMOGES</p>

//                             </div>
//                         </div>
//                     </div>

//                 </div>
//                 <div class=" col-sm-4">

//                     <div>
//                         <ul class=" list-unstyled">
//                             <li>
//                                 <p class="ville-line">A <span id="ville-text"> SAINT-PALAIS-SUR-MER</span> </p>
//                             </li>
//                             <li>
//                                 <p class="date-line">Le <span id="date-text">'.date('d/m/y').'</span> </p>
//                             </li>
//                         </ul>
//                     </div>

//                 </div>

//             </div>
      

//             ';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; width:900px">
        <div class="row" style="width:500px;">
            <div class="col-8">
                <div>
                   <p id="montat_lettre">dfdfdfdf</p>
                </div>
                <div>
                <p id="societeNom"></p>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>et sec</p>
                        <p>18 reu sdsdsdsdd</p>
                        <p>87000 sd</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div>
                    <p id="somme_shifre" class="text-center"style="padding: 10px;">125</p>
                    <p>sainsoqjq mesdsd dsr </p>
                    <p><?= date('d/m/y') ?></p>
                </div>
            </div>
        </div>
  </div>
</body>
</html>
<!-- <div class="row cheque-row  mt-3  p-2" style="height:100%">
<div class="col-sm-8"  style="height:40%">
    <div id="cheque_lines_div" class="mt-3">
        <ul style="list-style: none" >
            <li>
                <p class="montant-horizontal-line1"><small class=" text-somme-lettres text-end">dfdf</small> </p>
            </li>
            <li class="mt-3">
                <p class="montant-horizontal-line2" style="display: none;"><span id="somme-plier"> </p>
            </li>
            <li>
                <p class="societe-horizontal-line">A <span id="societe-row"> *******************</span> </p>
            </li>

        </ul>
    </div>
    <div class="row">
        <div class="col-sm-6 ">
            <div>
                <p class="banque-text"style="line-height: 0.5em;">ETOILS SECOURS</p>
                <p class="banque-text"style="line-height: 0.5em;">18 RUE DE LA BANQUE</p>
                <p class="banque-text"style="line-height: 0.5em;">87000 LIMOGES</p>

            </div>
        </div>
    </div>

</div>
<div class=" col-sm-4">

    <div>
        <ul class=" list-unstyled">
            <li>
                <p class="ville-line"> <span id="ville-text"> SAINT-PALAIS-SUR-MER</span> </p>
            </li>
            <li>
                <p class="date-line">Le <span id="date-text">'.date('d/m/y').'</span> </p>
            </li>
        </ul>
    </div>

</div>

</div>
<div class="html2pdf__page-break"></div>
<div>
<h1>sds</h1>
</div> -->