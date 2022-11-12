function doConvert (){
    let numberInput = document.querySelector('#montant').value ;
    let sommeLettres = document.querySelector('#somme');


    let oneToTwenty = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ',
    'eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    let tenth = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

    if(numberInput.toString().length > 7) return myDiv.value = 'overlimit' ;
    //console.log(numberInput);
    //let num = ('0000000000'+ numberInput).slice(-10).match(/^(\d{1})(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
  let num = ('0000000'+ numberInput).slice(-7).match(/^(\d{1})(\d{1})(\d{2})(\d{1})(\d{2})$/);
    console.log(num);
    if(!num) return;

    let outputText = num[1] != 0 ? (oneToTwenty[Number(num[1])] || `${tenth[num[1][0]]} ${oneToTwenty[num[1][1]]}` )+' million ' : ''; 
  
    outputText +=num[2] != 0 ? (oneToTwenty[Number(num[2])] || `${tenth[num[2][0]]} ${oneToTwenty[num[2][1]]}` )+'hundred ' : ''; 
    outputText +=num[3] != 0 ? (oneToTwenty[Number(num[3])] || `${tenth[num[3][0]]} ${oneToTwenty[num[3][1]]}`)+' thousand ' : ''; 
    outputText +=num[4] != 0 ? (oneToTwenty[Number(num[4])] || `${tenth[num[4][0]]} ${oneToTwenty[num[4][1]]}`) +'hundred ': ''; 
    outputText +=num[5] != 0 ? (oneToTwenty[Number(num[5])] || `${tenth[num[5][0]]} ${oneToTwenty[num[5][1]]} `) : ''; 

    sommeLettres.innerHTML = outputText;
}



function doConvertLettres(){
    let numberInput = document.querySelector('#montant').value ;
    let sommeLettres = document.querySelector('#sommeCheque');
    sommeLettres.innerHTML =numberInput;
    doConvert();
 }

// function toggleCheckbox(i){
// alert("sds");
//     document.getElementById((i)).submit();
// }
//  function doConvertLettres(){
//      doConvert();
//   }
// var checkboxes = document.querySelectorAll("input[type='checkbox']");
// function checkAll(my){
//     if(my.checked==true){
//     checkboxes.forEach(function(checkbox){
//         checkbox.checked=true;
//     });
// } else {
//     checkboxes.forEach(function(checkbox){
//         checkbox.checked=false;
// });
// }
// }

// var checkAll = document.getElementById("selectAll");
// checkAll.addEventListener('change', function(){
//     alert("yg");
// })
let v = 0;
var checkboxes = document.querySelectorAll("input[type='checkbox']");
$('.selectAll').change(function(){
    
    // if(tr[i].style.display="none";)
if($(this).prop("checked")){
    checkboxes.forEach(function(checkbox){
        if(checkbox.style.display != "none"){
            checkbox.checked=true;
        }
    });
}else{
    checkboxes.forEach(function(checkbox){
        checkbox.checked=false;});
}
  //  $('.checkitem').prop("checked",$(this).prop("checked"));
})
let checked = 0;
let filtre_checked=0;
checkboxes.forEach(function(checkbox){
    if(checkbox.style.display != "none"){
        checkbox.addEventListener("change", function () {
     
            if(this.checked==false){
                $('.selectAll').prop("checked", false);
                if(document.getElementById('sitesearch').value){
                checked--;
                }
            }else {
            if(!document.getElementById('sitesearch').value){
                filtre_checked=0;
                checked = 0;
                console.log($(".checkitem:checked").length);
                console.log("ds");
                if($(".checkitem:checked").length == $(".checkitem").length){
                  $('.selectAll').prop("checked", true);}
            }else {
                checked++;
                alert( checked);
                if(checked == filtre_checked){
       
                    $('.selectAll').prop("checked", true);
                }
            }
               
            }
        })
        
    }

});
// $(".checkitem").change(function(){
    
//     if($(this).prop("checked") == false){
//         $('.selectAll').prop("checked", false);
//     }
//   if($(".checkitem").css('display') != "none" ){
//    console.log($(".checkitem").css('display'));
//   }
//     if($(".checkitem:checked").length == $(".checkitem").length){
//         $('.selectAll').prop("checked", true);

//     }
   
// })




 $('.sitesearch').on("input", function () {
    filtre_checked=0;
    let input,filter, table,tr,td_soc,td_fac, tcvalue;
    input= document.getElementById('sitesearch').value;
    filter  = input.toUpperCase();
    table =document.getElementById("attTable");
    tr=table.getElementsByTagName("tr");
    for(let i=1;i<tr.length;i++){
        td_soc = tr[i].getElementsByTagName("td")[3];
        td_fac = tr[i].getElementsByTagName("td")[4];
        if(td_soc || td_fac ){
            txtSoc = td_soc.innerText;
            txtFac=td_fac.innerText;
            if(txtSoc.toUpperCase().indexOf(filter)>-1 || txtFac.toUpperCase().indexOf(filter)>-1 ){
                tr[i].style.display="";
                filtre_checked++;
                console.log(filtre_checked);
            }else{
                tr[i].style.display="none";
            }
        }
    }
  
        //document.getElementById("serachForm").submit();

 })

//  function f(){

//    let x= document.getElementsByTagName('form');
//    let i ;
//    for(i=0;i<x.length; i++){
//     x[i].submit();
//    }

//  }
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
    remplireSocieteCase(societe);
    let idSociete = this.value;
    console.log(idSociete);
 
    $.ajax(
        {
        url:'models/includes/getBanque.php',
        type:'POST',
        data:'change='+ idSociete,
        beforeSend:function(){
        console.log("woeking on");
        },
        success:function(data){
        let parseDate= JSON.parse(data);
        console.log(parseDate);
        remplireBaqueCase(parseDate);
        
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
    console.log(tel);

    cp.innerHTML =data['cpBanque'];
    ville.innerHTML = data['villeBanque'];
    tel.innerHTML = data['telBanque'];
    adresse.innerHTML = data['adresseBanque'];
    console.log(data);
 }
//  if(($("#formImpression"))){

//     console.log($("#formImpression"));
//  }




 $(".deleteButton").click(function() { 
    console.log(this.value);
    alert('sd');
         $.ajax(
         {
         url:'models/includes/fetchImpression.php',
         type:'POST',
         data:'deleteRow='+ this.value,
         beforeSend:function(){
         console.log("woeking on");
         },
         success:function(e){
            if(confirm("Vous voulez supprimer")){
                window.location.href="impression";
            }
         }
     });
 });
 $('table').on('click','.deleteButton',function(){;
    var currentRow = $(this).closest("tr");
    var deleteRow = currentRow.find(".checkitem")[0].value
    $.ajax(
    {
         url:'models/includes/fetchImpression.php',
         type:'POST',
         data:{
            'deleteRow': deleteRow,
        },
         beforeSend:function(){
         console.log("woeking on");
         },
         success:function(e){
            if(confirm("Vous voulez supprimer")){
                window.location.href="impression";
            }
         }
    });
 });


 $('table').on('change','.td-input',function(){
    var colName = this.name;
    var value = this.value;
    var currentRow = $(this).closest("tr");
    var nFact = currentRow.find(".checkitem")[0].value;

      $.ajax(
          {
          url:'models/includes/fetchImpression.php',
          type:'POST',
          data:{
              'numeroFacture': nFact,
              'editCol':colName,
              'editValue':value,
          },
          beforeSend:function(){
          console.log("woeking on");
          },
          success:function(e){

                  window.location.href="impression";

          }
      });
})