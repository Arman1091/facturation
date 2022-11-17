<?php

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <link rel="stylesheet" href="./assets/css/style.css">


</head>

<body>

    <nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
        <div class="container-fluid  ">
            <a class="navbar-brand" href="#">Facturation</a>

            <button class="navbar-toggler" style="margin-right:5px !important;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse top_nav justify-content-end" id="navbarSupportedContent">
                <ul class="navbar  navbar-nav navbar-rigth">
                    <li class=" nav-item">
                        <a href="<?= URL ?>" class="nav-link">Accueil</a>
                        <!-- <hr class="hr_nav"> -->
                    </li>
                    <li class="nav-item "><a href="<?= URL ?>impression" class="nav-link">Impression</a>
                    </li>
                    <li class="nav-item "><a href="<?= URL ?>signature" class="nav-link">Signature</a>
                    </li>
                    <li class="nav-item "><a href="<?= URL ?>expedition" class="nav-link">Expedition</a>
                    </li>
                    <li class="nav-item "><a href="<?= URL ?>historique" class="nav-link">Historique</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <main>