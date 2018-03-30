$(window).on('load',function(){
    $('#myModal').modal('show');
});

$("#tree_2").jstree({
    checkbox: {
        "keep_selected_style": false,
        "visible" : true,
        "three_state": true,
        "whole_node" : false,
        "state" :  {
            "opened" : false
        }
    },
    plugins: ["checkbox"],
    core: {
        "themes":{
            "icons": false
        }
    }
});

$("#tree_3").jstree({
    checkbox: {
        "keep_selected_style": false,
        "visible" : true,
        "three_state": true,
        "whole_node" : false,
        "state" :  {
            "opened" : false
        }
    },
    plugins: ["checkbox"],
    core: {
        "themes":{
            "icons": false
        }
    }
});

$('#detailed-form').submit(function(e){
    e.preventDefault();
    var form_data = new FormData($(this)[0]);

    var selectedFilters = $('#tree_2').jstree(true).get_selected();
    var indicators = $('#tree_3').jstree(true).get_selected();

    form_data.append('filters', selectedFilters);
    form_data.append('indicators', indicators);

    $.ajax({
        url: base_url + "claim/detailedShow",
        type: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        beforeSend: function(){
            $('#loading-img').show();
        },
        complete: function(){
            $('#loading-img').hide();
        },
        success: function(response) {
            $('#myModal').modal('hide');
            $('#detail-report').html(response);
        }
    });
});

$('select#proj_selector').change(function() {
    var ids = $(this).val(),
        splitVal = ids.split(','),
        id = splitVal[0],
        code = splitVal[1];

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getProduct",
        dataType: 'json',
        data: {
            code : code
        },
        cache : false,
        success : function(response) {
            $("select[name='prod_selector'] option")
                .not(":eq(0)")
                .remove();
            $.each(response, function(key, value) {
                $('select#prod_selector')
                    .append($("<option></option>")
                        .attr("value", value.id+','+value.product_no)
                        .text(value.product_name));
            });
        }
    });

    $('#tree_2 ul li').addClass("hidden").hide();

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getDivision",
        dataType: 'json',
        data: {
            id : id
        },
        cache : false,
        success : function(response) {
            for (var i=0; i<response.length; ++i) {
                $('#tree_2 li.div_' + response[i].id).removeClass("hidden").show();
            }
            $('#detail-indi').removeClass("hidden").show();
        }
    });
});