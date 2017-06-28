$(".chatbox-header").click(function(){

    $(".chatbox").attr("hidden", true);
    $(".chatbar").attr("hidden", false);

});

$(".chatbar").click(function(){

    $(".chatbox").attr("hidden", false);
    $(".chatbar").attr("hidden", true);

})

function loadMessages(){
    setInterval(function(){

            var convers_id = $('.msg_input').attr('id');

            $.ajax({type: "POST",
                        url: "../../controller/get_messages.controller.php",
                        data: { 'convers_id': convers_id },
                        success: function(text){                    
                            $('.chatbox-logs').html(text);
                        },
              });


       

    }, 3000); // Charge toutes les 3 secondes

}

loadMessages();

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


$('.msg_input').keydown(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers

    if(code==13){
        saveMessage($(this));
        
    }
});


//  //this function can remove a array element.
// Array.remove = function(array, from, to) {
//     var rest = array.slice((to || from) + 1 || array.length);
//     array.length = from < 0 ? array.length + from : from;
//     return array.push.apply(array, rest);
// };

// //this variable represents the total number of popups can be displayed according to the viewport width
// var total_popups = 0;

// //arrays of popups ids
// var popups = [];

// //this is used to close a popup
// function close_popup(id)
// {
//     for(var iii = 0; iii < popups.length; iii++)
//     {
//         if(id == popups[iii])
//         {
//             Array.remove(popups, iii);
            
//             document.getElementById(id).style.display = "none";
            
//             calculate_popups();
            
//             return;
//         }
//     }   
// }

// //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
// function display_popups()
// {
//     var right = 220;
    
//     var iii = 0;
//     for(iii; iii < total_popups; iii++)
//     {
//         if(popups[iii] != undefined)
//         {
//             var element = document.getElementById(popups[iii]);
//             element.style.right = right + "px";
//             right = right + 320;
//             element.style.display = "block";
//         }
//     }
    
//     for(var jjj = iii; jjj < popups.length; jjj++)
//     {
//         var element = document.getElementById(popups[jjj]);
//         element.style.display = "none";
//     }
// }

// //creates markup for a new popup. Adds the id to popups array.
// function register_popup(id, name)
// {
    
//     for(var iii = 0; iii < popups.length; iii++)
//     {   
//         //already registered. Bring it to front.
//         if(id == popups[iii])
//         {
//             Array.remove(popups, iii);
        
//             popups.unshift(id);
            
//             calculate_popups();
            
            
//             return;
//         }
//     }               
    
//     var element = '<div class="popup-box chat-popup" id="'+ id +'">';
//     element = element + '<div class="popup-head">';
//     element = element + '<div class="popup-head-left">'+ name +'</div>';
//     element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
//     element = element + '<div style="clear: both"></div></div><div class="popup-messages"><div class="popup-textarea"><textarea></textarea></div></div></div>';
    
//     document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  

//     popups.unshift(id);
            
//     calculate_popups();
    
// }

// //calculate the total number of popups suitable and then populate the toatal_popups variable.
// function calculate_popups()
// {
//     var width = window.innerWidth;
//     if(width < 540)
//     {
//         total_popups = 0;
//     }
//     else
//     {
//         width = width - 200;
//         //320 is width of a single popup box
//         total_popups = parseInt(width/320);
//     }
    
//     display_popups();
    
// }

// //recalculate when window is loaded and also when window is resized.
// window.addEventListener("resize", calculate_popups);
// window.addEventListener("load", calculate_popups);