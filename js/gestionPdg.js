

function addPdfLogo(libelle) {
    var container = document.getElementsByClassName('container-fluid vertical-align')[0];
  
    var div1 = document.createElement("div");
    div1.className = 'pdf';
    var div2 = document.createElement("div");
    div2.className="logo";


    var a = document.createElement("a");
    a.setAttribute("href", "#viewPageDeGarde");
    a.setAttribute("data-toggle", "modal");
    a.setAttribute("onclick", "createPdfView(this);");
    a.id = libelle;
    var i1 = document.createElement("i");
    i1.className = 'fas fa-file-pdf fa-9x';
    a.appendChild(i1);
    div2.appendChild(a);
  
    div3 = document.createElement('div');
    div3.className="libelle";
    div2.appendChild(div3);
  
    var a = document.createElement("a");
    a.setAttribute("href", "#SettingsPageDeGarde");
    a.setAttribute("data-toggle", "modal");
    a.setAttribute("onclick", "AddTitleSettings(this);");
    a.className = "settings";
    a.id = libelle;

    var i2 = document.createElement("i");
    i2.className='fas fa-cog';
    a.appendChild(i2);
    
    div1.appendChild(div2);
    div1.appendChild(a);
  
    container.appendChild(div1);
  
    div3.innerHTML += libelle;
}

function AddTitleSettings(htmlElement){
  var modalTile = document.getElementById('ModalCenterTitleSettings');
  modalTile.innerHTML = htmlElement.id;
}

function createPdfView(htmlElement){
  $.ajax({
    type: "POST",
    url: base_url + "upload/LoadPdfPage/"+htmlElement.id,
    dataType: "JSON",
    success: function (data) {
      AddIframeToModal(data, htmlElement.id);
    },
    error: function(){
    console.log('erreur');
    }
  });
}

function AddIframeToModal($emplacement, libelle){

  var modal = document.getElementById('modal');

  var modaltile = document.getElementById('ModalCenterTitlePdf');
  modaltile.innerHTML = libelle;

  var iframe = document.createElement('iframe');
  iframe.className = "embed-responsive-item";
  iframe.setAttribute("src", base_url + $emplacement);

  modal.appendChild(iframe);
}

function DeletePage() {
  var modalTile = document.getElementById('ModalCenterTitleSettings');
  title = modalTile.innerHTML;
    $.ajax({
    type: "POST",
    url: base_url + "upload/supprimerPdg/"+title,
    success: function (response) {
      $('#SettingsPageDeGarde').modal('hide')

    },
    error: function(){
      alert("Erreur");
    }
  });
}

jQuery(function RefreshPageSettings($){
  $('#SettingsPageDeGarde').on('hidden.bs.modal', function (e) {
    location.reload();
  });
});

$(document).ready(function(){  
  $('#AddPdgForm').on('submit', function(e){  
       e.preventDefault();  
       if($('#file').val() == '' && $("#libellePdg").val() == '')  
       {  
            alert("Erreur dans le formulaire");  
       }  
       else  
       {  
         if($("#libellePdg").val() == '') {
           alert("Veuillez inscrire un libelle");
         }
         else {
          if($('#file').val() == '') {
            alert("Veuillez choisir un fichier");
          }
          else {
          $.ajax({  
                url:base_url + "AddPdg/AddNewPageDeGarde",    
                method:"POST",  
                data:new FormData(this),  
                contentType: false,  
                cache: false,  
                processData:false,  
                success:function(data)  
                {  
                $('#AddNewPdg').modal('hide');
                jQuery(function RefreshPageAdd($){
                  $('#AddNewPdg').on('hidden.bs.modal', function (e) {
                    location.reload();
                  });
                  // var libelle = document.getElementsByName
                });
                }  
          });  
          }  
        }
      }
  });  
});  

jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 450) {
      $('#libellePdg').addClass('mb-2');
    } else if (ww >= 401) {
      $('#libellePdg').removeClass('mb-2');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  alterClass();
});

  if(window.innerWidth > 767){
    console.log(window.innerWidth)
      $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').addClass("selected").html(fileName.substr(0,11)); 
      });
  }
  else {
    $('.custom-file-input').on('change', function() { 
      let fileName = $(this).val().split('\\').pop(); 
      $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
  }

  $(window).resize(function(){
    if(window.innerWidth > 767){
      console.log(window.innerWidth)
        $('.custom-file-input').on('change', function() { 
          let fileName = $(this).val().split('\\').pop(); 
          $(this).next('.custom-file-label').addClass("selected").html(fileName.substr(0,10)); 
        });
    }
    else {
      $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').addClass("selected").html(fileName); 
      });
    }
  })



