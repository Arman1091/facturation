
  function annulerExpedition(rowId){
    document.getElementById("expeditionHiddenValue").value = rowId;
    document.getElementById('descriptionExpeditionDiv').style.display = "block";
 }
 function annulerExpeditionDescription(){
    document.getElementById('descriptionExpeditionDiv').style.display = "none";
 }
 function envoyerExpeditionDescription(){

    let motif =document.getElementById('descriptionExpeditionTextarea').value;
    if(motif == ""){
        document.getElementById('descriptionExpeditionTextarea').placeholder= "veyez remplisez le motif d'annulation";
    }else{

        let rowId =document.getElementById("expeditionHiddenValue").value ;   
        let numeroCheque = jQuery('.'+rowId).find("td:eq(5)").text();
        // let searchValue = $('#search-signature')[0].value;
         $.ajax(  //request POST vers fetchFunction.php
         {
             url:'models/includes/FetchExpeditionManager.php',
             type:'POST',
             data:{
                 'chequeAnnulation': numeroCheque,
                 'motif': motif 
    
           },
           success:function(data){
             document.getElementById('descriptionExpeditionDiv').style.display = "none";
             console.log(data);
                 let tbody = $(".tbodyExpedition");
                 // console.log(tbody);
                 tbody.html(data);   
            }
         });         
        }
    } 

function envoyerExpedition(rowId){
    alert("e");
    let numeroCheque = jQuery('.'+rowId).find("td:eq(5)").text();
    $.ajax(  //request POST vers fetchFunction.php
    {
        url:'models/includes/FetchExpeditionManager.php',
        type:'POST',
        data:{
            'chequeExpedition': numeroCheque,

      },
      success:function(data){
            let tbody = $(".tbodyExpedition");
            // console.log(tbody);
            tbody.html(data);   
       }
    }); 
}