jQuery(document).ready(function($){
    
    $('#post_submit').click(function(e){
    	e.preventDefault();
      $('#post_submit').attr('disabled', 'disabled');
      //show loading image
    	var post_id = $('#post_id').val();
    	$.ajax({
           type:'post',
           url: ajaxobject.ajaxurl,
           data:{
           	action: 'my_post',
           	post_id:post_id,
           	ajaxnonce: ajaxobject.ajaxnonce
           },
           success: function(data){
               //hide loading image
               $('#ajax_div .result').html(data);
               $('#post_submit').attr('disabled', false);

           },
           error: function(XMLHttpRequest, textStatus, errorThrown){

                    alert(errorThrown);
           }
    	});

    });
});
