/*FUCKING POP UP SCRIPT*/
	function HelpBox(id){
		if(document.getElementById(id).style.display!='block'){
			document.getElementById(id).style.display = 'block';
		}else{document.getElementById(id).style.display = 'none'}
		if(document.getElementById("rideau").style.display!='block'){
			document.getElementById("rideau").style.display = 'block';
		}else{document.getElementById("rideau").style.display = 'none'}
		ReHelpBox(id);
	}
	function ReHelpBox(id){
		rideau.addEventListener('click', function(){
			HelpBox(id);
		}) ;
	}

function startProject(){

	HelpBox('creerProjet');
	$('#project_name').focus();

}