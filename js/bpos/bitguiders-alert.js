$(document).ready(function(){
	
});

function successAlert(message){
	alert('#successAlert',message)
}
function infoAlert(message){
	alert('#infoAlert',message)
}
function warningAlert(message){
	alert('#warningAlert',message)
}
function errorAlert(message){
	alert('#errorAlert',message)
}

function alert(alertId,message){
	$(alertId).slideDown(5000);
	$(alertId).text(message);
	setTimeout(function(){$(alertId).slideUp(2000);},5000);
}