function doConvert (){
    let numberInput = document.querySelector('#montant').value ;
    let sommeLettres = document.querySelector('#somme');
    let montantLettres = document.querySelector('#montantLettres');


    let oneToTwenty = ['','un ','deux ','trois ','quatre ', 'cinq ','six ','sept ','huit ','neuf ','dix ',
    'onze ','douze ','treize ','quatorze ','quinze ','seize ','dix-sept ','dix-huit ','dix-neuf '];
    let tenth = ['', '', 'vingt','trent','quarante','cinquante', 'soixante','soixante-dix','quatre-vingts','quatre-vingts-dix'];

    if(numberInput.toString().length > 7) return myDiv.value = 'overlimit' ;
  let num = ('0000000'+ numberInput).slice(-7).match(/^(\d{1})(\d{1})(\d{2})(\d{1})(\d{2})$/);
    if(!num) return;

    let outputText = num[1] != 0 ? (oneToTwenty[Number(num[1])] || `${tenth[num[1][0]]} ${oneToTwenty[num[1][1]]}` )+' million ' : ''; 
  
    outputText +=num[2] != 0 ? (oneToTwenty[Number(num[2])] || `${tenth[num[2][0]]} ${oneToTwenty[num[2][1]]}` )+'cent ' : ''; 
    outputText +=num[3] != 0 ? (oneToTwenty[Number(num[3])] || `${tenth[num[3][0]]} ${oneToTwenty[num[3][1]]}`)+' mille ' : ''; 
    outputText +=num[4] != 0 ? (oneToTwenty[Number(num[4])] || `${tenth[num[4][0]]} ${oneToTwenty[num[4][1]]}`) +'cent ': ''; 
    outputText +=num[5] != 0 ? (oneToTwenty[Number(num[5])] || `${tenth[num[5][0]]} ${oneToTwenty[num[5][1]]} `) : ''; 

    sommeLettres.innerHTML = outputText;
    montantLettres.value = outputText;
}



function doConvertLettres(){
    let numberInput = document.querySelector('#montant').value ;
    let sommeLettres = document.querySelector('#sommeCheque');
    sommeLettres.innerHTML =numberInput;
    doConvert();
 }


