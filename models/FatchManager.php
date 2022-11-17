<?php 
// $_bdd = new PDO('mysql:host=localhost; dbname=facturation_stock;charset=utf8', 'root', '');
// $_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if (isset($_POST['deleteRow']) && !empty($_POST['deleteRow'])) {

try {
   $facttureManager = new FactureManager;
   $facttureManager->deleteFacture($_POST['deleteRow']);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
}


      
                   echo`
                   <thead>
                   <tr>
                       <th scope="col">
  
                           <input type="checkbox" name="selectAll" id="selectAll" class="selectAll">
  
                       </th>
                       <th scope="col">Idd</th>
                       <th scope="col">Numero </th>
                       <th scope="col">Date</th>
                       <th scope="col">Societe</th>
                       <th scope="col">Banque</th>
                       <th scope="col">Montant</th>
                       <th scope="col"> </th>
                   </tr>
               </thead>
  <tr>
      <td > <input  class="checkitem" type="checkbox" name=checkitems[] value="d"></td>
      <td  scope="row"><p class="mx-2"><?= (1) ?></p></td>
      <td value="d>"><input class="td-input row" value="d"type="text" id="numeroFacture" name="numeroFacture" ></td>
      <td value="<d?>"><input class="td-input"value="d" type="text" id="dateFacture" name="dateFacture"></td>
      <td value="x">
          <select name="fkSociete"class="td-input">
              <option selected value="">ddd</option>
             
          </select>
      </td>
      <td >"sdsydgsdgsdgsgdsd" </td>
      <td value="d>">
          <input class="w-100  bg-olive td-input" type="number" step="0.01" min=1 id="m" name="montantFacture">
      </td>
      <td>
          <button type="button" class="btn btn-danger deleteButton" style="height: 60%;" value="s">Delete</button>
      </td>
  </tr>
  
  
  
  
  
  ');
 `;