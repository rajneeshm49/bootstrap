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

function addModel()
{
	$(".model-name-row input[type=text]").last().after($(".model-name-row input[type=text]").last().clone());
	$(".model-name-row input[type=text]").last().val("");
	$(".model-name-row .year_div a").last().after($(".model-name-row .year_div a").last().clone());
	$(".model-name-row .year_div a").last().html('Add Years');
	$(".model-name-row .year_div a").last().attr('onclick', 'addYearsModal(this)');
	$(".model-name-row .remove-year-div a").last().after($(".model-name-row .remove-year-div a").last().clone());
	$(".model-name-row .remove-year-div a").last().show();
}

function deleteModelRow(ele)
{
	$(".model-name-row input[type=text]").eq($(ele).prevAll('a:visible').length).remove();
	$(".model-name-row .year_div a").eq($(ele).prevAll('a:visible').length).remove();
	if($("#hiddenYears-"+$(ele).prevAll('a:visible').length).length > 0)
	{
		var splitYear = $("#hiddenYears-"+$(ele).prevAll('a:visible').length).val().split(',');
		if(splitYear.length > 1)
		{
			var j = 0;
			while(j < splitYear.length)
			{
				$("#hiddenStyles-"+parseInt($(ele).prevAll('a:visible').length + j)).remove();
				$("#hiddenStylesPoints-"+parseInt($(ele).prevAll('a:visible').length + j)).remove();
				j++;
			}
		}else{
			$("#hiddenStyles-"+$(ele).prevAll('a:visible').length).remove();
			$("#hiddenStylesPoints-"+$(ele).prevAll('a:visible').length).remove();
		}
	}
	$("#hiddenYears-"+$(ele).prevAll('a:visible').length).remove();
	// manage years here
	for(var i = $(ele).prevAll('a:visible').length + 1; i <= $("input[id*=hiddenYears]").length; i++)
	{
		if($("#hiddenYears-"+i).length > 0)
		{
			$("#hiddenYears-"+i).attr('name', 'hiddenYears['+parseInt(i - 1)+']').attr('id', 'hiddenYears-'+parseInt(i - 1));
		}else{
			break;
		}
	}
	// manage styles here
	if($("#style-wrapper").css("display") == "block")
	{
		for(var i = $(ele).prevAll('a:visible').length + 1; i <= $("input[id*=hiddenStylesPoints]").length + splitYear.length; i++)
		{
			if($("#hiddenStyles-"+i).length > 0)
			{
				$("#hiddenStyles-"+i).attr('name', 'hiddenStyles['+parseInt(i - splitYear.length)+']').attr('id', 'hiddenStyles-'+parseInt(i - splitYear.length));
				$("#hiddenStylesPoints-"+i).attr('name', 'hiddenStylesPoints['+parseInt(i - splitYear.length)+']').attr('id', 'hiddenStylesPoints-'+parseInt(i - splitYear.length));
			}
		}
		$("#style-table tbody").html("");
		var html = "";
		var row_counter = 0;
		for(var i=0; i < $("input[id*=hiddenYears]").length; i++)
		{
			var years = $("input[id=hiddenYears-"+i+"]").val().split(",");
			for(var j=0; j < years.length; j++)
			{
				html += "<tr class='model-year-row'><td>"+$('.model-name-row input[type=text]').eq(i).val()+"</td><td>"+years[j]+"</td>";
				if($("#hiddenStylesPoints-"+row_counter).length > 0 && $("#hiddenStylesPoints-"+row_counter).val() != "")
				{
					var edit_fxn = 'addStyleModal(this, "edit")';
					html += "<td><a href='javascript:void(0)' class='btn btn-default' data-toggle='modal' data-target='#style-modal' onclick='"+edit_fxn+"'>View Styles</a></td>";
				}else{
					html += "<td><a href='javascript:void(0)' class='btn btn-default' data-toggle='modal' data-target='#style-modal' onclick='addStyleModal(this)'>Add Styles</a></td>";
				}
				html += "</tr>";
				row_counter++;
			}
		}
		$("#style-table tbody").html(html);
	}
	// manage remove buttons
	if($(ele).prevAll('a:visible').length == 1)
	{
		$(".model-name-row .remove-year-div a").eq($(".model-name-row .remove-year-div a").length - 1).remove();
	}else{
		$(".model-name-row .remove-year-div a").eq($(ele).prevAll('a:visible').length - 1).remove();
	}
	//console.log($(ele).prevAll('a').length);
}

