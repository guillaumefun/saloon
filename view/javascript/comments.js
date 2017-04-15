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
	                
	            	$('#' + id[0] + "_" + id[1]).html(text);

	            },
	        });

		});

	}, 5000);

}

loadComments();