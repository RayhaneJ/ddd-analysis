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
  div.className = 'invalid-feedback'
  div.innerHTML = 'Libelle du cours manquant !';

  input.parentNode.insertBefore(div, input.nextSibling);

}