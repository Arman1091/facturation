//search
// $('.search-signature').on('input',function(){
//     let value = this.value;
//     console.log(this.value);
//      $.ajax(
//          {
//         url:'models/includes/FetchSignatureManager.php',
//         type:'POST',
//         data:'searchSignature='+ value,
//         success:function(data){
//               let tbody = $(".tbodySignature");
// console.log(tbody);
//               tbody.html(data);//remplace la contenu tbody sans récharger la page
      
//          }
//      });   
//  });



//delete
function descriptionSignature(rowId){
    document.getElementById("signatureHiddenValue").value = rowId;
    var numeroCheque = jQuery('#'+rowId).find("td:eq(6) input[type='text']")[0].value;
    var dateCheque = jQuery('#'+rowId).find("td:eq(7) input[type='date']")[0].value;  
    console.log(dateCheque);
    var numeroFacture = jQuery('#'+rowId).find("td:eq(1)").text(); 
    if(!numeroCheque  || !dateCheque || !numeroFacture ){
        document.getElementById('msgDiv').style.backgroundColor = "red";
        document.getElementById("msg").innerHTML='veyez remplisez tout les cases';
        setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
     //   window.location.href="signature";
     } else {
        $msgCheque = $('.msg-cheque')[0].innerHTML;
        if($msgCheque ==""){ 
            document.getElementById('descriptionSignatureDiv').style.display = "block"         
        }
     } 
 }
  function annulerSignatureDescription(){
     document.getElementById('descriptionSignatureDiv').style.display = "none";
  }
function envoyerSignatureDescription(){

    let motif =document.getElementById('descriptionSignatureTextarea').value;
    if(motif == ""){
        document.getElementById('descriptionSignatureTextarea').placeholder= "veyez remplisez le motif d'annulation";
    }else{
        let rowId =document.getElementById("signatureHiddenValue").value ;
        var numeroCheque = jQuery('.'+rowId).find("td:eq(6) input[type='text']")[0].value;
        var dateCheque = jQuery('.'+rowId).find("td:eq(7) input[type='date']")[0].value;  
        var numeroFacture = jQuery('.'+rowId).find("td:eq(1)").text(); 
        if(!numeroCheque  || !dateCheque || !numeroFacture ){
            document.getElementById('msgDiv').style.backgroundColor = "red";
            document.getElementById("msg").innerHTML='veyez remplisez tout les cases';
            setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
         //   window.location.href="signature";
         } else {
            $msgCheque = $('.msg-cheque')[0].innerHTML;
            if($msgCheque ==""){ 
                let searchValue = $('#search-signature')[0].value;
                $.ajax(  //request POST vers fetchFunction.php
                {
                    url:'models/includes/FetchSignatureManager.php',
                    type:'POST',
                    data:{
                        'numero_cheque': numeroCheque,
                        'date_cheque': dateCheque,
                        'numero_facture':numeroFacture,
                        'searchValue':((searchValue !="") ? searchValue : ""),
                        'motif': motif 
            
                  },
                  success:function(data){
                    document.getElementById('descriptionSignatureDiv').style.display = "none";
                    console.log(data);
                        let tbody = $(".tbodySignature");
                        // console.log(tbody);
                        tbody.html(data);   
                   }
                });         
            }
         } 
       // console.log(numeroCheque );
    }
    // $.ajax(  
    // {
    //    url:'models/includes/FetchImpressionManager.php',
    //    type:'POST',
    //    data:{
    //    'numeroFactureAnnulation': numeroFactureAnnulation,
    //    'motif': motif   //la dscription
    //    },
    //    success:function(data){
    //        let table = $("#tableSignature");
    //        table.html(data);
    //    }
    // });

}

$(".numeroCheque").on('input',function(){
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

});//************ */
//signature
function toggleCheckbox(trId){

    trTable = document.querySelector('#'+trId); 
    console.log( trTable);
    var numeroCheque = jQuery('#'+trId).find("td:eq(6) input[type='text']")[0].value;
    var dateCheque = jQuery('#'+trId).find("td:eq(7) input[type='date']")[0].value;  
    var numeroFacture = jQuery('#'+trId).find("td:eq(1)").text(); 
     if(!numeroCheque  || !dateCheque || !numeroFacture ){
        document.getElementById('msgDiv').style.backgroundColor = "red";
        document.getElementById("msg").innerHTML='veyez remplisez tout les cases';
        setTimeout(function() {$('#msgDiv').fadeOut();}, 800);
        window.location.href="signature";
     } else {
        $msgCheque = $('.msg-cheque')[0].innerHTML;
        if($msgCheque ==""){ 
            createCheque(numeroCheque,dateCheque,numeroFacture ) ;            
        }
     } 
     
}//***** */

//crée un cheque 
function createCheque(numeroCheque,dateCheque, numeroFacture  ) {
    alert("ds");
    let searchValue = $('#search-signature')[0].value;
//     console.log(searchValue.value);
    $.ajax(  //request POST vers fetchFunction.php
    {
        url:'models/includes/FetchSignatureManager.php',
        type:'POST',
        data:{
            'numeroCheque': numeroCheque,
            'dateCheque': dateCheque,
            'numeroFacture':numeroFacture,
            'searchValue':((searchValue !="") ? searchValue : ""),

      },
      success:function(data){
        console.log(data);
            let tbody = $(".tbodySignature");
            // console.log(tbody);
            tbody.html(data);   
       }
    });
}
function zz(){
    alert("sd");
}