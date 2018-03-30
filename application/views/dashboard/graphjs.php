<script type="text/javascript">


    var monthlist = <?= json_encode($monthlist); ?>;
    var enrollmentInd = <?= json_encode($enrollmentInd); ?>;
    var policyType = <?= json_encode($policyType); ?>;
    var premiumInd = <?= json_encode($premiumInd); ?>;
    var claimInd = <?= json_encode($claimInd); ?>;

    var enrollment_indexlist = [1];
    var policy_indexlist = [1, 2];
    var premium_indexlist = [1, 2];
    var claim_indexlist = [1, 2];

    function pushData(indexlist, indicatorlist, data) {
        var tempseriesdata = [];
        var series = [];
        var indicator_index;
        var seriesdatapart;

        for (var i = 0; i < indexlist.length; i++) {
            seriesdatapart = [];
            indicator_index = indexlist[i];
            for (var j = 0; j < monthlist.length; j++) {
                seriesdatapart.push(parseInt(data[indicator_index][j].total));
            }
            tempseriesdata.push(seriesdatapart);
        }
        for (i = 0; i < indexlist.length; i++) {
            indicator_index = indexlist[i];
            series.push({
                name: indicatorlist[indicator_index]['indicator'],
                data: tempseriesdata[i]
            });
        }

        return series;
    }

    function drawChart(id, series, text) {
        Highcharts.chart(id, {
            chart: {
                type: 'column'
            },
            title: {
                text: text
            },
            xAxis: {
                categories: monthlist
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: false,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 2,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: series
        });
    }


    //============================================================= Global ===============================================================

    var global_enrollment_data = <?= json_encode($global_enrollment_data); ?>;
    var global_policytype_data = <?= json_encode($global_policytype_data); ?>;
    var global_premium_data = <?= json_encode($global_premium_data); ?>;
    var global_claim_data = <?= json_encode($global_claim_data); ?>;

    // Data Series
    var global_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, global_enrollment_data);
    var global_policytype_dataseries = pushData(policy_indexlist, policyType, global_policytype_data);
    var global_premium_dataseries = pushData(premium_indexlist, premiumInd, global_premium_data);
    var global_claim_dataseries = pushData(claim_indexlist, claimInd, global_claim_data);

    // Chart
    drawChart('enrollment', global_enrollment_dataseries, 'Policy Enrolment');
    drawChart('policy_type', global_policytype_dataseries, 'Policy Type');
    drawChart('Premium', global_premium_dataseries, 'Premium');
    drawChart('cliam', global_claim_dataseries, 'Claim');


    //============================================================= DABI ===============================================================

    var dabi_enrollment_data = <?= json_encode($dabi_enrollment_data); ?>;
    var dabi_policytype_data = <?= json_encode($dabi_policytype_data); ?>;
    var dabi_premium_data = <?= json_encode($dabi_premium_data); ?>;
    var dabi_claim_data = <?= json_encode($dabi_claim_data); ?>;

    // Data Series
    var dabi_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, dabi_enrollment_data);
    var dabi_policytype_dataseries = pushData(policy_indexlist, policyType, dabi_policytype_data);
    var dabi_premium_dataseries = pushData(premium_indexlist, premiumInd, dabi_premium_data);
    var dabi_claim_dataseries = pushData(claim_indexlist, claimInd, dabi_claim_data);

    // Chart
    drawChart('p_dabi_enrollment', dabi_enrollment_dataseries, 'Policy Enrolment');
    drawChart('p_dabi_policy_type', dabi_policytype_dataseries, 'Policy Type');
    drawChart('p_dabi_Premium', dabi_premium_dataseries, 'Premium');
    drawChart('p_dabi_cliam', dabi_claim_dataseries, 'Claim');


