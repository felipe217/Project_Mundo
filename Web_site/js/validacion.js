//funciones de validacion 
function noVacio(valor){
	var isCorrect = /^[A-Za-z\'\s\.\,]+$/.test(valor);
	return isCorrect;
} 

function esFecha(valor ){
	var correcto = /^\d{4}-\d{2}-\d{2}$/.test(valor);
	return correcto;
}

function esCorreo(valor){
	var isCorrect = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(valor);
	return isCorrect;
}

function esTelefono(valor){
	var isCorrect = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(valor);
	return isCorrect;
}