function submitRegister(event){
	event.preventDefault();
	alert("Submitted");
	$('#user-register')
}
$(function(){
	$('#user-register').on('submit',function(e){
		e.preventDefault();
		alert("inside");
	})
})