// ===========================================================  NCDP ====================================================================

    var ncdp_enrollment_data = <?= json_encode($ncdp_enrollment_data); ?>;
    var ncdp_policytype_data = <?= json_encode($ncdp_policytype_data); ?>;
    var ncdp_premium_data = <?= json_encode($ncdp_premium_data); ?>;
    var ncdp_claim_data = <?= json_encode($ncdp_claim_data); ?>;

    // Data Series
    var ncdp_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, ncdp_enrollment_data);
    var ncdp_policytype_dataseries = pushData(policy_indexlist, policyType, ncdp_policytype_data);
    var ncdp_premium_dataseries = pushData(premium_indexlist, premiumInd, ncdp_premium_data);
    var ncdp_claim_dataseries = pushData(claim_indexlist, claimInd, ncdp_claim_data);

    // Chart
    drawChart('p_ncdp_enrollment', ncdp_enrollment_dataseries, 'Policy Enrolment');
    drawChart('p_ncdp_policy_type', ncdp_policytype_dataseries, 'Policy Type');
    drawChart('p_ncdp_Premium', ncdp_premium_dataseries, 'Premium');
    drawChart('p_ncdp_cliam', ncdp_claim_dataseries, 'Claim');


// ========================================================== SCDP =======================================================================

    var scdp_enrollment_data = <?= json_encode($scdp_enrollment_data); ?>;
    var scdp_policytype_data = <?= json_encode($scdp_policytype_data); ?>;
    var scdp_premium_data = <?= json_encode($scdp_premium_data); ?>;
    var scdp_claim_data = <?= json_encode($scdp_claim_data); ?>;

    // Data Series
    var scdp_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, scdp_enrollment_data);
    var scdp_policytype_dataseries = pushData(policy_indexlist, policyType, scdp_policytype_data);
    var scdp_premium_dataseries = pushData(premium_indexlist, premiumInd, scdp_premium_data);
    var scdp_claim_dataseries = pushData(claim_indexlist, claimInd, scdp_claim_data);

    // Chart
    drawChart('p_scdp_enrollment', scdp_enrollment_dataseries, 'Policy Enrolment');
    drawChart('p_scdp_policy_type', scdp_policytype_dataseries, 'Policy Type');
    drawChart('p_scdp_Premium', scdp_premium_dataseries, 'Premium');
    drawChart('p_scdp_cliam', scdp_claim_dataseries, 'Claim');


    // ======================================================== Progoti ==================================================================

    var progoti_enrollment_data = <?= json_encode($progoti_enrollment_data); ?>;
    var progoti_policytype_data = <?= json_encode($progoti_policytype_data); ?>;
    var progoti_premium_data = <?= json_encode($progoti_premium_data); ?>;
    var progoti_claim_data = <?= json_encode($progoti_claim_data); ?>;

    // Data Series
    var progoti_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, progoti_enrollment_data);
    var progoti_policytype_dataseries = pushData(policy_indexlist, policyType, progoti_policytype_data);
    var progoti_premium_dataseries = pushData(premium_indexlist, premiumInd, progoti_premium_data);
    var progoti_claim_dataseries = pushData(claim_indexlist, claimInd, progoti_claim_data);

    // Chart
    drawChart('p_progoti_enrollment', progoti_enrollment_dataseries, 'Policy Enrolment');
    drawChart('p_progoti_policy_type', progoti_policytype_dataseries, 'Policy Type');
    drawChart('p_progoti_Premium', progoti_premium_dataseries, 'Premium');
    drawChart('p_progoti_cliam', progoti_claim_dataseries, 'Claim');


    // ========================================================== BCUP ===================================================================

    var bcup_enrollment_data = <?= json_encode($bcup_enrollment_data); ?>;
    var bcup_policytype_data = <?= json_encode($bcup_policytype_data); ?>;
    var bcup_premium_data = <?= json_encode($bcup_premium_data); ?>;
    var bcup_claim_data = <?= json_encode($bcup_claim_data); ?>;

    // Data Series
    var bcup_enrollment_dataseries = pushData(enrollment_indexlist, enrollmentInd, bcup_enrollment_data);
    var bcup_policytype_dataseries = pushData(policy_indexlist, policyType, bcup_policytype_data);
    var bcup_premium_dataseries = pushData(premium_indexlist, premiumInd, bcup_premium_data);
    var bcup_claim_dataseries = pushData(claim_indexlist, claimInd, bcup_claim_data);

    // Chart
    drawChart('p_bcup_enrollment', bcup_enrollment_dataseries, 'Policy Enrolment');
    drawChart('p_bcup_policy_type', bcup_policytype_dataseries, 'Policy Type');
    drawChart('p_bcup_Premium', bcup_premium_dataseries, 'Premium');
    drawChart('p_bcup_cliam', bcup_claim_dataseries, 'Claim');

</script>