$(".plus").click(function(e){

	var id = $(this).val();

	$.ajax({type: "POST",
            url: "../../controller/add_rewards.controller.php",
            data: { reward_id: id, action: 'plus' },
            success: function(text){
            	text = text.split('|');
                $("#quantity_" + id).html(text[0]);
                $("#quantity_" + id).attr("title",text[1])
                                    .tooltip('fixTitle');
            },
        });

});

$(".minus").click(function(e){

	var id = $(this).val();

	$.ajax({type: "POST",
            url: "../../controller/add_rewards.controller.php",
            data: { reward_id: id, action: 'minus' },
            success: function(text){
                text = text.split('|');
                $("#quantity_" + id).attr("title" ,text[1])
                                    .tooltip('fixTitle');
            	$("#quantity_" + id).html(text[0]);


            },
        });

});


function loadRewards(){
    setInterval(function(){

        $('.rewards').each(function(){

            var id = $(this).attr('id').split("_");
            var reward_id = id[1];


            $.ajax({type: "POST",
                url: "../../controller/get_rewards.controller.php",
                data: { 'reward_id': reward_id },
                success: function(text){
                    
                    text = text.split('|');
                    $("#quantity_" + reward_id).attr("title" ,text[1])
                                        .tooltip('fixTitle');
                    $("#quantity_" + reward_id).html(text[0]);

                },
            });

        });

    }, 5000);

}

loadRewards();