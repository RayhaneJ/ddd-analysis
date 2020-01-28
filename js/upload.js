$('.custom-file-input').on('change', function() { 
  let fileName = $(this).val().split('\\').pop(); 
  $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});



// var selectVersion = document.getElementById('pdgSelect');

// selectVersion.addEventListener("change", function() {
//   var selectAttribute = selectVersion.options[selectVersion.selectedIndex].text;
//   var version = document.getElementById('versionSelect');
//   if(selectAttribute != 'Pages de garde') {
//     $.post(base_url + "views/upload_form", { func: "getNameAndTime" }, function( data ) {
//       console.log('bonjour' ); // John
//     }, "json");
//     version.removeAttribute('disabled');
//   }
// })


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
  option.innerHTML += libelle['libellePdg'];
  customSelect.appendChild(option);
}



