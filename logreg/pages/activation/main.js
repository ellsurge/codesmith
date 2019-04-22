$(function(){
	var floatingTextInputs = document.querySelectorAll('.input-group');
	for(var i = 0; i < floatingTextInputs.length; i++){
		var inp = floatingTextInputs[i].querySelector('input');
		if(inp.value != ""){
			floatingTextInputs[i].parentNode.querySelector('label').classList = "active";
			floatingTextInputs[i].parentNode.querySelector('.indicator').classList = "indicator active";
		}
		inp.onfocus = function(){
			this.parentNode.querySelector('label').classList = "active";
			this.parentNode.querySelector('.indicator').classList = "indicator active";
		}
		inp.onblur = function(){
			if(this.value.trim() == ""){
				this.parentNode.querySelector('label').classList = "";
			}
			this.parentNode.querySelector('.indicator').classList = "indicator";
		}
	}
	function validate(el){
		if(el.val().trim() == ""){
			el.parent().addClass('invalid');
			el.parent().find('.msg').html('this field is required');
		}else{
			var illegalChars = /^[0-9]+$/;
			if(!illegalChars.test(el.val().trim())){
				el.parent().addClass('invalid');
				el.parent().find('.msg').html('only use numbers');
			}else if(el.val().trim().length < 8){
				el.parent().addClass('invalid');
				el.parent().find('.msg').html('activation code have to be 8 characters');
			}else{
				el.parent().removeClass('invalid');
			    el.parent().find('.msg').html('');
			}
		}
	}
	$(".input-group input.validate").focusout(function(){
		validate($(this));
	});
	$(".input-group input.validate").keyup(function(e){
		validate($(this));
	});
	
	
	$("form").submit(function(e){
		e.preventDefault();
		$(this).find('.err-msg').html('precessing ...');
		var errc = $(this).find('.err-msg');
         $.ajax({
        	url: "../../server/funcs/activation/activate.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			    if(data == "authed"){
					$("input").val("");
					$(".msg").html("");
					$(".input-group").removeClass('invalid');
					$(".indicator"). removeClass('active');
					$("input"). removeClass('active');
					errc.html('');
				    window.location = "../../index.php";
			    }else{
			        errc.html(data);
			    }
		    },
		  	error: function(){} 	        
	      });
	});
	
});