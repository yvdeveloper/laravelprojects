$(document).ready(function(){

    $('#btn-submitxx').click(function(e) {
        e.preventDefault();

        // Serialize the form data
        let form = $('#employee_form')[0];
        let data = new FormData(form);
        // Send an AJAX request
        $.ajax({
            type: 'POST',
            url: $('#employee_form').attr('action'),
            data : data,
            dataType:"JSON",
            processData : false,
            contentType:false,
            success: function(response) {
                // Handle the response message
                $('#cf-response-message').text(response.message);
                refresh_form();
                alert(response.status == 400 ? 'Please check errors' : response.message);
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(xhr.responseText);
            }
        });
    });

    function refresh_form()
    {
        $('form :input').val("");
        $("#gender").val('default');
        $("#gender").selectpicker("refresh");
    }

});

