function AddSupportContent(element) {
    var tbody = document.getElementById('tbody');
    var tr = document.createElement('tr');

    var id = document.createElement('th');
    var dateInjection = document.createElement('th');
    var dateDerniereModification = document.createElement('th');
    var codeBaps = document.createElement('th');
    var codeRayhane = document.createElement('th');
    var editer = document.createElement('th');

    editer.classList.add("border-left");
    editer.id = "download";

    var a1 = document.createElement('a');
    var nomFichier = element['emplacement'].replace("uploads/integrationPdf/", "");
    a1.setAttribute('download', nomFichier);
    a1.href = base_url + element['emplacement'];
    a1.classList.add('download');
    a1.id = element['id'];

    var i1 = document.createElement('i');

    i1.className = 'fas fa-download';
    a1.appendChild(i1);
    editer.appendChild(a1);

    id.setAttribute('scope', 'row');
    id.innerHTML = element['id'];

    dateInjection.innerHTML = element['dateGeneration'];

    dateDerniereModification.innerHTML = element['derniereModification'];

    codeBaps.innerHTML = element['codeBaps'];

    codeRayhane.innerHTML = element['codeRayhane'];

    tr.appendChild(id);
    tr.appendChild(dateInjection);
    tr.appendChild(dateDerniereModification);
    tr.appendChild(codeBaps);
    tr.appendChild(codeRayhane);
    tr.appendChild(editer);

    tbody.appendChild(tr);
}

function addPdgToList(libelle) {
    var customSelect = document.getElementsByClassName('custom-select')[0];
    var option = document.createElement('option');
    option.value = libelle;
    option.innerHTML += libelle;
    customSelect.appendChild(option);
}

$(document).ready(function(){  
    $('#ChangeCoverPage').on('submit', function(e){  
         e.preventDefault();  
         if($('#typeSupportSelect').val() == '0')  
         {  
              alert("Veuillez sélectionnez une page de garde");  
         }  
         else  
         {  
            $.ajax({  
                  url:base_url + "AddPdg/ChangeCoverPage",    
                  method:"POST",  
                  data:new FormData(this),  
                  contentType: false,  
                  cache: false,  
                  processData:false,  
                  success:function(data)  
                  {  
                    console.log(data);
                    let response = JSON.parse(data);
                    if(response == "erreur"){
                      alert("Ce libelle est déja pris pour une page de garde");
                    }
                    else {
                      $('#AddNewPdg').modal('hide');
                      jQuery(function RefreshPageAdd($){
                        $('#AddNewPdg').on('hidden.bs.modal', function (e) {
                          location.reload();
                        });
                      });
                    }
                  }  
            });  
            }  
    });  
  });  


