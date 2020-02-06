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

function addPdgToList(libelle) {
  var customSelect = document.getElementsByClassName('custom-select')[0];
  var option = document.createElement('option');
  option.value = libelle;
  option.innerHTML += libelle;
  customSelect.appendChild(option);
}

var pageDeGardeList = document.getElementById('pdgSelect');
pageDeGardeList.addEventListener("change", function(){
  var typeSupporList = document.getElementById('typeSupportSelect');
  typeSupporList.removeAttribute("disabled");
});

function ActivateCodeRayhaneInput(){
  var codeRayhaneInput = document.getElementById('codeRayhane');
  codeRayhaneInput.removeAttribute("disabled");
}

window.addEventListener('load', (event)=> {
  var support = document.getElementById('typeSupportSelect');
  support.setAttribute('disabled', "");
  var codeBapsInput = document.getElementById('codeBaps');
  codeBapsInput.value = "";
  var libelleCoursInput = document.getElementById('libelleCours');
  libelleCoursInput.value = "";
  var codeRayhaneInput = document.getElementById('codeRayhane');
  codeRayhaneInput.setAttribute("disabled", "");
})

window.addEventListener("keypress", function(event){
  if(event.key == "Enter") {
    var submit = document.getElementById('submit');
    submit.click();
  }
});

