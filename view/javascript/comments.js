function loadComments(){
	setInterval(function(){

		$('.comments').each(function(){

			var id = $(this).attr('id').split("_");
			var bet_id = id[0];
			var saloon_id = id[1];


			$.ajax({type: "POST",
	            url: "../../controller/get_comments.controller.php",
	            data: { 'bet_id': bet_id, 'saloon_id': saloon_id },
	            success: function(text){
	                
	                text = text.split("|");
	            	$('#' + id[0] + "_" + id[1]).html(text[0]);
	            	$('#badge_' + id[0] + '_' + id[1]).html(text[1]);

	            },
	        });

		});

	}, 5000); // Charge toutes les 5 secondes

}

loadComments();

function saveComment(e){

	var id = e.attr('id').split("_");
	var bet_id = id[1];
	var saloon_id = id[2];

	var comment = $('#comment_' + bet_id + '_' + saloon_id).val();

	$.ajax({type: "POST",
	            url: "../../controller/add_comment.controller.php",
	            data: { 'bet_id': bet_id, 'saloon_id': saloon_id, 'comment': comment },
	            success: function(text){
	            	text = text.split("|");
	                
	            	$('#' + id[1] + '_' + id[2]).html(text[0]);
	            	$('#badge_' + bet_id + '_' + saloon_id).html(text[1]);
	            	$('#comment_' + bet_id + '_' + saloon_id).val('');

	            },
	  });

}

$('.comment_form').click(function(){

    	saveComment($(this));

});

$('.comment_input').keydown(function(e){ 
    var code = e.which; // recommended to use e.which, it's normalized across browsers

    if(code==13){
    	saveComment($(this));
    	
    }
});