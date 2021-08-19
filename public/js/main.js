
//change setup for getting CSRF token form header meta tag
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){

    // Listen to submit instead of click on all forms.
    $(".js-downvote-form").on("submit", function(event){

        // Get the values from this form and store it in an object.
        var formData = $(this).serialize();

        $.ajax({
        /* the route pointing to the post function */
        url: '/negative',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: formData, // Your data to send.
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) { 
            $(data.post_id).css('visibility', 'visible');
        }
        });

        // This is important.
        // We want to override the default submit behavior.
        // So preventing it is necessary.
        event.preventDefault();
    });
});

  $(document).ready(function(){
    $(".js-upvote-form").on("submit", function(event){
      var formData = $(this).serialize();
      $.ajax({
        url: '/positive',
        type: 'POST',
        data: formData,
        dataType: 'JSON',
        success: function (data) { 
          $(data.post_id).css('visibility', 'visible'); 
        }
      });
      event.preventDefault();
    });
  });


   /* POSITIVE VOTE REQUEST 
   $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token-2"]').attr('content');
        $("#positive_button").click(function(){
            $.ajax({
                // the route pointing to the post function
                url: '/positive',
                type: 'POST',
                // send the csrf-token and the input to the controller
                data: {_token: CSRF_TOKEN, positive_vote:$("#positive_vote").val(), post_id:$("#post_id").val()},
                dataType: 'JSON',
                // remind that 'data' is the response of the AjaxController
                success: function (data) { 
                    $(".writeinfo").append(data.alert); 
                }
            }); 
        });
   });*/