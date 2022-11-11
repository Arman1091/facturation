<?php
if (!empty($_POST)) {
    //On vérifie que tout les champs requis son remplis
    if (
        isset(
            $_POST['selectSociete'],
            $_POST['selectBanque'],
            $_POST['montantLettres'],
            $_POST['numeroFacture'],
            $_POST['montant'],
            $_POST['dateCheque'],
            $_POST['paimentId'],
            $_POST['dateFacture']
        ) &&
        !empty($_POST['selectSociete']) && !empty($_POST['selectBanque']) && !empty($_POST['montantLettres']) &&
        !empty($_POST['numeroFacture']) && !empty($_POST['montant']) &&
        !empty($_POST['dateCheque']) && !empty($_POST['paimentId']) && !empty($_POST['dateFacture'])
    ) {

        if (!filter_var($_POST['selectSociete'], FILTER_VALIDATE_INT)) {
            die("SocieteId est incorrect");
        }
        if (!filter_var($_POST['selectBanque'], FILTER_VALIDATE_INT)) {
            die("BanqueId est incorrect");
        }
        if (!filter_var($_POST['paimentId'], FILTER_VALIDATE_INT)) {
            die("BanqueId est incorrect");
        }
        $rowId = (int)$_POST['rowId'];

        $fk_soc = strip_tags($_POST['selectSociete']);
        $fk_banque = strip_tags($_POST['selectBanque']);
        $n_facture = strip_tags($_POST['numeroFacture']);
        if (!filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT)) {
            die("Montant est incorrect");
        }
        require_once "models/includes/BanqueCheque.php";
        $baqnueChequeManager = new BanqueCheque;
        $banque_cheque = $baqnueChequeManager->getBanqueCheque($fk_soc, $fk_banque);
        if (!isset($banque_cheque)) {
            die("banque cheque n'existe pas");
        }
        $n_cheque = $banque_cheque['nom_court'] . "_" . ($banque_cheque['n_cheque'] + 1);
        $date_facture = strip_tags($_POST['dateFacture']);
        $date_cheque = strip_tags($_POST['dateCheque']);
        $paiement = strip_tags($_POST['paimentId']);
        $montant = $_POST['montant'];
        $montant_lettres = strip_tags($_POST['montantLettres']);
        $elementManager = new ElementManager;
        $elementManager->UpdateElement(
            $date_facture,
            $date_cheque,
            $fk_soc,
            $n_facture,
            $montant,
            $montant_lettres,
            $paiement,
            $n_cheque,
            $rowId
        );
        header('Location:' . URL . 'printe');
        exit();
    }


    if (
        isset(
            $_POST['rowId'],
        ) &&
        !empty($_POST['rowId'])
    ) {
        $rowId = filter_var($_POST['rowId'], FILTER_VALIDATE_INT);
        $societeManager = new SocieteManager;
        $paiementManager = new PaiementManager;
        $banqueManager = new BanqueManager;
        $societes = $societeManager->getArticles();
        $paiements = $paiementManager->getArticles();
        $banques = $banqueManager->getArticles();
        //recouperer le nomCourt de banque selecté
        $nom_court = explode('_', $elementEdit->NCheque())[0];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ipmressiont</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <h1 class="text-center">Edit</h1>
    </header>

    <form method="post" name="test" id="test">
        <div class="row">
            <div class="col-3">
                <select class="form-select" name="selectSociete">
                    <option selected value="<?= $societeManager->getSociete($elementEdit->FkSoc())->id() ?>"><?= $societeManager->getSociete($elementEdit->FkSoc())->nom()  ?></option>
                    <?php foreach ($societes as $societe) : ?>
                        <option value=<?= $societe->id() ?>><?= $societe->nom() ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-3"></div>
        </div>
        <div class="row my-3">
            <div class="col-7">
                <div>
                    <label for="selectBank">Banque</label>
                    <select class="form-select" aria-label="Default select example" id="selectedBanque" name="selectBanque">
                        <option selected value="<?= $banqueManager->getBanqueByNomeCourt($nom_court)->id() ?>"><?= $banqueManager->getBanqueByNomeCourt($nom_court)->nom() ?></option>
                        <?php foreach ($banques as $banque) : ?>
                            <option value=<?= $banque->id() ?>><?= $banque->nom() ?></option>'


                        <?php endforeach ?>
                    </select>
                </div>
                <div class="my-3">
                    <label for="numeroFacture">N°FACT</label>
                    <input type="text" id="facture" name="numeroFacture" value="<?= $elementEdit->NFact() ?>" style="width: 100%">
                </div>
                <div class="my-3">
                    <label for="dateFact">DateFact</label>
                    <input type="text" name="dateFacture" id="dateFacture" value="<?= $elementEdit->DateFact() ?>">
                </div>
            </div>
            <!-- $_SESSION['formulier_facturation'] = [
            "societe" => $_POST['Societe'],
            "banque" => $_POST['Banque'],
            "montantLettres" => $_POST['montantLettres'],
            "numero_facture" => $_POST['Facture'],
            "montant" => $_POST['Montant'],
            "date" => $_POST['Date'],
        ]; -->
            <div class="col-5">
                <div class="my-3">
                    <label for="montant">Somme</label>
                    <input type="nomber" step="0.001" id="montant" name="montant" value="<?= $elementEdit->Montant() ?>">
                </div>

                <div class="my-3">
                    <label for="montantLettres">Somme en lettres</label>
                    <input type="text" id="montantLettres" name="montantLettres" value="<?= $elementEdit->MontantLettres() ?>" style="width: 100%">
                </div>

                <div>
                    <label for="typePaiment">MODE DE PAIEMENT</label>
                    <select class="form-select my-2" aria-label="Default select example" id="paimentId" name="paimentId">
                        <option selected value="<?= $paiementManager->getPaiement($elementEdit->FkPaiement())->id() ?>"><?= $paiementManager->getPaiement($elementEdit->FkPaiement())->type()  ?></option>
                        <?php foreach ($paiements as  $paiement) : ?> {
                            <option value=<?= $paiement->id() ?>><?= $paiement->type() ?></option>'


                        <?php endforeach ?>
                    </select>
                </div>
                <div class="my-3">
                    <label for="date">Date Cheque</label>
                    <input type="text" name="dateCheque" id="date" value="<?= $elementEdit->DateCheque() ?>">
                </div>

            </div>
        </div>

        <div class="mt-3">
            <input type="hidden" name="rowId" value="<?= $rowId ?>">
            <button type="submit">Update</button>
        </div>
    </form>
</body>

</html>