<?php

if (!empty($_POST)) {
    if (
        isset(
            $_POST['societe'],
            $_POST['numeroFacture'],
            $_POST['montant'],
            $_POST['dateFacture'],
        ) &&
        !empty($_POST['societe'])  && !empty($_POST['numeroFacture']) && !empty($_POST['montant']) &&
        !empty($_POST['dateFacture'])
    ) {
        if (!filter_var($_POST['societe'], FILTER_VALIDATE_INT)) {
            die("SocieteId est incorrect");
        }
        $societe_id = htmlspecialchars(strip_tags($_POST['societe']));
        $numero_facture = htmlspecialchars(strip_tags($_POST['numeroFacture']));
        if (!filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT)) {
            die("Montant est incorrect");
        }
        $montant = htmlspecialchars(strip_tags($_POST['montant']));
        $montant_lettres = htmlspecialchars(strip_tags($_POST['montantLettres']));
        $date_facture = htmlspecialchars(strip_tags($_POST['dateFacture']));
        $statut = 0;

        if ($_POST['saveAndPrint']) {
             require_once('models/includes/pdf-print.php');
            $statut = 1;
        }

        $instance = new Facture([
            "dateFacture" => $date_facture,
            "fkSociete" => $societe_id,
            "numeroFacture" =>  $numero_facture,
            "montantFacture" => $montant,
            "montantLettresFacture" => $montant_lettres,
            "statutFacture" => $statut
        ]);

        $factureManager = new FactureManager;
        $factureManager->newFacture($instance);
    } else {
        echo ("Le formulaire est incomplete");
    }
}

?>
<div class="container-fluid">
    <div class="row mt-3  p-2 " id="chequeRow">
        <!-- **********parti remplissage des information****** -->
        <div class="col-md-4 col-sm-7">
            <div class="container-flud">
                <div class="row">
                    <form id="factureForme" class="factureForme" method="post">

                        <div class="form-group mt-2">
                            <label class="text-danger" for="selectSociete">Societe</label>
                            <select class="form-select" name="societe" id="selectSociete">
                                <option selected value="">choissiez la societe</option>
                                <?php for ($i = 0; $i < count($societes); $i++) { ?>

                                    <option value=<?= $societes[$i]->id() ?>><?= $societes[$i]->nom() ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-2" >
                            <label class="text-danger" class="d-block" for="montant">Montant</label>
                            <input class="form-control" type="hidden" id="montantLettres" name="montantLettres" value="x">
                            <!-- voir apres********* -->
                            <input class="w-100 form-control " type="number" step="0.01" min=1 id="montant" name="montant" onchange="doConvertLettres()">
                        </div>
                        <div class=" form-group mt-2">
                            <label class="text-danger" for="numeroFacture">N°FACT</label>
                            <input class=" form-control" type="text" id="numeroFacture" name="numeroFacture" style="width: 100%">
                            <span class="text-danger" id="erreurMessageFacture"></span>
                        </div>
                        <div class=" form-group mt-2 ">
                            <label class="text-danger" for="dateFacture">Date de Facture</label>
                            <input class="form-control" type="date" id="dateFacture"  max=<?= date('d/m/y') ?> name="dateFacture">
                        </div>
                        <div>
                            <span id="erreurForm"class="text-center text danger"> </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ***********visualisation la cheque************ -->
        <div class="col-md-8 d-flex justify-content-center align-content-center">
            <div class="row cheque-row  mt-3  p-2">
                <div class="col-sm-8">
                    <div class="mt-2">
                        <img id="iconBanque" src="z" alt="" style="width: 25%; ">
                    </div>
                    <div id="cheque_lines_div" class="mt-3">
                        <ul class=" list-unstyled">
                            <li>
                                <p class="montant-horizontal-line1">Payez contre non endossable <span id="somme"> ******************************* </span>
                                    </br>
                                    Sauf au profit d'une banque ou d'un établissement assimilé<small class="text-danger text-somme-lettres text-end">somme en tout lettres</small> </p>
                            </li>
                            <li class="mt-3">
                                <p class="montant-horizontal-line2"><span id="somme-plier"> ********************************************</p>
                            </li>
                            <li>
                                <p class="societe-horizontal-line">A <span id="societe-row"> *******************</span> </p>
                            </li>

                        </ul>
                        <span id="first_barrier"></span>
                        <span id="second_barrier"></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <p class="text-center" style="font-size: 8px;line-height: 0.8em;">Payable en France</p>

                            <div class=" border">
                                <p id="adresseBanque" style="line-height: 0.5em;">******************</p>
                                <p style="line-height: 0.5em;"><span id="cpBanque">**********</span> <span id="villeBanque">********</span></p>
                                <p style="line-height: 0.5em;">TEL: <span id="telBanque">***************</span></p>
                            </div>
                        </div>
                        <div class="col-sm-6 ">
                            <p class="text-start" style="font-size: 8px;line-height: 0.1em;">N° de compte </p>
                            <p style="line-height: 0.1em; margin-top:-0.5em !important">xxxxxxxxxxxxxxxxxxx</p>
                            <div>
                                <p class="banque-text"style="line-height: 0.5em;">ETOILS SECOURS</p>
                                <p class="banque-text"style="line-height: 0.5em;">18 RUE DE LA BANQUE</p>
                                <p class="banque-text"style="line-height: 0.5em;">87000 LIMOGES</p>

                            </div>
                        </div>
                    </div>

                </div>
                <div class=" col-sm-4">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="assets/img/euro.webp" alt="" style="width: 15%;">
                        <p class="mt-2" style="line-height: 1em;font-size: 8px;">a rédiger exclusivement</p>
                        <p style="margin-top:-2em;font-size: 8px;">en euros</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="fs-1 text-center">€</p>

                        <p id="sommeCheque" class=" text-center p-2 border border-danger" style="width: 85%;">************</p>
                    </div>
                    <div>
                        <ul class=" list-unstyled">
                            <li>
                                <p class="ville-line">A <span id="ville-text"> SAINT-PALAIS-SUR-MER</span> </p>
                            </li>
                            <li>
                                <p class="date-line">Le <span id="date-text"> <?= date('d/m/y') ?></span> </p>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-center text-danger">Signature</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 d-flex justify-content-between align-content-center">
                        <p style="font-size: 8px;">Cheque N°</p>
                        <p style="font-size: 8px;">Série<strong>BB</strong></p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-between align-content-center">
                        <p style="font-size: 8px; ">Cheque N°<strong>xxxxxxx</strong></p>
                        <p style="font-size: 8px;"><strong>(22)</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <button class="btn bg-primary " type="submit" form="factureForme" name="saveAndPrint" value="0">Enregistrer</button>
        <button class="btn bg-secondary mx-1" type="button"  value="1" onclick="printTrigger()">Imprimerie</button>
    </div>
 <div>
<iframe id="iFramePdf" src="models/includes/pdf-print.php" style="display: none;"></iframe>
</div> 
</div>