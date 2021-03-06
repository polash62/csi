//---------- Project Selector ----------
$('select#proj_selector').change(function () {
    var ids = $(this).val(),
            splitVal = ids.split(','),
            id = splitVal[0],
            code = splitVal[1];

    $("select[name='prod_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='div_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='reg_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='area_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='branch_selector'] option")
            .not(":eq(0)")
            .remove();
    $("#vo_selector").prop('disabled', true).val('');
    $("#member_selector").prop('disabled', true).val('');

    if (id == 2) {
        $('#disabledDivisionInput').hide();
        $('#selectBoxDivisionInput').show();
        $("input#div_selector").attr('name', '');
        $("select#div_selector_ass").attr('name', 'div_selector');

        $('#disabledRegionInput').hide();
        $('#selectBoxRegionInput').show();
        $("input#reg_selector").attr('name', '');
        $("select#reg_selector_ass").attr('name', 'reg_selector');

        $('#disabledAreaInput').hide();
        $('#selectBoxAreaInput').show();
        $("input#area_selector").attr('name', '');
        $("select#area_selector_ass").attr('name', 'area_selector');
    } else if (id == 1) {
        $('#disabledDivisionInput').show();
        $('#selectBoxDivisionInput').hide();
        $("input#div_selector").attr('name', 'div_selector');
        $("select#div_selector_ass").attr('name', '');

        $('#disabledRegionInput').show();
        $('#selectBoxRegionInput').hide();
        $("input#reg_selector").attr('name', 'reg_selector');
        $("select#reg_selector_ass").attr('name', '');

        $('#disabledAreaInput').show();
        $('#selectBoxAreaInput').hide();
        $("input#area_selector").attr('name', 'area_selector');
        $("select#area_selector_ass").attr('name', '');

        if ($("#disabledDivisionInput").is(':visible') && $("#disabledRegionInput").is(':visible') && $("#disabledAreaInput").is(':visible')) {
            var areaId = $('#area_selector').val();

            $.ajax({
                type: 'GET',
                url: base_url + "enrollment/getBranch",
                dataType: 'json',
                data: {
                    id: areaId
                },
                cache: false,
                success: function (response) {
                    $("select[name='branch_selector'] option")
                            .not(":eq(0)")
                            .remove();
                    $.each(response, function (key, value) {
                        $('select[name="branch_selector"]')
                                .append($("<option></option>")
                                        .attr("value", value.branch_code)
                                        .text(value.branch_code + '-' + value.branch_name));
                    });
                }
            });
        } else if ($("#disabledDivisionInput").is(':visible') && $("#disabledRegionInput").is(':visible')) {
            var regID = $('#reg_selector').val();

            $.ajax({
                type: 'GET',
                url: base_url + "enrollment/getArea",
                dataType: 'json',
                data: {
                    id: regID
                },
                cache: false,
                success: function (response) {
                    $("select[name='area_selector'] option")
                            .not(":eq(0)")
                            .remove();
                    $.each(response, function (key, value) {
                        $('select[name="area_selector"]')
                                .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.area_name));
                    });
                }
            });
        } else if ($("#disabledDivisionInput").is(':visible')) {
            var divID = $('#div_selector').val();

            $.ajax({
                type: 'GET',
                url: base_url + "enrollment/getRegion",
                dataType: 'json',
                data: {
                    id: divID
                },
                cache: false,
                success: function (response) {
                    $("select[name='reg_selector'] option")
                            .not(":eq(0)")
                            .remove();
                    $.each(response, function (key, value) {
                        $('select[name="reg_selector"]')
                                .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.region_name));
                    });
                }
            });
        }
    }

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getProduct",
        dataType: 'json',
        data: {
            code: code
        },
        cache: false,
        success: function (response) {
            $("select[name='prod_selector'] option")
                    .not(":eq(0)")
                    .remove();
            $.each(response, function (key, value) {
                $('select#prod_selector')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.product_name));
            });
        }
    });

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getDivision",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (response) {
            $("select[name='div_selector'] option")
                    .not(":eq(0)")
                    .remove();
            $.each(response, function (key, value) {
                $('select[name="div_selector"]')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.division_name));
            });
        }
    });
});

//---------- Division Selector ----------
$('select[name="div_selector"]').change(function () {
    var id = $(this).val();

    $("select[name='reg_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='area_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='branch_selector'] option")
            .not(":eq(0)")
            .remove();
    $("#vo_selector").prop('disabled', true).val('');
    $("#member_selector").prop('disabled', true).val('');

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getRegion",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (response) {
            $("select[name='reg_selector'] option")
                    .not(":eq(0)")
                    .remove();
            $.each(response, function (key, value) {
                $('select[name="reg_selector"]')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.region_name));
            });
        }
    });
});

