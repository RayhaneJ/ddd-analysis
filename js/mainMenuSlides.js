function AddSlideContent(element){
    var tbody = document.getElementById('tbody');
    var tr = document.createElement('tr');

    var id = document.createElement('th');
    var dateInjection = document.createElement('th');
    var dateDerniereModification = document.createElement('th');
    var codeBaps = document.createElement('th');
    var codeRayhane = document.createElement('th');
    var editer = document.createElement('th');

    editer.classList.add("border-left");
    editer.id = "editer";

    var a1 = document.createElement('a');
    a1.href="#";
    var a2 = document.createElement('a');
    a2.href="#";
    var i1 = document.createElement('i');
    var i2 = document.createElement('i');
    i1.className  = 'fas fa-trash-alt';
    i2.className = 'fas fa-exchange-alt';

    a1.appendChild(i1);
    a2.appendChild(i2);

    editer.appendChild(a1);
    editer.appendChild(a2);

    id.setAttribute('scope', 'row');
    id.innerHTML = element['id'];


    dateInjection.innerHTML = element['dateInjection'];

    dateDerniereModification.innerHTML = element['dateDerniereModification'];

    codeBaps.innerHTML =  element['codeBaps'];

    codeRayhane.innerHTML = element['codeRayhane'];

    tr.appendChild(id);
    tr.appendChild(dateInjection);
    tr.appendChild(dateDerniereModification);
    tr.appendChild(codeBaps);
    tr.appendChild(codeRayhane);
    tr.appendChild(editer);

    tbody.appendChild(tr);
}