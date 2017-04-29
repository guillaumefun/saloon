$("#saloon_link_btn").click(function(){

	$("#saloon_link").select();

	msg = document.execCommand('copy');
	console.log('Copying text command was ' + msg);

});