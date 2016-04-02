jQuery(document).ready(function($){
	$('#bish_form').submit(function(e){
		e.preventDefault();
		var post_id = $('#bish_input').val();
		$.ajax({
		           type:'post',
		           url: ajaxobject.ajaxurl,
		           data:{
		           	action: 'my_post',
		           	post_id:post_id,
		           	ajaxnonce: ajaxobject.ajaxnonce
		           },
		           success: function(data){
		               $('#result').html(data);
		           },
		           error: function(XMLHttpRequest, textStatus, errorThrown){
		
		                    alert(errorThrown);
		           }
		    	});

	});
});