//---------- Region Selector ----------
$('select[name="reg_selector"]').change(function () {
    var id = $(this).val();

    $("select[name='area_selector'] option")
            .not(":eq(0)")
            .remove();
    $("select[name='branch_selector'] option")
            .not(":eq(0)")
            .remove();
    $("#vo_selector").prop('disabled', true).val('');
    $("#member_selector").prop('disabled', true).val('');

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getArea",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (response) {
            $("select[name='area_selector'] option")
                    .not(":eq(0)")
                    .remove();
            $.each(response, function (key, value) {
                $('select[name="area_selector"]')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.area_name));
            });
        }
    });
});

//---------- Area Selector ----------
$('select[name="area_selector"]').change(function () {
    var id = $(this).val();

    $("select[name='branch_selector'] option")
            .not(":eq(0)")
            .remove();
    $("#vo_selector").prop('disabled', true).val('');
    $("#member_selector").prop('disabled', true).val('');

    $.ajax({
        type: 'GET',
        url: base_url + "enrollment/getBranch",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (response) {
            $("select[name='branch_selector'] option")
                    .not(":eq(0)")
                    .remove();
            $.each(response, function (key, value) {
                $('select[name="branch_selector"]')
                        .append($("<option></option>")
                                .attr("value", value.branch_code)
                                .text(value.branch_code + '-' + value.branch_name));
            });
        }
    });
});

$('select#branch_selector').change(function () {
    if ($(this).val() != '') {
        $("#vo_selector").prop('disabled', false).val('');
        $("#member_selector").prop('disabled', false).val('');
    } else {
        $("#vo_selector").prop('disabled', true).val('');
        $("#member_selector").prop('disabled', true).val('');
    }
});

//---------- Branch Selector ----------
/*$('select#branch_selector').change(function() {
 var brCode = $(this).val(),
 projectCode = $('select#proj_selector').val().split(',')[1];
 
 $("select[name='vo_selector'] option")
 .not(":eq(0)")
 .remove();
 $("select[name='member_selector'] option")
 .not(":eq(0)")
 .remove();
 
 $.ajax({
 type: 'GET',
 url: base_url + "claim/getVo",
 dataType: 'json',
 data: {
 brCode : brCode,
 projectCode: projectCode
 },
 cache : false,
 success : function(response) {
 console.log(response);
 $("select[name='vo_selector'] option")
 .not(":eq(0)")
 .remove();
 $.each(response, function(key, value) {
 $('select#vo_selector')
 .append($("<option></option>")
 .attr("value", value.organisation_code)
 .text(value.organisation_code));
 });
 }
 });
 });*/

//---------- Organisation Selector ----------
/*$('select#vo_selector').change(function() {
 var voCode = $(this).val(),
 projectCode = $('select#proj_selector').val().split(',')[1],
 brCode = $('select#branch_selector').val();
 
 $("select[name='member_selector'] option")
 .not(":eq(0)")
 .remove();
 
 $.ajax({
 type: 'GET',
 url: base_url + "claim/getMember",
 dataType: 'json',
 data: {
 brCode : brCode,
 projectCode: projectCode,
 orgCode: voCode
 },
 cache : false,
 success : function(response) {
 $("select[name='member_selector'] option")
 .not(":eq(0)")
 .remove();
 $.each(response, function(key, value) {
 $('select#member_selector')
 .append($("<option></option>")
 .attr("value", value.member_no)
 .text(value.member_no));
 });
 }
 });
 });*/

//---------- Items ----------
$(document).ready(function () {
    var options = [];

    $('.dropdown-menu li.dropdown-submenuu').on('click', function (event) {
        $('.indi-submenu').addClass('hidden');

        var $target = $(event.currentTarget),
                val = $target.attr('data-value'),
                $inp = $target.find('input').first();

        setTimeout(function () {
            $inp.prop('checked', true)
        }, 0);

        $('#indi-submenu' + val).removeClass("hidden").fadeIn('slow');

        return false;
    });

    //---------- Item Selector ----------
    $('.dropdown-menu li ul li').on('click', function (event) {
        var $target = $(event.currentTarget),
                val = $target.attr('data-value'),
                $inp = $target.find('input'),
                idx;

        $('#allIndi').find('input').prop('checked', false);

        if ((idx = options.indexOf(val)) > -1) {
            options.splice(idx, 1);
            setTimeout(function () {
                $inp.prop('checked', false)
            }, 0);

            if (val.search('all') != -1) {
                masterId = val.split('_')[1];
                setTimeout(function () {
                    $('.indicate_' + masterId).find('input').prop('checked', false)
                }, 0);

                $('.indicator_' + masterId).addClass("hidden").hide();
            } else {
                $('.indi_' + val.split('_')[0]).addClass("hidden").hide();
            }
        } else {
            options.push(val);
            setTimeout(function () {
                $inp.prop('checked', true)
            }, 0);

            if (val.search('all') != -1) {
                masterId = val.split('_')[1];
                setTimeout(function () {
                    $('.indicate_' + masterId).find('input').prop('checked', true)
                }, 0);
                $('.indicator_' + masterId).removeClass("hidden").fadeIn('slow');
            } else {
                $('.indi_' + val).removeClass("hidden").fadeIn('slow');
            }
        }

        $(event.target).blur();

        return false;
    });

    $('#allIndi').on('click', function () {
        if ($(this).find('input').is(':checked')) {
            $('.hidden_indicator').removeClass("hidden").fadeIn('slow');
            $('.hid-indicators').find('input').prop('checked', true);
        } else {
            $('.hidden_indicator').addClass("hidden").hide();
            $('.hid-indicators').find('input').prop('checked', false);
        }
    });
});

