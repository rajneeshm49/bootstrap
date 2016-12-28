<?= $this->Html->css('Admin/style.css') ?>
<?= $this->Html->css('Admin/responsive-calendar.css') ?>
<?= $this->Html->script('responsive-calendar.min') ?>
<?= $this->Html->script('responsive-calendar') ?>
<?= $this->Html->css('Admin/plugins/timepicker/bootstrap-timepicker.min.css') ?>
<?php //echo $selectedDate; ?>
<div class="container box box-info">
	<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 mar-top20 no-padding">
      <!-- Responsive calendar - START -->
        <div class="responsive-calendar">
            <div class="controls bggreen col-xs-12 no-padding">
                <div class="mar-top10 mar-bot20">
                    <div class="col-xs-1 mar-top10 no-padding"><a data-go="prev"><span class="glyphicon glyphicon-chevron-left text-white font20"></span></a></div>
                    <h4 class="font25 text-white col-xs-10 text-center no-padding"><span data-head-year></span> <span data-head-month></span></h4>
                    <div class="col-xs-1 mar-top10 no-padding"><a data-go="next"><span class="glyphicon glyphicon-chevron-right text-white font20"></span></a></div>
                </div>
            </div>
            <div class="day-headers">
              <div class="day header">Mon</div>
              <div class="day header">Tue</div>
              <div class="day header">Wed</div>
              <div class="day header">Thu</div>
              <div class="day header">Fri</div>
              <div class="day header text-red">Sat</div>
              <div class="day header text-red">Sun</div>
            </div>
            <div class="days" data-group="days">
              
            </div>
        </div>
      <!-- Responsive calendar - END -->
      
      <div class="col-xs-12 action mar-top20 font12 no-padding">
      	<ul class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-padding">
        	<li><?= $this->Html->image('red.jpg', ['class' => 'img-responsive', 'alt' => '']);?></li>
            <li>Sunday and public holiday</li>
        </ul>
        <ul class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-padding">
        	<li><?= $this->Html->image('green.jpg', ['class' => 'img-responsive', 'alt' => '']);?></li>
            <li>Time sheet for that day filled</li>
        </ul>
        <ul class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-padding">
        	<li><?= $this->Html->image('brown.jpg', ['class' => 'img-responsive', 'alt' => '']);?></li>
            <li>Less than 9 hrs</li>
        </ul>
        <ul class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-padding">
        	<li><?= $this->Html->image('blue.jpg', ['class' => 'img-responsive', 'alt' => '']);?></li>
            <li>Time sheet to be filled</li>
        </ul>
      </div>
  </div>
    <div class="col-xs-12 col-sm-offset-1 col-sm-5 col-md-offset-1 col-md-5 col-md-offset-1 col-md-6 mar-top20">
    	<?php echo $this->Form->create(null, ['method' => 'post', 'class' => 'form-horizontal', 'id' => 'timesheet_entry', 'name' => 'timesheet_entry', 'enctype' => 'multipart/form-data']); ?>
    	<input type="hidden" name="log_date" id="log_date" value="<?= $selectedDate?>">
    	    <div class="form-group col-xs-12">
                <div class="col-xs-12 no-padding">
                    <div class="bx-shadow uppercase bxwidth">
                        <?php 
            			    echo $this->Form->input('project_id', [
            					'type' => "select",
            					'options' => $projects,
            			        'id' => 'timesheet_project_id',
            					'empty' => '(Choose Project)',
            			        'class' => "form-control",
            					'label' => false,
            					'tabindex' => '1'
                    		]);
            			?>
                     </div>
                </div>
            </div>
            
            <div class="form-group col-xs-12">
	            <div class="col-xs-12 no-padding">
	            	<div class="bx-shadow uppercase bxwidth">
	                	<?php 
	            			    echo $this->Form->input('issue', [
	            					'type' => "select",
	            					'options' => [0 => 'Task', 1 => 'Issue'],
	            			        'id' => 'timesheet_issue',
	            					'empty' => '(Choose Task / Issue)',
	            			        'class' => "form-control",
	            					'label' => false,
	            					'tabindex' => '2'
	                    		]);
	            			?>
	            	</div>
	            </div>
            </div>
            <div class="col-xs-12 task bx mar-top20 no-padding">
            	<div class="form-group col-xs-12">
                <div class="col-xs-12  no-padding">
                    <div class="bx-shadow uppercase bxwidth">
                        <?php 
            			    echo $this->Form->input('project_task_id', [
            					'type' => "select",
            					'empty' => '(Choose Task)',
            			        'id' => 'timesheet_task_id',
            			        'class' => "form-control for_tasks",
            					'label' => false,
            					'tabindex' => '2'
                    		]);
            			?>
                     </div>
                	</div>
           		 </div>
           		 </div>
                 <!-- div class="form-group col-xs-12">
                
                <div class="col-xs-12 no-padding">
                    <div class="bx-shadow uppercase bxwidth">
                        
                     </div>
                </div>
            </div-->
            
            
            
            <div class="col-xs-12 issue bx mar-top20 no-padding">
            	<div class="form-group col-xs-12">
                <div class="col-xs-12 no-padding">
                    <div class="bx-shadow uppercase bxwidth">
                        <?php 
            			    echo $this->Form->input('project_issue_id', [
            					'type' => "select",
            			        'id' => 'timesheet_issue_id',
            					'empty' => '(Choose Issue)',
            			        'class' => "form-control for_issues",
            					'label' => false,
            					'tabindex' => '2'
                    		]);
            			?>
                     </div>
                	</div>
           		 </div>
           		 
         
            </div>
            
            <div class="form-group col-xs-12">
                <div class="col-xs-12  no-padding">
                    <div class="bx-shadow uppercase bxwidth">
                  		
						<?php 
						echo $this->Form->input('hours', [
								'type' => "select",
						        'id' => 'hours_holiday',
								'empty' => '(Select Hours)',
						        'class' => "form-control",
								'label' => false,
								'tabindex' => '5'
			        		]);
						?>
                  </div>
			</div>              
        </div>
            <div class="form-group col-xs-12">
                <div class="col-xs-12 no-padding">
                    <div class="bxwidth">
                        <?php 
            			    echo $this->Form->input('description', [
            					'type' => "textarea",
            					'class' => "col-xs-12 txt-area",
            					'label' => false,
            			        'rows' => 4,
            			        'placeholder' => 'Description (Optional)'
                    		]);
            			?>
                     </div>
                </div>
            </div>
            
            <div class="col-xs-12 mar-top10 no-padding">
                <button type="submit" class="btn btn-primary uppercase" id="timesheet_save">Save</button>
                
                <div class="callout mar-top20" id="excess_timesheet">
          			<p id="excess_timesheet_msg"></p>
        		</div>
           </div>
           
       <?php  echo $this->Form->end(); ?>
       
    </div>
    
	<div class="col-xs-12 mar-top20 no-padding">
		<div class="table-responsive margin-top10">          
			<table class="table data-table table-striped">
	    	   	<thead>
	        	    <tr>
	                    <th width="8%">Sr. No</th>
	                    <th width="21%">Project</th>
	                    <th width="22%">Task / Issue</th>
	                    <th width="8%">Hrs</th>
	                    <th width="31%">Description</th>
	                    <th width="10%">Options</th>
	                </tr>
	            </thead>
	            <tbody id="time_log_body">
	            <?php if(count($timesheets) == 0) {
	            ?>
	            	<tr>
	            		<td colspan=6>No record found</td>
	            	</tr>
	            <?php 
	            } else {
	            	$cnt = 1;
	            	foreach($timesheets as $timesheet) {
	            ?>
	            	<tr id="timesheet_tr_<?= $timesheet->id; ?>">
	            		<td><?= $cnt?></td>
	            		<td><?= $timesheet->project->name?></td>
	            		<td><?= ($timesheet->issue) ? 'Issue#'.$timesheet->project_issue_id : 'Task: '.$timesheet->project_task['name']?></td>
	            		<td><?= $timesheet->hours?></td>
	            		<td><?= $timesheet->description?></td>
	            		<td><a href="#" data-value="<?= $timesheet->id ?>" class="fa fa-times timesheet_tbl_record" title="Delete record"></a></td>
	            	</tr>
	            <?php 
	            	$cnt++;
	            	}
	            }?>
	        	</tbody>
	      	</table>
	    </div>
	</div>
	<div class="example-modal">
        <div class="modal" id="timesheet-complete-modal">
          <div class="modal-dialog">
            <div class="modal-content" style="width:400px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
