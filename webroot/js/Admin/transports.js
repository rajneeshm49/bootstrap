$(document).ready(function() {
	if($("#example1").length > 0)
	{
		$("#example1").DataTable({
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
        } ]
      });
	}
});

function saveTransport()
{
	var requiredFields = ['inputName', 'inputPoints'];
	for(var i in requiredFields)
	{
		if($("#transport-form #"+requiredFields[i]).val() == '')
		{
			$("#transportError").show();
			$("#transportError").html("<span class='text-red'>Please enter a valid value in the "+$("#transport-form #"+requiredFields[i]).attr('rel')+" field.</span>");
			setTimeout(function(){$("#transportError").hide('slow')}, 5000);
			return false;
		}
	}
	$.post( LIVE_SITE+"/admin/transports/add", 
		{data:$("#transport-form").serialize()},
		function( data ) {
			data = JSON.parse(data);
			if(data.success)
			{	
				$("#addTransport").modal('hide');
				getTransports();
			}else{
				$("#transportError").show();
				$("#transportError").html("<span class='text-red'>"+data.response+"</span>");
				setTimeout(function(){$("#transportError").hide('slow')}, 5000);
			}
	});
}

function getTransport(ele)
{
	$.get( LIVE_SITE+"/admin/transports/edit",
		{id:$(ele).attr('rel')},
		function( data ) {
			data = JSON.parse(data);
			$('#addTransport').modal('show');
			$('#inputId').val(data.id);
			$('#inputName').val(data.name).attr('disabled', true);
			$('#inputPoints').val(data.points);
		}
	);
}

function getTransports()
{
	$.post( LIVE_SITE+"/admin/transports/get",
		function( data ) {
			$("#example1").DataTable().destroy();
			data = JSON.parse(data);
			var html = '';
			if(data.length > 0)
			{
				for(var i in data)
				{
					var random = stringGen(22);
					html += "<tr><td>"+
					"<input type='checkbox' data-action='manageTransports-action' class='manageTransports-checkbox changeAction' value='"+data[i].id+"'>"+
					"</td><td>"+data[i].name+"</td><td>"+data[i].points+"</td>"+
					"<td class='actions'><a class='fa fa-pencil' href='javascript:void(0)' data-toggle='modal' data-target='#addTransport' onclick='getTransport(this)' rel='"+data[i].id+"'></a>"+
					"<form action='"+LIVE_SITE+"/admin/transports/delete/"+data[i].id+"' method='post' style='display:none;' name='post_"+random+"'>"+
					"<input type='hidden' value='POST' name='_method' class='form-control'></form><a onclick='if (confirm(&quot;Are you sure you want to delete # "+data[i].id+"?&quot;)) { document.post_"+random+".submit(); } event.returnValue = false; return false;' class='fa fa-times' href='#'></a></td></tr>";
				}
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