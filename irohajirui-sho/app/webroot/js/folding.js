function folding(inputData) {
	var objID = document.getElementById("layer_" + inputData);
	var buttonID = document.getElementById("category_" + inputData);
	if(objID.className == 'close') {
		objID.style.display = 'block';
		objID.className = 'open';
	}else{
		objID.style.display = 'none';
		objID.className = 'close';
	}
}
