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
    if($('#place_form').length > 0)
    {
      $('#place_form').formValidation({
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
            type: {
              validators: {
                  notEmpty: {
                      message: 'The type is required'
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
          document.place_form.submit();
      });
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

function importInstitutions()
{
  if($("#inputType").val() == "" || $("#inputLocation").val() == "")
  {
    $("#institutionError").show();
    $("#institutionError").html("<span class='text-red'>Type and Location are required.</span>");
    setTimeout(function(){$("#institutionError").hide('slow')}, 5000);
    return false;
  }
  window.location.href = LIVE_SITE+"/admin/places/import_institutions?type="+$("#inputType").val()+"&location="+$("#inputLocation").val();
}

function import_restaurants()
{
  if($("#inputRestType").val() == "" || $("#inputRestLocation").val() == "")
  {
    $("#restError").show();
    $("#restError").html("<span class='text-red'>Type and Location are required.</span>");
    setTimeout(function(){$("#restError").hide('slow')}, 5000);
    return false;
  }
  window.location.href = LIVE_SITE+"/admin/places/import_restaurants?type="+$("#inputRestType").val()+"&near="+$("#inputRestLocation").val();
}

function import_companies()
{
  if($("#inputCompanyLocation").val() == "")
  {
    $("#companyError").show();
    $("#companyError").html("<span class='text-red'>Location is required.</span>");
    setTimeout(function(){$("#companyError").hide('slow')}, 5000);
    return false;
  }
  window.location.href = LIVE_SITE+"/admin/places/import_companies?location="+$("#inputCompanyLocation").val();
}