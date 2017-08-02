// ******************************
// *		APPARITION / 		*
// *	   DISPARITION du 		*
// *   bouton de confirmation 	*
// *	  de suppression 		*
// ******************************

// *************************************
// **** Seulement avec JAVASCRIPT : ****

(function() {

	// on définit une fonction (passée en variable) affichant la div de confirmation :
	var openConfirmDiv = function(){

		// on cible la div de confirmation et on la fait rentrer dans une variable utilisable avec JS (*) :
		// var confirmDiv = document.getElementById("js-confirm-div");// pour cibler avec l'id
		var confirmDiv = document.querySelector("[data-js='js-confirm-div']");// pour cibler avec un data-attribute
		// auparavant, pour s'assurer que l'on a bien ciblé notre élément, on aura pu faire :
		// console.log(document.querySelector("[data-js='js-confirm-div']"));

		// on cible le STYLE de cette div de confirmation pour faire notre condition if (effet "toggle") :
		const styleDiv = confirmDiv.ownerDocument.defaultView;
		const { height } = styleDiv.getComputedStyle(confirmDiv, null);	// on cible en particulier sa hauteur 

		// On définit la TRANSITION DE STYLE que subira cette div (paramètre hauteur ; paramètre durée) :
		confirmDiv.style.transition = 'height 0.35s';// restera à définir le "height" (ci-dessous)

		// grâce au height que l'on a ciblé plus haut dans une const :
		if (parseInt(height, 10) === 0) {// si la hauteur de la div est 0px
			// l'INSTRUCTION permettant d'afficher la div :
			confirmDiv.style.height = '55px';
		} else if (parseInt(height, 10) === 55) { // si elle est de 55px
			confirmDiv.style.height = '0px';
		}
	}

	// idem (*) mais avec le btn ouvrant la div de confirmation :
	// var btn = document.getElementById("js-btn");
	var btn = document.querySelector("[data-js='js-btn']");

	// au clic sur le btn, j'appelle la fonction :
	btn.onclick = openConfirmDiv;// (pas de () car aucune valeur de retour)
	// ou bien :
	// btn.addEventListener("click", openConfirmDiv);

})();



// ************************************
// ********** Avec JQUERY : ***********

// $(document).ready(function() {

// 	$('[data-js]').on('click', function() {
// 		$(this).next('[data-js]').slideToggle();
// 	});

// });
