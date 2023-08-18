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





//quand on choisi la societe, on va recoupere la banque et afficher
$("#selectSociete").on('change', function(){
    let societe = this.options[this.selectedIndex].text;
    remplireSocieteCase(societe); //remplir la partie sociéte sur la forma cheque
    let idSociete = this.value;
    $.ajax(
        {
             url:'models/includes/getBanque.php',
             type:'POST',
             data:{
                'change': idSociete,
            },
             success:function(e){
                let parseDate= JSON.parse(e);
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
    icon.src="assets/img/"+data['courtNomBanque']+'.png';
    console.log(icon.src);
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
function printCheque() {
    let errMsg = verificationChamps();
    if((errMsg)){
        //ici on a un formulaire invalide
        document.getElementById('msgDiv').style.backgroundColor = "red";
        document.getElementById("msg").innerHTML=errMsg;
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
                    submitFacture(1);
              });
            }
        });
    }
    document.getElementById("msgDiv").style.display="block";
    //afficher le message 1000ms
     setTimeout(function() {$('#msgDiv').fadeOut();}, 1000) 
}
function enregistrerFacture(){
    let errMsg = verificationChamps();
    if((errMsg)){
        //ici on a un formulaire invalide
        document.getElementById('msgDiv').style.backgroundColor = "red";
        document.getElementById("msg").innerHTML=errMsg;
    }else {
        submitFacture(0);
       
    }
    document.getElementById("msgDiv").style.display="block";
      //afficher le message 1000ms
    setTimeout(function() {$('#msgDiv').fadeOut();}, 1000)
};

function verificationChamps(){
    let inputs = document.getElementById("factureForme").elements;
    let errFacture = document.getElementById("erreurMessageFacture").innerHTML;
    let errMsg ="";
    if(errFacture){
       //input un dublicat value dans la case numero facture
       errMsg = "il exist deja une facture avec ce numero";
    }
    for(var i=0; i<inputs.length; i++){ 
        //pour chaque input verificatin si n'est pas vide  
        if(inputs[i].value =='' && inputs[i].value !="submit"){
            errMsg = "Veuillez renseigner tout les champs";
            break;
        }
    }
    return errMsg;
}

function submitFacture(statut){
    let inputs = document.getElementById("factureForme").elements;
    let idSociete = inputs[0].value;
    let montantLettres = inputs[1].value;
    let montant = inputs[2].value;
    let nFacture = inputs[3].value;
    let dateFacture = inputs[4].value;
    $.ajax(  //request POST vers fetchFunction.php
    {
       url:'models/includes/fetchFunctions.php',
       type:'POST',
       data:{
       'societe': idSociete ,
       'montantLettres': montantLettres ,
       'montant':  montant ,
       'numeroFacture': nFacture ,
       'dateFacture': dateFacture , 
       'statutSubmit': statut,
   },
    success:function(msg){
        console.log(msg);
       if(msg !=""){
           window.location.href="";
           //ici on a déja  une facture avec ce numero
           document.getElementById('msgDiv').style.backgroundColor = "green";
           document.getElementById("msg").innerHTML=msg;
       } else{
        document.getElementById('msgDiv').style.backgroundColor = "red";
        document.getElementById("msg").innerHTML="enregistrement échoué";
       } 
     }
 });
}
 if($("#factureForme")){
     $("#factureForme").on("input", function(){
     document.getElementById("msg").innerHTML = "";
       document.getElementById("msgDiv").style.display="none";
     });
 }

