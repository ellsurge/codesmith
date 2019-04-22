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
			if(el.attr('validate') == "char"){
				var illegalChars = /^[0-9a-zA-Z_ ]+$/;
				if(!illegalChars.test(el.val())){
					el.parent().addClass('invalid');
					el.parent().find('.msg').html('only use 0-9 A-Z and _');
				}else if(el.val().trim().length < 3 || el.val().trim().length > 20){
					el.parent().addClass('invalid');
					el.parent().find('.msg').html('username should be 3 - 25 characters');
				}else{
					el.parent().removeClass('invalid');
					el.parent().find('.msg').html('');
				}
			}else if(el.attr('validate') == "email"){
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(!re.test(el.val().toLowerCase())){
					el.parent().addClass('invalid');
					el.parent().find('.msg').html('entered email is not valid');
				}else{
					el.parent().removeClass('invalid');
					el.parent().find('.msg').html('');
				}
			}else if(el.attr('validate') == "password"){
				if(el.val().trim().length < 8){
					el.parent().addClass('invalid');
					el.parent().find('.msg').html('password should contain minimum 8 characters');
				}else{
					el.parent().removeClass('invalid');
					el.parent().find('.msg').html('');
				}
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
	
	
	function toggleForm(f){ 
		$("form").slideUp(300);
		$(f).slideDown(300);
	}
	$(".logToggle").click(function(){ toggleForm(".loginForm"); });
	$(".regToggle").click(function(){ toggleForm(".registerForm"); });
	$(".forgotPwd").click(function(){ toggleForm(".recoverForm"); });
	
	
	$("form").submit(function(e){
		e.preventDefault();
		$(this).find('.err-msg').html('precessing ...');
		var errc = $(this).find('.err-msg');
        var dest = ($(this).attr("action") == "login.php")? "../../index.php" : "../activation/index.php?form="+$(this).attr("class");
         $.ajax({
        	url: "../../server/funcs/logreg/"+$(this).attr("action"),
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
				    window.location = dest;
			    }else{
			        errc.html(data);
			    }
		    },
		  	error: function(){} 	        
	      });
	});
	
});