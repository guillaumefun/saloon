//fonction qui fait clignoter la barre de discussion quand il y a des nouveaux messages
function barFlash(){

    intID = setInterval(function(){

        if($('.chatbar').css('background-color') == "rgb(215, 229, 238)"){
            $('.chatbar').css('background-color' , "rgb(228, 236, 241)");
        }else{
            $('.chatbar').css('background-color' , "rgb(215, 229, 238)");
        }

    }, 1000);

}


// ferme le popup de discussion quand on clique sur le header de la fenetre
$(".chatbox-header").click(function(){

    $(".chatbox").attr("hidden", true);
    $(".chatbar").attr("hidden", false);

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

        $(document.body).removeClass('noscroll');

    }

});

// ouvre le popup de discussion quand on clique sur la barre de discussion
$(".chatbar").click(function(){

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

        $(document.body).addClass('noscroll');

    }

        $(".chatbox").attr("hidden", false);
        $(".chatbar").attr("hidden", true);

        if(typeof intID !== 'undefined'){
            clearInterval(intID); // arrête de faire clignoter la chatbar quand on clique dessus
            $('.chatbar').css('background-color' , "rgb(215, 229, 238)"); // remet à sa couleur normale
        }

        var objDiv = $('.chatbox-logs')[0];
        objDiv.scrollTop = objDiv.scrollHeight; // Pour que la partie qui s'affiche dans le popup soit les derniers messages ( sinon ça commence au dessus de la discussion et il faut scroller en bas )

})

// fonction qui charge les messages via ajax quand il y en a des nouveaux
function loadMessages(){
    setInterval(function(){

            var convers_id = $('.msg_input').attr('id');

            $.ajax({type: "POST",
                        url: "../../controller/get_messages.controller.php",
                        data: { 'convers_id': convers_id },
                        success: function(text){      

                            if(text != "-1"){  
                                text = text.split("<|aaa|>"); // un truc que personne risque de mettre dans une conversation

                                $('.chatbox-logs').append(text[0]);
                                $('.more_msg').attr('id', text[1]);
                                var sound = new Audio("../resources/sound/chat-sound.mp3");
                                sound.play();
                                if(!$(".chatbar").is( ":hidden" )){ // si la fenêtre de convers est fermée ( chatbar affichée du coup )
                                    barFlash(); // fait clignoter la bar de conversation
                                }
                            }
                        },
              });


       

    }, 500); // Charge toutes les demi secondes

}

function loadMoreMessages(){

    var convers_id = $('.msg_input').attr('id');
    var nb_msg = $('.more_msg').attr('id');

    if(typeof nb_msg !== 'undefined'){

        $.ajax({type: "POST",
                    url: "../../controller/load_more_messages.controller.php",
                    data: { 'convers_id': convers_id, 'nb_msg': nb_msg },
                    success: function(text){      

                            var objDiv = $('.chatbox-logs')[0];
                            height = $('.chatbox-logs').height();
                            $('.more_msg').remove();
                            $('.chatbox-logs').prepend(text); // ajoute avant tous les autres 
                            if(text != ''){
                                objDiv.scrollTop = height;
                            }
                        
                    },
          });

    }

}

loadMessages();

$('.chatbox-logs').scroll(function(){
    if($('.chatbox-logs')[0].scrollTop == 0){
        
        loadMoreMessages();
    }
});

// Fonction qui save un message dans la bdd via ajax
function saveMessage(e){

    var content = e.val();
    var convers_id = e.attr('id');

    $.ajax({type: "POST",
                url: "../../controller/add_message.controller.php",
                data: { 'content': content, 'convers_id': convers_id },
                success: function(text){                    
                    $('.chatbox-logs').html(text);
                    $('.msg_input').val('');
                },
      });

}

// lance la sauvegarde du message quand on appuie sur enter
$('.msg_input').keydown(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers

    if(code==13){
        saveMessage($(this));
        
    }
});

// lance la sauvegarde du message quand on appuie sur le bouton envoyer
$('.send-btn').click(function(e){ 
    saveMessage($('.msg_input'));
});