function saveCar()
{
	if($("#inputBrand").val() == "" || $(".model-name-row input:text").filter(function() { return this.value == ""; }).length > 0)
	{
		window.scrollTo(0,0);
		$("#err_msg").html("<div class='alert alert-danger alert-dismissable'>"+
			"<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+
			"<h4><i class='icon fa fa-ban'></i> Alert!</h4>Brand and Models are required.</div>");
		setTimeout(function() {
			$("#err_msg").html("");
		}, 5000);
		return false;	
	}

	if($("a:contains('Add Years')").length > 0)
	{
		window.scrollTo(0,0);
		$("#err_msg").html("<div class='alert alert-danger alert-dismissable'>"+
			"<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+
			"<h4><i class='icon fa fa-ban'></i> Alert!</h4>Please fill all years.</div>");
		setTimeout(function() {
			$("#err_msg").html("");
		}, 5000);
		return false;
	}
	$("#style-wrapper").show();
	$("#style-table tbody").html("");
	var html = "";
	var row_counter = 0;
	for(var i=0; i < $("input[id*=hiddenYears]").length; i++)
	{
		var years = $("input[id=hiddenYears-"+i+"]").val().split(",");
		for(var j=0; j < years.length; j++)
		{
			html += "<tr class='model-year-row'><td>"+$('.model-name-row input[type=text]').eq(i).val()+"</td><td>"+years[j]+"</td>";
			if($("#hiddenStylesPoints-"+row_counter).length > 0 && $("#hiddenStylesPoints-"+row_counter).val() != "")
			{
				var edit_fxn = 'addStyleModal(this, "edit")';
				html += "<td><a href='javascript:void(0)' class='btn btn-default' data-toggle='modal' data-target='#style-modal' onclick='"+edit_fxn+"'>View Styles</a></td>";
			}else{
				html += "<td><a href='javascript:void(0)' class='btn btn-default' data-toggle='modal' data-target='#style-modal' onclick='addStyleModal(this)'>Add Styles</a></td>";
			}
			html += "</tr>";
			row_counter++;
		}
	}
	$("#style-table tbody").html(html);
	if($("a:contains('Add Style')").length > 0)
	{
		window.scrollTo(0,0);
		$("#err_msg").html("<div class='alert alert-danger alert-dismissable'>"+
			"<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+
			"<h4><i class='icon fa fa-ban'></i> Alert!</h4>Please fill all styles.</div>");
		setTimeout(function() {
			$("#err_msg").html("");
		}, 5000);
		return false;
	}
	if($("#style-wrapper").css("display") == "block" && row_counter == $("input[id*=hiddenStylesPoints]").length)
	{
		$.ajax({
	        "dataType" : 'json', 
	        "type" : "POST",
	        "data" : $("#car-form").serialize(),
	        "url" : LIVE_SITE+"/admin/cars/save_car",
	        "success" : function(retData)
	        {
	        	if(retData.success)
	        	{
	        		window.location.href = LIVE_SITE+"/admin/cars";
	        	}
	        }
	    });
	}else{
		$("input[id*=hiddenStyles]").remove();
		$("input[id*=hiddenStylesPoints]").remove();
		$(".model-year-row a.btn").html('Add Styles');
		$(".model-year-row a.btn").attr('onclick', 'addStyleModal(this)');

	}	
}

// called on clicking Add Years or View Years button
function addYearsModal(ele, mode)
{
	$(".year-row input[type=text]").val('');
	$(".year-row input[type=text]").slice(1).remove();
	if(mode)
	{
		var selectedYears = $("#hiddenYears-"+$(ele).prevAll('a').length).val();
		selectedYears = selectedYears.split(",");
		$(".year-row").html('');
		for(var i in selectedYears)
		{
			$(".year-row").append("<input type='text' maxlength='4' placeholder='Year' class='form-control' name='years[]' value='"+selectedYears[i]+"' style='margin-bottom: 15px;'>");
		}
	}
	$("#row-count").val($(ele).prevAll('a').length);
}

// called on clicking plus icon in years modal
function addYear()
{
	$(".year-row input[type=text]").last().after($(".year-row input[type=text]").last().clone());
	$(".year-row input[type=text]").last().val("");
}

