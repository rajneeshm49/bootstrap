/*--- Developer JS ---*/

$(function() {
	var myforms = $(".content-wrapper .content .box-body form");
	myforms.each(function(i) {
		var myform = myforms.eq(i);
		var myfields = $("input,select,textarea", myform); 
		myfields.each(function(i) {
			var myfield = myfields.eq(i);
			myfield.addClass("form-control");
		});
	});
});

//~ $(document).ready(function(){ alert($('form').find(':input').attr('name'));
	//~ $('.content-wrapper .content form').find(':input,:radio,:checkbox,:textarea,:select').addClass('form-control');
//~ });
