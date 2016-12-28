$(function() {
	if($("#example1").length > 0)
	{
    	$("#example1").DataTable();
  }
    /*if($('#poll_form').length > 0)
    {
      $('#date_range').daterangepicker();
      $('#poll_form').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            question: {
              validators: {
                  notEmpty: {
                      message: 'The question is required'
                  }
              }
            }
        }
      }).on('success.form.fv', function(e) {
          document.poll_form.submit();
      });
    }*/

});

function addOptions()
{
  $(".option_div").last().after($(".option_div").last().clone());
  var option_length = $(".option_div").length;
  // label
  $(".option_div").last().find("label").eq(0).html("Option"+(option_length + option_length - 1));
  $(".option_div").last().find("label").eq(0).attr('for', 'inputOption'+(option_length + option_length-1));
  $(".option_div").last().find("label").eq(1).html("Option"+(option_length * 2));
  $(".option_div").last().find("label").eq(1).attr('for', 'inputOption'+(option_length * 2));

  // textbox
  $(".option_div").last().find("input").eq(0).attr("id", "inputOption"+(option_length + (option_length - 1)))
            .attr('placeholder', 'Option'+(option_length + (option_length - 1)));
  $(".option_div").last().find("input").eq(1).attr("id", "inputOption"+(option_length * 2))
            .attr('placeholder', 'Option'+(option_length * 2));
}

function createPoll()
{
  if($("#inputQuestion").val() == "" || $("#inputOption1").val() == "" || $("#inputOption2").val() == "")
  {
    window.scrollTo(0,0);
    $("#err_msg").html("<div class='alert alert-danger alert-dismissable'>"+
      "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+
      "<h4><i class='icon fa fa-ban'></i> Alert!</h4>Question, Option1 and Option2 are required.</div>");
    setTimeout(function() {
      $("#err_msg").html("");
    }, 5000);
    return false;
  }
  return true;
}