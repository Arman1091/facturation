
$('.selectAll').change(function(){
      // if(tr[i].style.display="none";)
  var checkboxes = document.querySelectorAll("input[type='checkbox']");
  if($(this).prop("checked")){
      checkboxes.forEach(function(checkbox){
          if(checkbox.checked != "true"){
              checkbox.checked=true;
          }
      });
  }else{
      checkboxes.forEach(function(checkbox){
          checkbox.checked=false;});
  }
    //  $('.checkitem').prop("checked",$(this).prop("checked"));
  });
  
  document.querySelectorAll("input[type='checkbox']").forEach(function(checkbox){
      checkbox.addEventListener("change", function () {
         if(this.checked==false){
             $('.selectAll').prop("checked", false);
             if(document.getElementById('search').value){
                 checked--;
              }
          }else {
              if(!document.getElementById('search').value){
                  if($(".checkitem:checked").length == $(".checkitem").length){
                    $('.selectAll').prop("checked", true);
                  }   
              }
          }
     });
  });
  //supprimer plusieurs d'un coup
$("#formImpression").on('click','#deleteManyImpressions',function(){
    var cheeckItemss = $(".checkitem:checked");//les row selectées
    if(cheeckItemss.length == 0) {//verify si y'a au moin un row
        //si y'a oas de row selecté on affiche une mesage
        document.getElementById('changeMsgDiv').style.backgroundColor = "red";
        document.getElementById("changeMsg").innerHTML="choisissez au mois un row";
        document.getElementById('changeMsgDiv').style.display = "block";
        setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
    } else{
        //si on a au moin un row
        let nFacturs = [];
        let searchValue = document.getElementById('search').value;
        for(j=0; j < cheeckItemss.length; j++){
            nFacturs[j] = cheeckItemss[j].value; //on recopere les numeros  des factures selectées
        }
        $.ajax(
             {
             url:'models/includes/FetchImpressionManager.php',
             type:'POST',
             data:{
                'deleteCheckItems': nFacturs,
                'searchValue':((searchValue !="") ? searchValue : ""),
            },
             success:function(data){
                if(confirm(" voulez vous supprimer")){
                    //apres la confirmation
                    let table = $("#tableImression");
                    table.html(data);//remplacement la contenu
                    document.getElementsByClassName("changeMsgDiv").style.display="block";
                    //afficher le message 600ms
                    setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
                }
             }
         });
    }
});
//imprimer plusieurs d'un coup
function printFactures(){
    var cheeckItemss = $(".checkitem:checked");//les row selectées
    if(cheeckItemss.length == 0) {//verify si y'a au moin un row
        //si y'a oas de row selecté on affiche une mesage
        document.getElementById('changeMsgDiv').style.backgroundColor = "red";
        document.getElementById("changeMsg").innerHTML="choisissez au mois un row";
        document.getElementById('changeMsgDiv').style.display = "block";
        setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
    } else{
        //si on a au moin un row
        let nFacturs = [];
        for(j=0; j < cheeckItemss.length; j++){
            nFacturs[j] = cheeckItemss[j].value; //on recopere les numeros  des factures selectées
        }
        $.ajax(
             {
             url:'models/includes/pdf-prints.php',
             type:'POST',
             data:{
                'printCheckItems': nFacturs
            },
             success:function(data){   
            // data contenu du pdf-prints.php
            //crée pdf avec la contenu du data
            html2pdf().from(data).toPdf().get('pdf').then(function (pdfObj) {
                pdfObj.autoPrint();
                window.open( pdfObj.output('bloburl'), 'popup');
                changPrintsStatus(nFacturs);//change print status
          });

             }
         });
    }
};
//search par numéro du cheque ou par nom de la société
$('.search').on('input',function(){
    let value = this.value;
     $.ajax(
         {
        url:'models/includes/FetchImpressionManager.php',
        type:'POST',
        data:'search='+ value,
        success:function(data){
            let table = $("#tableImression");
            table.html(data);//remplace la contenu table sans récharger la page
      
         }
     });   
 });

//  $(".table").on('click','.printButton',function(){
//     let searchValue = document.getElementById('search').value;
//     let table = $(".table");  
//     var currentRow = $(this).closest("tr");
//     console.log( currentRow );
//     var printRow = currentRow.find(".row")[0].value;
 
//       $.ajax(
//       {
//            url:'models/includes/FetchImpressionManager.php',
//            type:'POST',
//            data:{
//               'printRow': printRow,
//               'searchValue':((searchValue !="") ? searchValue : ""),
//           },
//            success:function(e){
//              table.innerHTML="";
//              table.html(e);
    
//            }
//       });
//  });
  //delete une facture
  $(".table").on('click','.deleteButton',function(){ 
    //on verifié si on a un value dans la case recherche
    let searchValue = document.getElementById('search').value;
    let table = $(".table");  
    var currentRow = $(this).closest("tr");
    //recuperation numero du facture par chexbox value
    var deleteRow = currentRow.find(".row")[0].value;
      $.ajax(
      {
        //requete vers la FetchImpressionManager.ph
           url:'models/includes/FetchImpressionManager.php',
           type:'POST',
           data:{
              'deleteRow': deleteRow,
              'searchValue':((searchValue !="") ? searchValue : ""),
          },
           success:function(contenu){
            if(confirm(" voulez vous supprimer")){
                 table.html(contenu); //remplacement table contenu
                 document.getElementsByClassName("changeMsgDiv").style.display="block";
                 //afficher le message 600ms
                 setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
            }
           }
      });
 });

 $('#tableImression').on('change','.td-input',function(){

    var self = this;//l'input ou on a fait la modification
    var colName = this.name;//le nom input  ou on a fait la modification
    var value = this.value;//la valur d'input ou on a fait la modification
    var currentRow = $(this).closest("tr")//la row ou on a fait la modificatiob
    var nFact = currentRow.find(".checkitem")[0].value;//numro de la facture par value de checkbox
    // vérification l'existence du numero facture
    if (this.id = "numeroFacture"){
        $.ajax(
            {
            url:'models/includes/fetchFunctions.php',
            type:'POST',
            data:{
               'chackFacture': this.value,
           },
            success:function(msg){
               if(msg !==""){  
                //  exist
                document.getElementById('changeMsgDiv').style.backgroundColor = "red";
                document.getElementById("changeMsg").innerHTML=msg;
                self.value = nFact;
               } else{
                changeImpressionRow(nFact,colName,value ) 
               }
               document.getElementById("changeMsgDiv").style.display="block";
               //afficher le message 600ms
               // setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
                   
            }
        });
    } else {
        changeImpressionRow(nFact,colName,value) 
    }
})

function changeImpressionRow(nFact, colName, value){
    let searchValue = document.getElementById('search').value;
      $.ajax(
          {
          url:'models/includes/FetchImpressionManager.php',
          type:'POST',
          data:{
              'numeroFacture': nFact,
              'editCol':colName,
              'editValue':value,
              'searchValue':((searchValue !="") ? searchValue : ""),
          },
          success:function(data){
            let table = $("#tableImression");
            table.html(data);
          }
    
      });
      
}

function changPrintsStatus(nFacturs){
    $.ajax(
        {
        url:'models/includes/FetchImpressionManager.php',
        type:'POST',
        data:{
           'changPrintsStatus': nFacturs,
       },
        success:function(data){   
                //apres la confirmation
                let table = $("#tableImression");
                table.html(data);//remplacement la contenu;
        }
    });
}
