$(document).ready(function() {
	
	$('#conversion_currency_id').change(function() {
		currency = $('#conversion_currency_id option:selected').text();
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/currency_conversions/get_inr_value',
			data: 'currency=' + currency,
			dataType: 'json',
			success: function(data) {
				data = JSON.parse(data);
				$('#conversion_to_inr').val(data);
			}
		});
		
	})
	
	$('#full_day_holiday').click(function() {
		if($(this).prop("checked") == true) {
			$('#hours_holiday').val('');
			$('#hours_holiday').prop('disabled', true);
		} else {
			$('#hours_holiday').prop('disabled', false);
		}
	})
	
	$( "#inputUserDpt3" ).autocomplete({
        source: jsBaseURL + '/admin/resource_departments/getUsersForDpt',
        minLength: 3,
        select: function(event, ui) {
            $("#user_id").val(ui.item.id);
            
            //after selecting user in ResourceDepartment, check if the user already has any default department
            $.ajax({
    			type: 'POST',
    			url: jsBaseURL + '/admin/ResourceDepartments/getDefaultDepartment',
    			data: 'user_id=' + ui.item.id,
    			dataType: 'json',
    			error: function(data) {
    				if(200 == data.status) {
    					$('#default_department').attr('checked', true);
    				}
    			}
    		});
        }
    });
	
	$('#project_dept_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/resource_departments/getUsersForDepartments/1',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#project_sm_resp').html(data);
			}
		});
	})
	
	$('#project_client_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getContactsForClients',
			data: 'client_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#project_contact_id').html(data);
			}
		});
	})
	
	$('#phase_department_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getProjectsForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#phase_project_id').html(data);
			}
		});
	})
	
	$('#milestone_department_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getProjectsForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#milestone_project_id').html(data);
			}
		});
	})
	
	$('#milestone_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getClientsForProjects',
			data: 'id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#milestone_client_id').val(data);
			}
		});
		
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getCurrenciesForProjects',
			data: 'id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#milestone_currency_id').val(data);
			}
		});
	})
	
	$('#milestone_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getDatesOfProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#start_date').datepicker('setStartDate', new Date(data.start_date));
				$('#start_date').datepicker('setEndDate', new Date(data.end_date));
				
				$('#end_date').datepicker('setStartDate', new Date(data.start_date));
				$('#end_date').datepicker('setEndDate', new Date(data.end_date));
			}
		});
	});
	
	$('#milestone_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getDatesOfProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#start_date').datepicker('setStartDate', new Date(data.start_date));
				$('#start_date').datepicker('setEndDate', new Date(data.end_date));
				
				$('#end_date').datepicker('setStartDate', new Date(data.start_date));
				$('#end_date').datepicker('setEndDate', new Date(data.end_date));
			}
		});
	});
	
	$('#module_department_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getProjectsForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#module_project_id').html(data);
			}
		});
	})
	
	$('#proj_task_department_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getProjectsForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#proj_task_project_id').html(data);
			}
		});
	})
	
	$('#proj_task_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/project_phases/getPhasesForProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#proj_task_phase_id').html(data);
			}
		});
	})
	
	$('#proj_task_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/milestones/getMilestonesForProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#proj_task_milestone_id').html(data);
			}
		});
	})
	
	$('#proj_task_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/project_modules/getModulesForProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#proj_task_module_id').html(data);
			}
		});
	});
	
	$('#resource_allocation_department_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/projects/getProjectsForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#resource_allocation_project_id').html(data);
			}
		});
		
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/resource_departments/getUsersForDepartments',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#resource_allocation_user_id').html(data);
			}
		});
		
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/resource_departments/getUsersForDepartments/1',
			data: 'department_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#resource_allocation_report_to').html(data);
				$('#resource_allocation_report_to').html(data);
			}
		});
	})
	
//	$('#resource_allocation_project_id').change(function() {
//		$.ajax({
//			type: 'POST',
//			url: jsBaseURL + '/admin/resource_allocations/getUsersForProjects',
//			data: 'project_id=' + $(this).val(),
//			dataType: 'json',
//			success: function(data) {
//				$('#resource_allocation_user_id').html(data);
//			}
//		});
//	})
	
	$('#issue_project_id').change(function() {
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/resource_allocations/getUsersForProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#issue_assign_to').html(data);
			}
		});
	})
	
	$('.rights_chkbox').click(function() {
		id_chkbox = $(this).attr('id');
		class_chkbox = id_chkbox + '_class';
		
		if($('#' + id_chkbox).is(":checked")) {
			$('.' + class_chkbox).prop('checked', true);
		} else {
			$('.' + class_chkbox).prop('checked', false);
		}
	});
	
	$('.disabled').click(function(e){
	     e.preventDefault();
	  })
	  
	  $('#timesheet_project_id').change(function() {
		  
		  //Get Tasks related to Project
		getProjectTasks($(this).val());
				
		
		//Get Issues related to Project
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/timesheets/getIssuesForProjects',
			data: 'project_id=' + $(this).val(),
			dataType: 'json',
			success: function(data) {
				$('#timesheet_issue_id').html(data);
			}
		});
		
//		$.ajax({
//			type: 'POST',
//			url: jsBaseURL + '/admin/resource_allocations/getUsersForProjects',
//			data: 'project_id=' + $(this).val(),
//			dataType: 'json',
//			success: function(data) {
//				$('#timesheet_issue_assign_to').html(data);
//			}
//		});
	});
		
	$('#timesheet_issue').change(function() {
		if($(this).val() == 0){
            $(".bx").not(".task").hide();
            $(".task").show();
            $('.for_issues').val('');
        }
		if($(this).val() == 1){
            $(".bx").not(".issue").hide();
            $(".issue").show();
            $('.for_tasks').val('');
        }
    });

	
	$(document).on('click', '#close-preview', function(){ 
	    $('.image-preview').popover('hide');
	    // Hover befor close the preview
	    $('.image-preview').hover(
	        function () {
	           $('.image-preview').popover('show');
	        }, 
	         function () {
	           $('.image-preview').popover('hide');
	        }
	    );    
	});

});


function getProjectTasks(project_id)
{
	$.ajax({
		type: 'POST',
		url: jsBaseURL + '/admin/timesheets/getTasksForProjects',
		data: 'project_id=' + project_id + '&date=' + $('#log_date').val(),
		dataType: 'json',
		success: function(data) {
			selected_task = $("#timesheet_task_id").val();
			$("#timesheet_task_id option[value!='']").remove();
			$.each(data, function(i, value) {
				
	            $('#timesheet_task_id').append($('<option>').text(value).attr('value', i));
	        });
			if(data.hasOwnProperty(selected_task)) {
				$("#timesheet_task_id").val(selected_task);
			}
		}
	});
}

function getProjectsWithinDates(key)
{

	$.ajax({
		type: 'POST',
		url: jsBaseURL + '/admin/resource_allocations/getProjectsForUserWithinDates',
		data: 'date=' + key,
		dataType: 'json',
		success: function(data) {
			selected_project = $("#timesheet_project_id").val();
			
			$("#timesheet_project_id option[value!='']").remove();
			$.each(data, function(i, value) {
				
	            $('#timesheet_project_id').append($('<option>').text(value).attr('value', i));
	        });
			if(data.hasOwnProperty(selected_project)) {
				$("#timesheet_project_id").val(selected_project);
			}
			//get 
			
			getProjectTasks($("#timesheet_project_id").val());
			
		}
	});
	

}


$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:150,
            height:100
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});