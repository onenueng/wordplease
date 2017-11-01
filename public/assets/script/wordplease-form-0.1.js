// script for text generator
// 
// 

var choices = [];
function selectChoice(classChoice, idChoice){
 	$(classChoice).removeClass("active");
 	$(idChoice).addClass("active");
 	choices[classChoice] = $(idChoice).prop("textContent");
}

function genTemplat(className, maxChoice, inputID, genID){
	var genStr;
	var i;
	genStr = "";
	for (i = 1 ; i <= maxChoice ; i++) {
		console.log(className + i);
		var tmp = choices[className + i];
		if (typeof tmp != 'undefined') {
			genStr += tmp + ', '; 
		}
	}
	if (genStr != "") {
		genStr = genStr.substr(0, genStr.length-2);
		toggleTemplate(genID);
		$(inputID).val(genStr);
	}
}

function toggleTemplate(genID) {
	$(genID).collapse('toggle');
}