$(document).ready(function(){
	//show image loader
	$('loader').show();
	
	//show contacts on page load
	showContacts();
});

function showContacts() {
	console.log('showing...');
	setTimeout("$('#content').load('contacts.php',function(){$('loader').hide();})",1000);
}