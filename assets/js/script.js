function doConvert (){
    let numberInput = document.querySelector('#montant').value ;
    let sommeLettres = document.querySelector('#somme');
    let montantLettres = document.querySelector('#montantLettres');


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
    montantLettres.value = outputText;
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
   
 
    $.ajax(
        {
        url:'models/includes/getBanque.php',
        type:'POST',
        data:'change='+ idSociete,
        success:function(data){
            let parseDate= JSON.parse(data);
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
    let icon = document.getElementById('iconBanque');

    //assets/img/BNP.xcf
   

    cp.innerHTML =data['cpBanque'];
    ville.innerHTML = data['villeBanque'];
    tel.innerHTML = data['telBanque'];
    adresse.innerHTML = data['adresseBanque'];
    icon.src="assets/img/"+data['courtNomBanque'];
    console.log( icon);
 }

 $('#factureForme').on('change','#numeroFacture',function(event){
    // console.log( $('#factureForme'));
    let numeroFacture = this.value;
    let errMesaage = document.getElementById("erreurMessageFacture");
    errMesaage.innerHTML="";
     $.ajax(
         {
            url:'models/includes/fetchFunctions.php',
         type:'POST',
         data:{
            'chackFacture': numeroFacture,
        },
         success:function(msg){
            if(msg !==""){
                alert("sdd")
                // console.log(event[preventDefault()]);
                  event.preventDefault();
                errMesaage.innerHTML = msg;
            }
      
         }
     });

});


//supprimer plusieurs d'un coup
$("#formImpression").on('click','#deleteManyImpressions',function(event){
    var cheeckItemss = $(".checkitem:checked");
    if(cheeckItemss.length == 0) {
        document.getElementById('changeMsgDiv').style.backgroundColor = "red";
        document.getElementById("changeMsg").innerHTML="choisissez au mois un row";
        document.getElementById('changeMsgDiv').style.display = "block";
        setTimeout(function() {$('#changeMsgDiv').fadeOut();}, 600);
    } else{
        let nFacturs = [];
        let searchValue = document.getElementById('search').value;
        for(j=0; j < cheeckItemss.length; j++){
            nFacturs[j] = cheeckItemss[j].value;
        }
        $.ajax(
             {
             url:'models/FatchImpressionManager.php',
             type:'POST',
             data:{
                'deleteCheckItems': nFacturs,
                'searchValue':((searchValue !="") ? searchValue : ""),
            },
             success:function(data){
                if(confirm("Vous voulez supprimer")){
                    let table = $("#tableImression");
                    table.html(data);
                }
             }
         });
    }
});

 $(".table").on('click','.deleteButton',function(){
    let searchValue = document.getElementById('search').value;
    let table = $(".table");  
    var currentRow = $(this).closest("tr");
    var deleteRow = currentRow.find(".row")[0].value;
 
      $.ajax(
      {
           url:'models/FatchImpressionManager.php',
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


 $('table').on('change','.td-input',function(){

    var self = this;
    var colName = this.name;
    var value = this.value;
    var currentRow = $(this).closest("tr");
    var nFact = currentRow.find(".checkitem")[0].value;
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
          url:'models/FatchImpressionManager.php',
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


$('.search').on('input',function(){
 

     $.ajax(
         {
        url:'models/FatchImpressionManager.php',
        type:'POST',
        data:'search='+ this.value,
        beforeSend:function(){
        console.log("woeking on");
        },
        success:function(data){
            let table = $("#tableImression");
            table.html(data);
      
         }
     });

     
 });


function load_data(page, query=''){
    $.ajax(
        {
       url:'models/includes/fetchImpression.php',
       type:'POST',
       data:{page:page, query:query},
       beforeSend:function(){
       console.log("woeking on");
       },
       success:function(data){
           let parseSocietes= JSON.parse(data);
           console.log(parseSocietes);
        }
    });
}


function printTrigger() {
    $.ajax(
        {
       url:'models/includes/test.php',
       type:'POST',
       data:'cheque',
       beforeSend:function(){
       console.log("woeking on");
       },
       success:function(data){
            html2pdf().from(data).toPdf().get('pdf').then(function (pdfObj) {
            // pdfObj has your jsPDF object in it, use it as you please!
            // For instance (untested):
            pdfObj.autoPrint();
          window.open( pdfObj.output('bloburl'), 'F');
        });
        }
    });
}

function test(){
    alert("sd");
    $.ajax(
        {
       url:'models/includes/test.php',
       type:'POST',
       data:'test',
       beforeSend:function(){
       console.log("woeking on");
       },
       success:function(data){
        html2pdf().from(data).toPdf().get('pdf').then(function (pdfObj) {
            // pdfObj has your jsPDF object in it, use it as you please!
            // For instance (untested):
            pdfObj.autoPrint();
           pdfObj.output('bloburl', 'F');
        });
        }
    });
}
function ff(){
  let y = document.getElementById('test10');
  console.log("sdd");
  console.log(y);
}