$('.custom-file-input').on('change', function() { 
  let fileName = $(this).val().split('\\').pop(); 
  $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});

function erreurCodeBaps() {
  var input = document.getElementsByName('codeBaps')[0];
  input.classList.add('is-invalid');
  input.classList.remove('mb-3');

  var div = document.createElement('div');
  div.className = 'invalid-feedback'
  div.innerHTML = 'Code Baps manquant !';

  input.parentNode.insertBefore(div, input.nextSibling);
}

function erreurLibelleCours() {
  var input = document.getElementsByName('libelleCours')[0];
  input.classList.add('is-invalid');
  input.classList.remove('mb-3');

  var div = document.createElement('div');
  div.className = 'invalid-feedback';
  div.innerHTML = 'Libelle du cours manquant !';

  input.parentNode.insertBefore(div, input.nextSibling);

}

function MissingInputInView(numKey) {
  var input = document.getElementsByName('fichiers[]')[numKey];
  input.classList.add('is-invalid');

  var inputGroup = document.getElementsByClassName('custom-file')[numKey];
  inputGroup.classList.remove('mb-3');
  inputGroup.classList.add('mb-4');
  
  div = document.createElement('div');
  div.className = 'invalid-feedback';
  div.innerHTML = 'Fichiers manquant !';

  label = document.getElementsByClassName('custom-file-label')[numKey];
  
  input.parentElement.insertBefore(div, label.nextSibling);
}

function InputErrorInView(numKey) {
  var input = document.getElementsByName('fichiers[]')[numKey];
  input.classList.add('is-invalid');

  var inputGroup = document.getElementsByClassName('custom-file')[numKey];
  inputGroup.classList.remove('mb-3');
  inputGroup.classList.add('mb-4');
  
  div = document.createElement('div');
  div.className = 'invalid-feedback';
  div.innerHTML = 'Format du fichiers non autorisé !';

  label = document.getElementsByClassName('custom-file-label')[numKey];
  
  input.parentElement.insertBefore(div, label.nextSibling);
}

function addPdgToList(libelle, numLibelle) {
  var customSelect = document.getElementsByClassName('custom-select')[0];
  var option = document.createElement('option');
  option.value = numLibelle;
  option.innerHTML += libelle;
  customSelect.appendChild(option);
}

var selectedPdg = document.getElementById('pdgSelect');

selectedPdg.addEventListener("change", function() {

  var selectAttribute = selectedPdg.options[selectedPdg.selectedIndex].text;
  var version = document.getElementById('versionSelect');

  $('#versionSelect').find('option').not(':nth-child(1)').remove();

  if(selectAttribute != 'Pages de garde') {
    jQuery.ajax({
                type: "POST",
                url: base_url + "upload/AddItemToVersionList/" + selectAttribute,
                dataType: "JSON",
                success: function(data) {
                  addVersionToList(data);
                }
    });
    }
    else {
      version.setAttribute('disabled', "");
      var modele = document.getElementById('modeleSelect');
      modele.setAttribute('disabled', "");
      var support = document.getElementById('typeSupportSelect');
      support.setAttribute('disabled', "");
    }
});

var selectedVersion = document.getElementById('versionSelect');

selectedVersion.addEventListener("change", function() {
  var selectAttributePdg = selectedPdg.options[selectedPdg.selectedIndex].text;
  var selectAttributeVersion = selectedVersion.options[selectedVersion.selectedIndex].text;
  var selectAttributeVersion = selectAttributeVersion.replace(/Version /, "");
  var modele = document.getElementById('modeleSelect');
  var selectAttributeModele = modele.options[modele.selectedIndex].text;

  $('#modeleSelect').find('option').not(':nth-child(1)').remove();

  if(selectAttributeVersion != 'Version'){
  jQuery.ajax({
    type:"POST",
    url: base_url + "upload/AddItemToModeleList/" + selectAttributePdg + "/" + selectAttributeVersion,
    dataType : "JSON",
    success: function(data) {
      addModeleToList(data);
    }
  })
  }
  else {
    modele.setAttribute('disabled', "");
    var support = document.getElementById('typeSupportSelect');
    support.setAttribute('disabled', "")
  }
  
});

function addVersionToList(tableauVersion) {
  var version = document.getElementById('versionSelect');

  Array.from(tableauVersion).forEach(element => { 
      select = document.getElementById('versionSelect');
  option = document.createElement('option');
  option.innerHTML = 'Version ' + element;
  select.appendChild(option);
  });
  
  version.removeAttribute('disabled');
}

function addModeleToList(tableauVersion) {
  Array.from(tableauVersion).forEach(element => { 
  select = document.getElementById('modeleSelect');
  option = document.createElement('option');
  option.innerHTML = 'Modèle ' + element;
  select.appendChild(option);
  });
  var modele = document.getElementById('modeleSelect');
  modele.removeAttribute('disabled');

  var support = document.getElementById('typeSupportSelect');
  support.removeAttribute('disabled');
}


window.addEventListener('load', (event)=> {
  var version = document.getElementById('versionSelect');
  version.setAttribute('disabled', "");
})

window.addEventListener('load', (event)=> {
  var modele = document.getElementById('modeleSelect');
  modele.setAttribute('disabled', "");
  var support = document.getElementById('typeSupportSelect');
  support.setAttribute('disabled', "");
})






