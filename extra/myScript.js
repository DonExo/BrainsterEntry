$(document).ready(function(){

	$('input').attr('autocomplete','off');

	$('.rbtn').click(function(){
		var val = $(this).attr('alt');
		$('#ex').text(val);	
	});

	$('#wrapper p').css({'display':'block', 'clear':'both', 'float':'right', 'margin-right':'20px'});


	/*$('form').submit(function(){
		var res = true;

		if($('#birthYear').val() < 1950 || $('#birthYear').val() > 2015 )
			res = false;

		if($('#password').val() != $('#passwordConfirm').val()){
			res = false;
			alert('Password missmatch!');
		}

		$("input").each(function(){
			if( $(this).val().trim() == "" ){
				$(this).next().show();
				res = false;
			}else
				$(this).next().hide();
		});
		if(!res) alert('Client-side verification failed!');
		return res;
	});

	*/


});