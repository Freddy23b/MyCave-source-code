// **********************************
// *		APPARITION fenêtre	    *
// *			pop-up 				*
// **********************************

(function() {

	// On cible la fenêtre pop-up "in-pop-up" :
	var inPopUpDiv = document.querySelector("[data-js='js-in-pop-up']");
	// Débug :
	// console.log('test');
	// console.log(document.querySelector("[data-js='js-in-pop-up']"));

	// On définit la TRANSITION DE STYLE que subira cette div (paramètre hauteur ; paramètre durée) :
	inPopUpDiv.style.transition = 'height 0.35s';
	// Enfin on définit le height :
	inPopUpDiv.style.height = '270px';

})();