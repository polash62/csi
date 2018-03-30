// ---------- Project Selector ----------
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
                        $('select#branch_selector')
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
                        $('select#area_selector')
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
                        $('select#reg_selector')
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

// ---------- Division Selector ----------
$('select[name="div_selector"]').change(function () {
    var id = $(this).val();

    $("select#reg_selector option")
            .not(":eq(0)")
            .remove();
    $("select#area_selector option")
            .not(":eq(0)")
            .remove();
    $("select#branch_selector option")
            .not(":eq(0)")
            .remove();

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

// ---------- Region Selector ----------
$('select[name="reg_selector"]').change(function () {
    var id = $(this).val();

    $("select#area_selector option")
            .not(":eq(0)")
            .remove();
    $("select#branch_selector option")
            .not(":eq(0)")
            .remove();

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
                $('select#area_selector')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.area_name));
            });
        }
    });
});

// ---------- Area Selector ----------
$('select[name="area_selector"]').change(function () {
    var id = $(this).val();

    $("select[name='branch_selector'] option")
            .not(":eq(0)")
            .remove();

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
                $('select#branch_selector')
                        .append($("<option></option>")
                                .attr("value", value.branch_code)
                                .text(value.branch_code + '-' + value.branch_name));
            });
        }
    });
});

//---------- Items ----------
$(document).ready(function () {
    var options = [],
            reportDetails = $('table#report-details');

    $('.dropdown-menu li.dropdown-submenuu').on('click', function (event) {
        $('.indi-submenu').addClass('hidden');

        var $target = $(event.currentTarget),
                val = $target.attr('data-value'),
                $inp = $target.find('input').first();

        setTimeout(function () {
            $inp.prop('checked', true)
        }, 0);

        $('#indi-submenu' + val).removeClass("hidden").fadeIn(1600);

        return false;
    });

    $('.dropdown-menu li ul li').on('click', function (event) {
        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').eq(1).remove();
        });

        var $target = $(event.currentTarget),
                val = $target.attr('data-value'),
                $inp = $target.find('input'),
                idx;
        var res = val.split(","),
                masterId = '';

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
                $('.indi_' + masterId).addClass("hidden").hide();
            } else {
                $('#indicator_' + res[0]).addClass('hidden').hide();

                masterId = $target.attr('data-master-id');
                setTimeout(function () {
                    $('#all_' + masterId).find('input').prop('checked', false)
                }, 0);


                if ($('.indi_' + masterId + ':visible').length == 1) {
                    $('.indi_' + masterId).addClass("hidden").hide();
                }
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
                $('.indi_' + masterId).removeClass("hidden").fadeIn(1600);
            } else {
                $('#indicator_' + res[0]).removeClass("hidden").fadeIn(1600);
                $('#indicator_' + res[1]).removeClass("hidden").fadeIn(1600);
            }
        }

        $(event.target).blur();

        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').after('<span>' + parseInt(index + 1) + '</span>');
        });

        return false;
    });

    $('span.removable-row').on('click', function (e) {
        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').eq(1).remove();
        });

        var id = $(this).closest('tr').attr('data-value');
        var masterId = $(this).closest('tr').attr('data-master-id');

        setTimeout(function () {
            $('#indicator' + id).prop('checked', false)
        }, 0);
        $(this).closest('tr').hide();

        setTimeout(function () {
            $('#all_' + masterId).find('input').prop('checked', false)
        }, 0);

        if ($('.indi_' + masterId + ':visible').length == 1) {
            $('.indi_' + masterId).addClass("hidden").hide();
        }

        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').after('<span>' + parseInt(index + 1) + '</span>');
        });
    });

    reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
        $(this).text(index + 1);
    });

    $('#allIndi').on('click', function () {
        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').eq(1).remove();
        });

        if ($(this).find('input').is(':checked')) {
            $('.hidden-indicators').removeClass("hidden").fadeIn(1600);
            $('.hid-indicators').find('input').prop('checked', true);
        } else {
            $('.hidden-indicators').addClass("hidden").hide();
            $('.hid-indicators').find('input').prop('checked', false);
        }

        reportDetails.find('tr:visible').not('.indicator-title').find('td:first').each(function (index) {
            $(this).find('span').after('<span>' + parseInt(index + 1) + '</span>');
        });
    });
});

//---------- PDF Export ----------
/*$('#PDFExport').click(function () {
 var currentdate = currentDate();
 var reportName = $('#report-name').html();
 var filterTitle = $('#prodName').text().trim()+ ' ' + $('#divName').text().trim()+ ' ' + $('#regName').text().trim()+ ' ' + $('#areaName').text().trim()+ ' ' + $('#brName').text().trim();
 
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

//---------- Excel Export ----------
$('#excelExport').click(function (e) {

    var userid = $('#user_id').val();
    var action = $('#actionExcel').val();
    var urltext = '';

    if (action == '809') {
        urltext = "../dashboard/savelogdata/";
    } else {
        urltext = "dashboard/savelogdata/";
    }

    var formData = {
        'user_id': userid,
        'action': action,
    };
    $.ajax({
        type: "POST",
        url: urltext,
        data: formData,
        success: function (data) {
            console.log(data);
        }
    });

    var htmls = '';
    var uri = 'data:application/vnd.ms-excel;base64,';
    var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
    var base64 = function (s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    };

    var format = function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        })
    };

    var currentdate = currentDate(),
            reportName = $('#report-name'),
            filename = $('#projName').html().trim() + '_' + reportName.html().trim() + '_' + currentdate;

    htmls += '<h3>' + $('#report-excel-title').html() + '</h3>';
    htmls += '<h4>' + $('#brac-mf').html() + '</h4>';
    htmls += '<h4>' + reportName.html() + '</h4>';

    htmls += '<h4>' + $('#prodName').html().trim() + '&nbsp;&nbsp;' + $('#divName').html().trim() + '&nbsp;&nbsp;' + $('#regName').html().trim() + '&nbsp;&nbsp;' + $('#areaName').html().trim() + '&nbsp;&nbsp;' + $('#brName').html() + '</h4>';

    var t = $('#report-details').clone();
    t.appendTo(document.body);
    t.find('td').not(':visible').closest('tr').remove();

    htmls += t.html();


    var ctx = {
        worksheet: 'Worksheet',
        table: htmls
    };

    var link = document.createElement('a');
    document.body.appendChild(link);  // You need to add this line
    link.download = filename + '.xls';
    link.href = uri + base64(format(template, ctx));
    link.click();

    t.remove();
});

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
    $(".date_picker_to_class").datepicker("destroy");
    $( ".date_picker_to_class" ).datepicker("refresh");
});