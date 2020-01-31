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
    a.setAttribute("onclick", "createPdfView(this);");

    var i2 = document.createElement("i");
    i2.className='fas fa-cog';
    a.appendChild(i2);
    
    div1.appendChild(div2);
    div1.appendChild(a);
  
    container.appendChild(div1);
  
    div3.innerHTML += libelle;
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

  var modaltile = document.getElementById('ModalCenterTitle');
  modaltile.innerHTML = libelle;

  var iframe = document.createElement('iframe');
  iframe.className = "embed-responsive-item";
  iframe.setAttribute("src", base_url + $emplacement);

  modal.appendChild(iframe);
}

