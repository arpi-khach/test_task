$(document).ready(function(){
    $(".btn-default").click(function(){
        $(this).toggleClass("btn-success");
    });
    $("#ok").click(function(){
        var id_array=[];
        $('.btn-success').each(function(){
           var id=$(this).attr('id');
           id_array.push(id);
        });
       
        
        $.ajax({
			type:"post",
                        dataType:"json",
			url:location.pathname,
			data:{ajax_id:id_array},
			success:function(){
				$.each(id_array, function(i, val) {
                                    $( '#' + val ).addClass('btn-danger'); 
                                });
					
				}

				});
				
				
				
				
			
			
		})
        
    })

