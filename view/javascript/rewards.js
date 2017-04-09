$(".plus").click(function(e){

	var id = $(this).val();

	$.ajax({type: "POST",
            url: "../../controller/add_rewards.controller.php",
            data: { reward_id: id, action: 'plus' },
            success: function(text){
            	$("#quantity_" + id).html(text);
            },
        });

});

$(".minus").click(function(e){

	var id = $(this).val();

	$.ajax({type: "POST",
            url: "../../controller/add_rewards.controller.php",
            data: { reward_id: id, action: 'minus' },
            success: function(text){
            	$("#quantity_" + id).html(text);
            },
        });

});