$('.selectAll').change(function(){
  alert("sdsd");
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

function description(rowId){
    document.getElementById("rowDescription").value = rowId;
    document.getElementById('descriptionForm').style.display = "block"
 }
 function annulerDescription(){
    document.getElementById('descriptionForm').style.display = "none";
 }
function envoyerDescription(){

    console.log(document.getElementById("descriptionForm"));
    document.getElementById("descriptionForm").submit()
    alert("dsd");
    document.getElementById('descriptionForm').style.display = "none";
}
function afficherDescription(idDivDescription){
    document.getElementById(idDivDescription).style.display = "block";
}
function desafficherDescription(idDivDescription){
    document.getElementById(idDivDescription).style.display = "none";
}



//quand on choisi la societe, on va recoupere la banque et afficher
$("#selectSociete").on('change', function(){
    let societe = this.options[this.selectedIndex].text;
    remplireSocieteCase(societe); //remplir la partie sociéte sur la forma cheque
    let idSociete = this.value;
    $.ajax(
        {
        url:'models/includes/getBanque.php',
        type:'POST',
        data:'change='+ idSociete,
        success:function(data){
            let parseDate= JSON.parse(data);
            remplireBaqueCase(parseDate);//remplir la partie cordonées sur la forma cheque
        
        }
    });

});

function remplireSocieteCase(societe){
    document.getElementById('societe-row').innerHTML =societe;
}

function remplireBaqueCase(data){
    let cp = document.getElementById('cpBanque');
    let ville = document.getElementById("villeBanque");
    let tel = document.getElementById("telBanque");
    let adresse= document.getElementById('adresseBanque');
    let icon = document.getElementById('iconBanque');

    //remplisage
    cp.innerHTML =data['cpBanque'];
    ville.innerHTML = data['villeBanque'];
    tel.innerHTML = data['telBanque'];
    adresse.innerHTML = data['adresseBanque'];
    icon.src="assets/img/"+data['courtNomBanque'];
 }

 //quand on input le numéro facture
 $('#factureForme').on('input','#numeroFacture',function(){
    let numeroFacture = this.value; //numero facture
    let errMesaage = document.getElementById("erreurMessageFacture");
    errMesaage.innerHTML="";
     $.ajax(  //request POST vers fetchFunction.php
         {
            url:'models/includes/fetchFunctions.php',
            type:'POST',
            data:{
            'chackFacture': numeroFacture,
        },
         success:function(msg){
            if(msg !==""){
                //ici on a déja  une facture avec ce numero
                errMesaage.innerHTML = msg;
            }
      
         }
     });

});

$("#factureForme").on("submit", function(e){
    let inputs = this;
    for(var i=0; i<inputs.length; i++){ 
        //pour chaque input verificatin si n'est pas vide  
        if(inputs[i].value =='' && inputs[i].value !="submit"){
            errMsg = "Veuillez renseigner tout les champs";
            break;
        }
    }
    let errFacture = document.getElementById("erreurMessageFacture").innerHTML;
     if(errFacture){
        //input un dublicat value dans la case numero facture
        errMsg = "il exist deja une facture avec ce numero";
     }
if((errMsg)){
    //ici on a un formulaire invalide
    e.preventDefault();//on laisse pas l'envoi
    document.getElementById('msgDiv').style.backgroundColor = "red";
    document.getElementById("msg").innerHTML=errMsg;
}else {
    document.getElementById('msgDiv').style.backgroundColor = "red";
    document.getElementById("msg").innerHTML=errMsg;
}
  document.getElementById("msgDiv").style.display="block";
  //afficher le message 600ms
 // setTimeout(function() {$('#msgDiv').fadeOut();}, 600)
});


if($("#factureForme")){
    $("#factureForme").on("input", function(){
    document.getElementById("msg").innerHTML = "";
      document.getElementById("msgDiv").style.display="none";
    });
}


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
             url:'models/FetchImpressionManager.php',
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
    alert("sdd");
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
function changPrintsStatus(nFacturs){
    $.ajax(
        {
        url:'models/FetchImpressionManager.php',
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
           url:'models/FetchImpressionManager.php',
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
 $(".table").on('click','.printButton',function(){
    let searchValue = document.getElementById('search').value;
    let table = $(".table");  
    var currentRow = $(this).closest("tr");
   // var deleteRow = currentRow.find(".row")[1];
    console.log( deleteRow );

      $.ajax(
      {
           url:'models/FetchImpressionManager.php',
           type:'POST',
           data:{
              'deleteRow': deleteRow,
              'searchValue':((searchValue !="") ? searchValue : ""),
          },
           success:function(e){
             table.innerHTML="";
             table.html(e);
       
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
                setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
                   
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
          url:'models/FetchImpressionManager.php',
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

//search par numéro du cheque ou par nom de la société
$('.search').on('input',function(){
    let value = this.value;
     $.ajax(
         {
        url:'models/FetchImpressionManager.php',
        type:'POST',
        data:'search='+ value,
        success:function(data){
            let table = $("#tableImression");
            table.html(data);//remplace la contenu table sans récharger la page
      
         }
     });   
 });

function printCheque() {
    let inputs = document.getElementById("factureForme").elements;

    let errMsg ="";
    for(var i=0; i<inputs.length; i++){      
        if(inputs[i].value ==''){
            alert("sd");
            errMsg = "Veuillez renseigner tout les champs";
            break;
        }
    }
    let errFacture = document.getElementById("erreurMessageFacture").innerHTML;
     if(errFacture){
        errMsg = "il exist deja une facture avec ce numero";
     }
     if((errMsg)){
         //ici on a un formulaire invalide
         document.getElementById('msgDiv').style.backgroundColor = "red";
         document.getElementById("msg").innerHTML=errMsg;
         setTimeout(function() {$('#msgDiv').fadeOut();}, 600)
    }else {   
        //recuperation des values
        let socId = document.getElementById('selectSociete').value;
        let montantLettres = document.getElementById('somme').innerHTML;
        let montant = document.getElementById('sommeCheque').innerHTML;
        $.ajax(
            { //requête méthode POST vers pdf-print.php
                url:'models/includes/pdf-print.php',
                type:'POST',
                data:{
                    'socId': socId ,
                    'montantLettres': montantLettres,
                    'montant': montant,

           },
           success:function(data){
            // data contenu du pdf-print.php
            //crée pdf avec la contenu du data
               html2pdf().from(data).toPdf().get('pdf').then(function (pdfObj) {
                    pdfObj.autoPrint();
                    window.open( pdfObj.output('bloburl'), 'popup');
              });
            }
        }); 
    }
}
function submitFacture(){
    document.getElementById('factureForme').submit();
}

$('#sitesearch').on("input", function () {
  
    filtre_checked=0;
    let input,filter, table,tr,td_soc,td_fac;
    input= document.getElementById('sitesearch').value;
    filter  = input.toUpperCase();
    table = document.getElementById("tableSignature");
    tr = table.getElementsByTagName("tr")
    for(let i=1;i<tr.length;i++){
        td_soc = tr[i].getElementsByTagName("td")[2];
        td_fac = tr[i].getElementsByTagName("td")[0];
        if(td_soc || td_fac ){
            txtSoc = td_soc.innerText;
            txtFac=td_fac.innerText;
            if(txtSoc.toUpperCase().indexOf(filter)>-1 || txtFac.toUpperCase().indexOf(filter)>-1 ){
                tr[i].style.display="";
                filtre_checked++;
            }else{
                tr[i].style.display="none";
            }
        }
    }
  
        //document.getElementById("serachForm").submit();

 })

 $("numeroCheque").on('input',function(){
    let numeroCheque = this.value; //numero facture
    let errMesaage = this.nextElementSibling;//err message
    errMesaage.innerHTML="";
     $.ajax(  //request POST vers fetchFunction.php
         {
            url:'models/includes/fetchFunctions.php',
            type:'POST',
            data:{
            'chackCheque': numeroCheque,
        },
         success:function(msg){
            console.log(msg);
            if(msg !==""){
                //ici on a déja  une cheque avec ce numero
                errMesaage.innerHTML = msg;
            }
      
         }
     });

});

//signature
function toggleCheckbox(trId){
    trTable = document.querySelector('.'+trId); 
    var numeroCheque = jQuery('.'+trId).find("td:eq(5) input[type='text']")[0].value;
    var dateCheque = jQuery('.'+trId).find("td:eq(6) input[type='date']")[0].value;  
    var numeroFacture = jQuery('.'+trId).find("td:eq(0)")[0];  

     if(!numeroCheque  || !dateCheque || !numeroFacture ){
         document.getElementById('msgDiv').style.backgroundColor = "red";
         document.getElementById("msg").innerHTML='veyez remplisez tout les cases';
         setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
         window.location.href="signature";
     } else {
         $.ajax(  //request POST vers fetchFunction.php
         {
            url:'models/includes/fetchFunctions.php',
            type:'POST',
            data:{
            'checkCheque': numeroCheque,
        },
         success:function(msg){
             if(msg !==""){  
                //  exist
                document.getElementById('changeMsgDiv').style.backgroundColor = "red";
                document.getElementById("changeMsg").innerHTML=msg;
                 //afficher le message 600ms
                 setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
               } else{
                createCheque(numeroCheque,dateCheque,numeroFacture ) 
               }              
     
         }
     });
     }
}

function createCheque(numeroCheque,dateCheque, description="",numeroFacture  ) {
    $.ajax(  //request POST vers fetchFunction.php
    {
       url:'models/FetchImpressionManager.php',
       type:'POST',
       data:{
       'numeroCheque': numeroCheque,
       'dateCheque': dateCheque,
       'descriptionCheque': description,
       'numeroFacture':numeroFacture 
   },
    success:function(msg){
      
 
    }
});
}

function envoyerExpedition(chequeId){
    console.log(chequeId);
    $.ajax(  //request POST vers fetchFunction.php
    {
    url:'models/includes/fetchFunctions.php',
       type:'POST',
       data:{
       'chequeExpedition': chequeId,
   
   },
    success:function(msg){
        if(msg){
             document.getElementById('msgDiv').style.backgroundColor = "green";
             document.getElementById("msg").innerHTML=msg;
          //   setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
        } else {
            document.getElementById('msgDiv').style.backgroundColor = "red";
             document.getElementById("msg").innerHTML='expedition échué';
             setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
        }

    }
});
}

function annulerExpedition(chequeId){
    console.log(chequeId);
    $.ajax(  //request POST vers fetchFunction.php
    {
    url:'models/includes/fetchFunctions.php',
       type:'POST',
       data:{
       'chequeExpedition': chequeId,
   
   },
    success:function(msg){
        if(msg){
             document.getElementById('msgDiv').style.backgroundColor = "green";
             document.getElementById("msg").innerHTML=msg;
          //   setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
        } else {
            document.getElementById('msgDiv').style.backgroundColor = "red";
             document.getElementById("msg").innerHTML='expedition échué';
             setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
        }

    }
});
}


function description(rowId){
    document.getElementById("rowDescription").value = rowId;
    document.getElementById('descriptionForm').style.display = "block"
 }
 function annulerDescription(){
    document.getElementById('descriptionForm').style.display = "none";
 }
function envoyerDescription(){

    console.log(document.getElementById("descriptionForm"));
    document.getElementById("descriptionForm").submit()

    document.getElementById('descriptionForm').style.display = "none";
}
function afficherDescription(idDivDescription){
    document.getElementById(idDivDescription).style.display = "block";
}
function desafficherDescription(idDivDescription){
    document.getElementById(idDivDescription).style.display = "none";
}