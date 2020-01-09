var compt = 1;
    function createNewElement() {
    // First create a DIV element.
	var txtNewInputBox = document.createElement('div');
        
        
    // Then add the content (a new input box) of the element.
	txtNewInputBox.innerHTML = "<input type='text' name='newInputBox[]' value='Titre du chapitre'>";
        
        var texte = 'Titre du chapitre ' + compt;
    // Finally put it where it is supposed to appear.
    document.getElementById("newElementId").innerHTML += texte;
	document.getElementById("newElementId").appendChild(txtNewInputBox);
        
        compt++;
        
    }  