
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

/* mini popup sans rideau */

function MiniHelpBoxHandle(id){
  if(document.getElementById(id).style.display!='block'){
    document.getElementById(id).style.display = 'block';
  }else{
    $("#" + id).fadeOut(200);
    document.getElementById(id).style.display = 'none';
  }
}

function MiniHelpBox(html_id){

  var id = html_id;
  MiniHelpBoxHandle(id);
  setTimeout(function(){ MiniHelpBoxHandle(id); }, 3500);
  

}



/*MENU TOGGLE SCRIPT*/
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
