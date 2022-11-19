<?php 
spl_autoload_register(function ($class) {
    require_once( $class . '.php');
});
if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {
    try {
        $nFact = strip_tags($_POST['deleteRow']);
        $factureManager = new FactureManager;
        $factureManager->deleteFacture($nFact);
    
     //    $query->closeCursor();
     //    if(isset($_POST['searchValue']) && !empty($_POST['searchValue'])){
     //    }
     echo "test";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}