function saveYears()
{
	var yearArr = new Array();
	for(var i=0; i < $("#year-form input[type=text]").length; i++)
	{
		if($($("#year-form input[type=text]")[i]).val() != "")
		{
			yearArr.push($($("#year-form input[type=text]")[i]).val());
		}
	}
	if($("#hiddenYears-"+$("#row-count").val()).length == 0)
	{
		$(".model-name-row a").last().after("<input type='hidden' name='hiddenYears["+$("#row-count").val()+"]' id='hiddenYears-"+$("#row-count").val()+"' value='"+yearArr+"' />");
	}else{
		$("#hiddenYears-"+$("#row-count").val()).val(yearArr);
	}
	if(yearArr.length > 0)
	{
		$(".model-name-row a").eq($("#row-count").val()).html('View Years');
		$(".model-name-row a").eq($("#row-count").val()).attr('onclick', 'addYearsModal(this, \'edit\')');
	}else{
		$(".model-name-row a").eq($("#row-count").val()).html('Add Years');
		$(".model-name-row a").eq($("#row-count").val()).attr('onclick', 'addYearsModal(this)');
	}
	//$(".model-name-row input[type=text]").eq($("#row-count").val()).after("<p class='help-block'>"+yearArr+"</p>");
	$("#years-modal").modal('hide');
}

// called on clicking Add style or View style button
function addStyleModal(ele, mode)
{
	$(".style-row input[type=text]").val('');
	$(".style-row input[type=number]").val('');
	//$(".style-row").slice(1).remove();
	$(".style-row .form-group").slice(1).remove();
	if(mode)
	{
		var selectedStyles = $("#hiddenStyles-"+$(ele).parents('tr').prevAll('tr').length).val();
		selectedStyles = selectedStyles.split(",");
		var selectedStylePoints = $("#hiddenStylesPoints-"+$(ele).parents('tr').prevAll('tr').length).val();
		selectedStylePoints = selectedStylePoints.split(",");
		$(".style-row").html('');
		for(var i in selectedStyles)
		{
			$(".style-row").append("<div class='form-group'><label class='col-sm-2 control-label'>Name</label>"+
				"<div class='col-md-4'><input type='text' placeholder='Year' class='form-control' name='years[]' value='"+selectedStyles[i]+"'></div><label class='col-sm-2 control-label'>Points</label>"+
				"<div class='col-md-4'><input type='number' class='form-control' name='points[]' value='"+selectedStylePoints[i]+"'></div></div>");
		}
	}
	$("#row-count").val($(ele).parents('tr').prevAll('tr').length);
}

function addStyle()
{
	$(".style-row .form-group").last().after($(".style-row .form-group").last().clone());
	$(".style-row .form-group input[type=text]").last().val("");
	$(".style-row .form-group input[type=number]").last().val("");
}

function saveStyles()
{
	var styleArr = new Array();
	var pointsArr = new Array();
	for(var i=0; i < $("#style-form input[type=text]").length; i++)
	{
		if($($("#style-form input[type=text]")[i]).val() != "")
		{
			styleArr.push($($("#style-form input[type=text]")[i]).val());
			pointsArr.push($($("#style-form input[type=number]")[i]).val());
		}
	}
	if($("#hiddenStyles-"+$("#row-count").val()).length == 0)
	{
		$(".model-name-row a").last().after("<input type='hidden' name='hiddenStyles["+$("#row-count").val()+"]' id='hiddenStyles-"+$("#row-count").val()+"' value='"+styleArr+"' /><input type='hidden' name='hiddenStylesPoints["+$("#row-count").val()+"]' id='hiddenStylesPoints-"+$("#row-count").val()+"' value='"+pointsArr+"' />");
	}else{
		$("#hiddenStyles-"+$("#row-count").val()).val(styleArr);
		$("#hiddenStylesPoints-"+$("#row-count").val()).val(pointsArr);
	}
	if(styleArr.length > 0)
	{
		$(".model-year-row a").eq($("#row-count").val()).html('View Styles');
		$(".model-year-row a").eq($("#row-count").val()).attr('onclick', 'addStyleModal(this, \'edit\')');
	}else{
		$(".model-year-row a").eq($("#row-count").val()).html('Add Styles');
		$(".model-year-row a").eq($("#row-count").val()).attr('onclick', 'addStyleModal(this)');
	}
	//$(".model-name-row input[type=text]").eq($("#row-count").val()).after("<p class='help-block'>"+yearArr+"</p>");
	$("#style-modal").modal('hide');
}