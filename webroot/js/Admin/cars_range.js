$(function () {
	$("#example1").DataTable();
});

function getRanges()
{
	$.post( LIVE_SITE+"/admin/cars_range/get",
		function( data ) {
			$("#example1").DataTable().destroy();
			data = JSON.parse(data);
			var html = '';
			for(var i in data)
			{
				var random = stringGen(22);
				html += "<tr><td>"+
				"<input type='checkbox' data-action='manageCarsRange-action' class='manageCarsRange-checkbox changeAction' value='"+data[i].id+"'>"+
				"</td><td>"+data[i].start_price+"</td><td>"+data[i].end_price+"</td><td>"+data[i].points+"</td>"+
				"<td class='actions'><a class='fa fa-pencil' href='"+LIVE_SITE+"/admin/cars_range/edit/"+data[i].id+"' data-toggle='modal' data-target='#addRangeModal' onclick='getRange(this)' rel='"+data[i].id+"'></a>"+
				"<form action='"+LIVE_SITE+"/admin/cars_range/delete/"+data[i].id+"' method='post' style='display:none;' name='post_"+random+"'>"+
				"<input type='hidden' value='POST' name='_method' class='form-control'></form><a onclick='if (confirm(&quot;Are you sure you want to delete # "+data[i].id+"?&quot;)) { document.post_"+random+".submit(); } event.returnValue = false; return false;' class='fa fa-times' href='#'></a></td></tr>";
			}
			$("#example1 tbody").html(html);
			$(".changeAction").bind("click", function() {
				var scope 		= $(this).attr('data-action');
				var CheckUncheckCallbacks 	= $.Callbacks( "unique" );
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
			$("#example1").DataTable();
	});	
}

function getRange(ele)
{
	$.get( LIVE_SITE+"/admin/cars_range/edit",
		{id:$(ele).attr('rel')},
		function( data ) {
			data = JSON.parse(data);
			$('#addRangeModal').modal('show');
			$('#inputId').val(data.id);
			$('#inputStartPrice').val(data.start_price);
			$('#inputEndPrice').val(data.end_price);
			$('#inputPoints').val(data.points);
		}
	);
}

function saveRange()
{
	var requiredFields = ['inputStartPrice', 'inputEndPrice', 'inputPoints'];
	for(var i in requiredFields)
	{
		if($("#cars_range-form #"+requiredFields[i]).val() == '')
		{
			$("#rangeError").show();
			$("#rangeError").html("<span class='text-red'>Please enter a valid value in the "+$("#cars_range-form #"+requiredFields[i]).attr('rel')+" field.</span>");
			setTimeout(function(){$("#rangeError").hide('slow')}, 5000);
			return false;
		}
	}
	$.ajax({
        "dataType" : 'json', 
        "type" : "POST",
        "data" :$("#cars_range-form").serialize(),
        "url" : LIVE_SITE+"/admin/cars_range/add",
        "success" : function(retData)
        {
			if(retData.success)
			{	
				$("#addRangeModal").modal('hide');
				getRanges();
			}else{
				$("#rangeError").show();
				$("#rangeError").html("<span class='text-red'>"+retData.response+"</span>");
				setTimeout(function(){$("#rangeError").hide('slow')}, 5000);
			}
        }
    });
}