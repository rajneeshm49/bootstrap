$(function() {
	if($("#example1").length > 0)
	{
    	$("#example1").DataTable({
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
        } ]
      });
  }
    if($('#event_form').length > 0)
    {
      $('#date_range').daterangepicker();
      $('#event_form').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
              validators: {
                  notEmpty: {
                      message: 'The name is required'
                  }
              }
            },
            address: {
              validators: {
                  notEmpty: {
                      message: 'The address is required'
                  }
              }
            },
            country_id: {
              validators: {
                  notEmpty: {
                      message: 'The country is required'
                  }
              }
            },
            state_id: {
              validators: {
                  notEmpty: {
                      message: 'The state is required'
                  }
              }
            },
            city_id: {
              validators: {
                  notEmpty: {
                      message: 'The city is required'
                  }
              }
            },
            latitude: {
              validators: {
                  notEmpty: {
                      message: 'The latitude is required'
                  }
              }
            },
            longitude: {
              validators: {
                  notEmpty: {
                      message: 'The longitude is required'
                  }
              }
            },
            events_category_id: {
              validators: {
                  notEmpty: {
                      message: 'The category is required'
                  }
              }
            },
            points: {
              validators: {
                  notEmpty: {
                      message: 'The points is required'
                  },
                  stringLength: {
                      max: 2,
                      message: 'The Points must not be more than 2 digits'
                  }
              }
            }
        }
      }).on('success.form.fv', function(e) {
          document.event_form.submit();
      });
      
      var options1 = {
          url: LIVE_SITE+'/admin/events/upload_img',
          file_holder: '#file_1',
          file_preview: '#file_preview_1',
          success: function( server_return, name, uploaded_file )
          {
              $("#event_form #img_div p").eq(0).remove();
              var oFReader = new FileReader();
              var _drop = $('#drop1');
              var image_name = name.split("/");
              _drop.after( $('<p />').html( 'File sent: <b>' + image_name[image_name.length - 1] + '</b>' ) );

              oFReader.readAsDataURL( uploaded_file );
              oFReader.onload = function (oFREvent)
              {
                  $( '#file_preview_1' ).animate({opacity: 0}, 'slow', function(){
                      // change the image source
                      $(this)
                          .attr('src', oFREvent.target.result).animate({opacity: 1}, 'fast')
                          .on('load', function()
                          {
                              _drop.find('.statusbar').css({
                                  width: _drop.outerWidth(),
                                  height: _drop.outerHeight()
                              });
                          });

                      // remove the alert block whenever it exists.
                      _drop.find('.statusbar.alert-block').fadeOut('slow', function(){ $(this).remove(); });
                  });
              };
              $("#image_url").val(name);
          }
      };
      $('#drop1').droparea(options1);
    }

});
function getStates()
{
	var country_id = $("#inputCountry").val();
	$.ajax({
        "dataType" : 'json', 
        "type" : "GET",
        "data" :{'country': country_id},
        "url" : LIVE_SITE+"/admin/places/getstates",
        "success" : function(retData)
        {
        	$("#inputState").html("<option value=''>Please Select</option>");
        	var option = '';
        	for(var i in retData)
        	{
        		$("#inputState").append("<option value='"+retData[i].id+"'>"+retData[i].name+"</option>");
        	}
        	$("#inputCity").val("");
        }
    });
}

function getCities()
{
	var state_id = $("#inputState").val();
	$.ajax({
        "dataType" : 'json', 
        "type" : "GET",
        "data" :{'state': state_id},
        "url" : LIVE_SITE+"/admin/places/getcities",
        "success" : function(retData)
        {
        	$("#inputCity").html("<option value=''>Please Select</option>");
        	var option = '';
        	for(var i in retData)
        	{
        		$("#inputCity").append("<option value='"+retData[i].id+"'>"+retData[i].name+"</option>");
        	}
        }
    });
}

function getLocation()
{
   $.ajax({
        "dataType" : 'json', 
        "type" : "GET",
        "data" :{'address': $("#inputAddress").val()},
        "url" : LIVE_SITE+"/admin/events/get_location",
        "success" : function(retData)
        {
          $("#inputLatitude").val(retData.latitude);
          $("#inputLongitude").val(retData.longitude);
        }
    });
}