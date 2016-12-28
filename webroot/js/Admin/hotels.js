$(function () {
	$("#example1").DataTable();
	//var url = LIVE_SITE+'/admin/hotels/upload_hotels';
    $('#fileupload').fileupload({
        //url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
                $.ajax({
                    "dataType" : 'json', 
                    "type" : "POST",
                    "data" : {"file-data":file, "panel": "Hotels"},
                    "url" : LIVE_SITE+"/admin/hotels/readuploadedfile",
                    "success" : function(retData)
                    {
                    	if(retData.msg)
                    	{
                    		$("#bulkNotify").html("<div role='alert' class='alert alert-danger alert-dismissible'>"+
                                "<button data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span>"+
                                "<span class='sr-only'>Close</span></button><strong>Error! </strong>"+retData.msg+"</div>");
                    	}else{
                    		saveBulkHotels(retData.response);
                    	}
                    }
                });
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

function saveBulkHotels(data)
{
    $.ajax({
        "dataType" : 'json', 
        "type" : "POST",
        "data" :{'data': data},
        "url" : LIVE_SITE+"/admin/hotels/savebulkhotels",
        "success" : function(retData)
        {
            if(retData.success && retData.response.existHotels.length == 0  && retData.response.errRecords.length == 0)
            {
                window.location.reload(true);
            }else{
                $("#bulkNotify").html("<div role='alert' class='alert alert-danger alert-dismissible'>"+
                                "<button data-dismiss='alert' class='close' type='button'><span aria-hidden='true'>×</span>"+
                                "<span class='sr-only'>Close</span></button><strong>Error! </strong>An error occurred. Please try again.</div>");
                var errHtml = '';
                if(retData.response.errRecords.length > 0)
                {
	                errHtml += '<p>Data of following row numbers in excel sheet is/are not saved due to some validation issues.</p>';
	                errHtml += "<ul>";
	                for(var i in retData.response.errRecords)
	                {
	                	errHtml += "<li>"+retData.response.errRecords[i]+"</li>";
	                }
	                errHtml += "</ul>";
	            }
                if(retData.response.existHotels.length > 0)
                {
	                errHtml += '<p>Following hotels already exist in database.</p>';
	                errHtml += "<ul>";
	                for(var i in retData.response.existHotels)
	                {
	                	errHtml += "<li>"+retData.response.existHotels[i]+"</li>";
	                }
	                errHtml += "</ul>";
	            }
                $("#bulkNotify").append(errHtml);
            }
        }
    });
}