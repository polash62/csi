$(".date-picker").datepicker( {
    format: "yyyy-mm",
    startView: "months",
    minViewMode: "months",
    endDate : new Date()
});

$(".date-picker-withdate").datepicker( {
    format: "yyyy-mm-dd",
    endDate : new Date()
});