</div>

<?= $this->Html->script('Admin/form-validation.js') ?>
<?= $this->Html->script('Admin/plugins/timepicker/bootstrap-timepicker.min.js') ?>
<script type="text/javascript">

	

$(document).ready(function() {
	
	$('#excess_timesheet').hide();
	
	var no_of_records = <?php echo count($timesheets); ?>;
	var event_str = { <?php echo $event_str; ?>};
		

	var holiday_dates= event_str;
	
	  $(".responsive-calendar").responsiveCalendar({
			onDayClick: function(events) { 
	    		$('.active').removeClass('active');
	    		highlightSelectedDate($(this));
				abc(key);
				getProjectsWithinDates(key);
	    	},
	    	events: holiday_dates
	    });
	    
    $('#timesheet_entry').formValidation({
      framework: 'bootstrap',
      icon: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        project_id: {
            validators: {
                notEmpty: {
                    message: 'Please select Project name'
                }
            }
        },
        issue: {
            validators: {
                notEmpty: {
                    message: 'Please select Task / Issue'
                }
            }
        },
        project_issue_id: {
            validators: {
                notEmpty: {
                    message: 'Please select Issue no.'
                }
            }
        },
        project_task_id: {
            validators: {
                notEmpty: {
                    message: 'Please select Task.'
                }
            }
        },
        hours: {
            validators: {
                notEmpty: {
                    message: 'Please select Hours.'
                }
            }
        }
      }
    }).on('success.form.fv', function(e) {
			//document.timesheet_entry.submit();

			e.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: jsBaseURL + '/admin/timesheets/saveTimesheet',
				data: 'data=' + $('#timesheet_entry').serialize(),
				dataType: 'json',
				success: function(data) {
// 					data = JSON.parse(data);
					if(data.success == 1) {
						
						$('#excess_timesheet').addClass('callout-success');
						
						if(data.task.issue) {
							task = 'Issue#' + data.task.project_issue_id;
						} else {
							task = 'Task: ' + data.task.project_task.name;
						}
						if(no_of_records == 0) {
							$('#time_log_body tr:first').remove();
						}
// 						if(data.task.issue) {
// 					       desc = "Issue #" + data.task.project_issue_id;
// 				        } else {
// 				           desc = data.task.description;
// 				        }
						desc = data.task.description;
						$('#time_log_body').append('<tr><td>' + (no_of_records + 1)  + '</td><td>' + data.task.project.name + '</td><td>' + task + '</td><td>' + data.task.hours + '</td><td>' + desc + '</td><td><a href="#" data-value="' + data.task.id + '" class="fa fa-times timesheet_tbl_record" title="Delete record"></a></td></tr>');
						no_of_records += 1;
						
					} else {
						$('#excess_timesheet').removeClass('callout-success').addClass('callout-danger');
					}

					$('#excess_timesheet_msg').text(data.message);
					
					$('#excess_timesheet').show();
					$('#timesheet_save').prop("disabled", false).removeClass("disabled");
					setTimeout(function(){
						$('#excess_timesheet').hide('slow');
					}, 6000);
				}
});
    });

    function addLeadingZero(num) {
	    if (num < 10) {
	      return "0" + num;
	    } else {
	      return "" + num;
	    }
	}

    function highlightSelectedDate(dthis)
    {
    	var year = dthis.data('year')
		var month = addLeadingZero(dthis.data('month'));
		var day = addLeadingZero(dthis.data('day'));

		var dayLink = $('[data-day=' + day + '][data-month=' + month + '][data-year=' + year + ']')
		dayLink.parent().addClass('active');

		key = year + '-' + month + '-' + day;
    	$('#log_date').val(key);
    }
	function abc(key)
	{
		$.ajax({
			type: 'POST',
			url: jsBaseURL + '/admin/timesheets/getTasksForDay',
			data: 'date=' + key,
			dataType: 'json',
			success: function(data) {
				trHTML = '<tr><td colspan="6">No record found</td></tr>';
				no_of_records = data.length;
				if(data.length != 0) {
    				trHTML = '';
					$.each(data, function (i, item) {
	    				
			            if(data[i].issue) {
			            	issue_task = "Issue#" + data[i].project_issue_id;
	    		        } else {
	    		        	issue_task = "Task: " + data[i].project_task.name;
			    		}
	    		        
// 			            if(data[i].issue) {
// 				           desc = "Issue #" + data[i].project_issue_id;
// 			            } else {
// 			            	desc = data[i].description;
// 			            }
						desc = data[i].description;
	 		            trHTML += '<tr><td>' + (i+1) + '</td><td>' + data[i].project.name + '</td><td>' + issue_task + '</td>' +
	 		            '<td>' + data[i].hours + '</td><td>' + desc + '</td><td><a href="#" data-value="' + data[i].id + '" class="fa fa-times timesheet_tbl_record" title="Delete record"></a></td></tr>';
			        });
	        	}
	        	$('#time_log_body').html(trHTML);
			}
		});
	}

	$(document).on('click', '.timesheet_tbl_record', function(e) {
		e.preventDefault();
		ts_id = $(this).attr('data-value');
		if(confirm('Are you sure, you want to delete record')) {
			$.ajax({
				type: 'POST',
				url: jsBaseURL + '/admin/timesheets/delete',
				data: 'id=' + ts_id,
				success: function(data) {
					if(data) {
//						$('#timesheet_tr_' + ts_id).remove();
						abc($('#log_date').val());
					}
				}
			});
		}
    });
});
$(".timepicker").timepicker({
	 showMeridian: false,
	 showInputs: false,
     defaultTime: '01:00',
     maxHours: '09:00',
     explicitMode: false
});

</script>