//---------- PDF Export ----------
/*$('#PDFExport').click(function () {
 var currentdate = currentDate();
 var reportName = $('#report-name').html();
 var filterTitle = $('#prodName').text().trim()+ ' ' + $('#divName').text().trim()+ ' ' + $('#regName').text().trim()+ ' ' + $('#areaName').text().trim()+ ' ' + $('#brName').text().trim()+ ' ' + $('#VoCode').text().trim()+ ' ' + $('#memberNo').text().trim();
 
 var pdf = new jsPDF('l', 'pt', 'letter', true);
 pdf.setFontSize(9);
 pdf.setFontType("bold");
 pdf.setFont("times");
 pdf.text(300, 15, $('#global-report h5').html());
 pdf.text(20, 25, $('#brac-mf').html());
 pdf.text(20, 35, reportName);
 pdf.text(590, 35, $('#printed_date').html());
 
 pdf.text(20, 55, filterTitle);
 
 pdf.setFontType("normal");
 pdf.cellInitialize();
 pdf.setFontSize(7.4);
 
 var line = 0;
 $.each($('#report-details tr'), function (i, row) {
 if ($(this).css("display") != 'none') {
 line ++;
 if (i == 0) {
 pdf.setFontType("bold");
 } else if (line == 52) {  //Line/Row number to enter into second page
 pdf.addPage();
 pdf.setFontSize(9);
 pdf.setFontType("bold");
 pdf.setFont("times");
 pdf.text(300, 15, $('#global-report h5').html());
 pdf.text(32, 25, $('#brac-mf').html());
 pdf.text(32, 35, reportName);
 pdf.text(600, 35, $('#printed_date').html());
 pdf.text(32, 45);
 pdf.setFontSize(7.4);
 pdf.cellInitialize();
 $.each($('#report-details thead tr'), function (k, row) {
 $.each($(row).find("td, th"), function (l, cell) {
 var txt = $(cell).text().trim() || " ";
 var width = 0;
 var text_align = "right";
 if (l == 0) {
 width = 12;
 text_align = "right";
 } else if (l == 1) {
 text_align = "left";
 width = 150;
 } else {
 width = 47;
 }
 pdf.cell(10, 65, width, 10, txt, k, text_align);
 });
 });
 pdf.setFontType("normal");
 } else {
 pdf.setFontType("normal");
 }
 
 $.each($(row).find("td, th"), function (j, cell) {
 var txt = $(cell).text().trim() || " ";
 var width = 0;
 var text_align = "right";
 if (j == 0) {
 width = 12;
 text_align = "right";
 if (isNaN(txt)) {
 pdf.setFontType("bold");
 } else {
 pdf.setFontType("normal");
 }
 } else if (j == 1) {
 text_align = "left";
 width = 150;
 } else {
 width = 47;
 }
 pdf.cell(10, 65, width, 10, txt, i, text_align);
 });
 }
 });
 
 pdf.save($('#projName').html().trim() + '_' +reportName + "_Trend_Report_" + currentdate + ".pdf");
 });*/

/**
 * Calculate Cuurrent Date
 * @returns {string}
 */
function currentDate() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    return d.getFullYear() + '-' +
            (('' + month).length < 2 ? '0' : '') + month + '-' +
            (('' + day).length < 2 ? '0' : '') + day;
}

$(".date_picker_from_class").change(function () {
    var from_date = $(".date_picker_from_class").val();
    var split_date = from_date.split("-");
    var to_date = parseInt(split_date[0]) + 1 + "-" + split_date[1];
    $(".date_picker_to_class").val(to_date);
});