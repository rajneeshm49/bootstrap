$(document).ready(function(){
	
	var CheckUncheckCallbacks 	= $.Callbacks( "unique" );
	var call_apply_filters		= function(){};
	var url      				= window.location.href;
	if(url.indexOf('/admin/') < 0){
		call_apply_filters = function(){ apply_filters() };
	}
	CheckUncheckCallbacks.add( call_apply_filters );
	

	$('.check-uncheck-all').on('click',function(){
		
		var dataControl = $(this).attr('data-control');
		var scope = $('.'+dataControl);
		if($(this).is(':checked')){
			scope.prop('checked',true);
			$('#'+dataControl+'-selectAll').show();
		}
		else {
			scope.prop('checked',false);
			$('#'+dataControl+'-selectAll').hide();
		}
		
	});

	$('.changeAction').on('click',function(event){
		
		var scope 		= $(this).attr('data-action');
		
		var unchecked 	= $('[data-action="'+scope+'"]:not(:checked)');
		if(unchecked.length){
			$('.check-uncheck-all[data-action="'+scope+'"]').prop('checked',false);
			var dataControl = $('.check-uncheck-all[data-action="'+scope+'"]').attr('data-control');
			var model = $('.check-uncheck-all[data-action="'+scope+'"]').attr('model');
			$('#'+dataControl+'-selectAll').hide();
			
			$('#'+model+'-allSelected').val('0');
			$('#manage'+model+'-checkbox-selectAll').hide();
			$('#manage'+model+'-checkbox-unselectAll').hide();
			
		}
		
		var checked 	= $('[data-action="'+scope+'"]:checked');
		if(checked.length){
			$('.'+scope).removeClass('disabled');
			$('.'+scope).attr('disabled',false);
		}
		else {
			$('.'+scope).addClass('disabled');
			$('.'+scope).attr('disabled',true);
		}
		
		CheckUncheckCallbacks.fire();
		
	});
	$(".toggle_btn").click(function(){
		$(".toggle_btn").toggle("fast");
	});
/**
 * Trimed the value of each text field for the module
 * Added By Manmeet Kaur on Jan 07,2015 	
 * */
	
	$('input[type=text]').on('blur',function(){
		$(this).val(($(this).val()).trim());	
	});
	$('.message.success').delay(5000).hide('highlight', {color: '#66cc66'}, 1500);
	$('.message.error').delay(5000).hide('highlight', {color: '#d9534f'}, 1500);
	
});

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re) && key.indexOf('[]') < 0) { // "&& key.indexOf('[]') < 0 " to set array type get parameters
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }

}

function getCheckboxValues(classs,callback){
	
	var checkboxes 	= $('.'+classs);
	var values		= new Array();
	$.each(checkboxes,function(key,value){
	
		if($(checkboxes[key]).is(':checked')){
			values.push($(checkboxes[key]).val());
		}
	});
	callback(values);
	
}

/* ==== auto-detect user location ==== */

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
		// alert("Geolocation is not supported by this browser.");
    }
}
//~ getLocation();

function showPosition(position) {
    //alert("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);
    
    $.post( LIVE_SITE+"/Gems/getLocation", 
	{latitude:position.coords.latitude,longitude:position.coords.longitude},
	function( data ) {
		if(data.length)
			$('#search-location').val(data);
	});
}

function successMsg(){
	$('.content-wrapper .content .message').remove();
	var txt = '<div class="message success">Record(s) has been deleted successfully</div>';
	$('.content-wrapper .content').prepend(txt);
	return txt;	
	
}
function refreshWindow(){
	setTimeout(function () {
		window.location.href = window.location.href 
	}, 1000);	
}


