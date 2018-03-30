$('#claim-settlement-form').submit(function(e){
    e.preventDefault();
    var form_data = new FormData($(this)[0]);

    var selectedFilters = $('#tree_2').jstree(true).get_selected();
    var indicators = $('#tree_3').jstree(true).get_selected();

    form_data.append('filters', selectedFilters);
    form_data.append('indicators', indicators);

    $.ajax({
        url: base_url + "administrative/claimSettlementShow",
        type: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#loading-img').show();
        },
        complete: function() {
            $('#loading-img').hide();
        },
        success: function(response) {
            $('#myModal').modal('hide');
            $('#claim-settlement-report').html(response);
        }
    });
});