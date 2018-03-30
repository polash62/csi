$('form').submit(function(e){
    e.preventDefault();

    var locationId = $('#location').val();

    $.ajax({
        type: 'POST',
        url: base_url + 'admin/pulldatadone',
        dataType: 'json',
        data: {
            location : locationId
        },
        cache : false,
        beforeSend: function() {
            $('#pull-data-submit').attr('disabled', true);
            $('#loading-img').css('display', 'inline');
        },
        error : function(response) {
            $('#pull-data-submit').removeAttr('disabled');
            $('#loading-img').css('display', 'none');

            $('#pull-text').html('<span class="help-block text-danger">An Error Occurred.</span>');
        },
        success : function(response) {
            $('#pull-data-submit').removeAttr('disabled');
            $('#loading-img').css('display', 'none');

            if (!response.haserror) {
                $('#pull-text').html('<span class="help-block text-success">'+ response.message +'</span>');
            } else {
                $('#pull-text').html('<span class="help-block text-danger">'+ response.message +'</span>');
            }
        }
    });
});