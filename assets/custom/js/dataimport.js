$(function () {
    //Upload Policy Opening File
    $('#upload_button').click(function () {
        if (document.getElementById("data_imp_file").files.length > 0) {
            $('.myprogress').css('width', '0');
            $('.msg').text('');
            var formData = new FormData();
            formData.append('myfile', $('#data_imp_file')[0].files[0]);
            $('#upload_button').attr('disabled', 'disabled');
            $('#submit_button').attr('disabled', 'disabled');
            $('.msg').text('Uploading in progress...');

            $.ajax({
                url: base_url + 'admin/upload_file',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                // this part is progress bar
                xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.myprogress').text(percentComplete + '%');
                        $('.myprogress').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
                },
                success: function (data) {
                    $('.msg').text(data);
                    $('#upload_button').removeAttr('disabled');
                    //$('#submit_button').removeAttr('disabled');
                    $('#data_imp_filename').val($('#data_imp_file')[0].files[0].name);
                    $('#upload_button_settlement').removeAttr('disabled');
                }
            });
        }
    });


    //Upload Settlement File
    $('#upload_button_settlement').click(function () {
        if (document.getElementById("settlement_file").files.length > 0) {
            $('.myprogress_settlement').css('width', '0');
            $('.msg_settlement').text('');
            var formData = new FormData();
            formData.append('myfile', $('#settlement_file')[0].files[0]);
            $('#upload_button_settlement').attr('disabled', 'disabled');
            $('#submit_button').attr('disabled', 'disabled');
            $('.msg_settlement').text('Uploading in progress...');
            $.ajax({
                url: base_url + 'admin/upload_file',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                // this part is progress bar
                xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.myprogress_settlement').text(percentComplete + '%');
                        $('.myprogress_settlement').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                $('.msg_settlement').text(data);
                $('#upload_button_settlement').removeAttr('disabled');
                $('#submit_button').removeAttr('disabled');
                $('#settlement_file_name').val($('#settlement_file')[0].files[0].name);
            }
        });
        }
    });
});

var date_data_status = "";

function checkThisDateData() {
    var data_imp_month = $("#data_imp_month").val();
    var datastring = 'batch_data_date=' + data_imp_month;
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('admin/checkExistingData'); ?>",
        data: datastring,
        success: function (responseData) {
            date_data_status = responseData;
        }
    });
}

function checkExistingData() {
    if (date_data_status == "yesdata") {
        var confirm_status = confirm("Data already exist for this month. Do you want to replace data?");
        if (confirm_status) {
            return true;
        } else {
            return false;
        }
    }
}