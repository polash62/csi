<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding: 0px 5px;">
        <br>
        <!-- END PAGE BAR -->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-check-square"></i>Credit Shield Insurance Financial Information
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_global" data-toggle="tab">Global</a>
                        </li>
                        <li>
                            <a href="#tab_dabi" data-toggle="tab">Dabi</a>
                        </li>
                        <li>
                            <a href="#tab_bcup" data-toggle="tab">BCUP</a>
                        </li>
                        <li>
                            <a href="#tab_progoti" data-toggle="tab">Progoti</a>
                        </li>
                        <li>
                            <a href="#tab_ncdp" data-toggle="tab">NCDP</a>
                        </li>

                        <li>
                            <a href="#tab_scdp" data-toggle="tab">SCDP</a>
                        </li>
                    </ul>


                    <div class="tab-content">

                        <!-- Global -->
                        <div class="tab-pane active" id="tab_global">
                            <h3 class="graph-header"><strong>Global</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="enrollment" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div style="border-radius: 10px;">
                                                <div class="col-md-12">
                                                    <div class="headcol">
                                                        <table class="height-280">
                                                            <thead>
                                                            <tr class="height-45 bg-grey">
                                                                <th class="bg-font-grey border-radius-top-left text-center">Enrolment</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                                <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                    <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                        <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                        <?= $enrollmentInd[$i]['indicator']; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endfor; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="right dashboard-table-scroll">
                                                        <table border="0" class="height-280">
                                                            <thead>
                                                            <tr class="height-45 bg-grey">
                                                                <?php foreach ($monthlist as $i => $month): ?>
                                                                    <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                        <?= $month; ?>
                                                                    </th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                                <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                    <?php foreach ($global_enrollment_data[$i] as $k => $dataindex): ?>
                                                                        <td class="cell booked <?= $i == ($count - 1) && $k == (count($global_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                            <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                        </td>
                                                                    <?php endforeach; ?>
                                                                </tr>
                                                            <?php endfor; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="policy_type" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right height-196 dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($global_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($global_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="Premium" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd);  for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($global_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($global_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="cliam" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    title="Monthly Earned premium = (Total premium amount / loan duration) * No of months passed"' : ''; ?>
                                                                    <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($global_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($global_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DABI -->
                        <div class="tab-pane" id="tab_dabi">
                            <h3 class="graph-header"><strong>Dabi</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">

                                    <div id="p_dabi_enrollment" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div style="border-radius: 10px;">
                                                <div class="col-md-12">
                                                    <div class="headcol">
                                                        <table class="height-280">
                                                            <thead>
                                                            <tr class="height-45 bg-grey">
                                                                <th class="text-center bg-font-grey border-radius-top-left">Enrolment</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                                <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                    <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                        <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                        <?= $enrollmentInd[$i]['indicator']; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endfor; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="right dashboard-table-scroll">
                                                        <table border="0" class="height-280">
                                                            <thead>
                                                            <tr class="height-45 bg-grey">
                                                                <?php foreach ($monthlist as $i => $month): ?>
                                                                    <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                        <?= $month; ?>
                                                                    </th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                                <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                    <?php foreach ($dabi_enrollment_data[$i] as $k => $dataindex): ?>
                                                                        <td class="cell booked <?= $i == ($count - 1) && $k == (count($dabi_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                            <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                        </td>
                                                                    <?php endforeach; ?>
                                                                </tr>
                                                            <?php endfor; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_dabi_policy_type" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($dabi_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($dabi_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_dabi_Premium" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($dabi_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($dabi_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_dabi_cliam" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($dabi_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($dabi_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BCUP -->
                        <div class="tab-pane" id="tab_bcup">
                            <h3 class="graph-header"><strong>BCUP</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_bcup_enrollment" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Enrolment</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                    <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $enrollmentInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table border="0" class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($bcup_enrollment_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($bcup_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_bcup_policy_type" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($bcup_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($bcup_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_bcup_Premium" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($bcup_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($bcup_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_bcup_cliam" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($bcup_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($bcup_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- NCDP -->
                        <div class="tab-pane" id="tab_ncdp">
                            <h3 class="graph-header"><strong>NCDP</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_ncdp_enrollment" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Enrolment</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                    <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $enrollmentInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table border="0" class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($ncdp_enrollment_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($ncdp_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_ncdp_policy_type" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($ncdp_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($ncdp_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_ncdp_Premium" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($ncdp_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($ncdp_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_ncdp_cliam" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < sizeof($claimInd); $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($ncdp_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($ncdp_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SCDP -->
                        <div class="tab-pane" id="tab_scdp">
                            <h3 class="graph-header"><strong>SCDP</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_scdp_enrollment" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Enrolment</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                    <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $enrollmentInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table border="0" class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < sizeof($enrollmentInd); $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($scdp_enrollment_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($scdp_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_scdp_policy_type" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($scdp_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($scdp_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_scdp_Premium" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($scdp_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($scdp_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_scdp_cliam" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($scdp_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($scdp_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Progoti -->
                        <div class="tab-pane" id="tab_progoti">
                            <h3 class="graph-header"><strong>Progoti</strong></h3>
                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_progoti_enrollment" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Enrolment</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == 2 ? 'data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Policy Success Rate = Total No. of Policies / No. of loans disbursed (%)"' : ''; ?>
                                                                    <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $enrollmentInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table border="0" class="height-280">
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($enrollmentInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($progoti_enrollment_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($progoti_enrollment_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 2 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_progoti_policy_type" style="width: 40%;" class="graph-position"></div>
                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Policy Type</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $policyType[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($policyType); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($progoti_policytype_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($progoti_policytype_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-md-6 divborder">
                                    <div id="p_progoti_Premium" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $premiumInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($premiumInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($progoti_premium_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($progoti_premium_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : ($i == 3 || $i == 4) ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 divborder">
                                    <div id="p_progoti_cliam" style="width: 40%;" class="graph-position"></div>

                                    <div class="table-container">
                                        <div class="col-md-12">
                                            <div class="col-md-12 dashboard-table">
                                                <div class="headcol">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <th class="text-center bg-font-grey border-radius-top-left">Claim</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <td <?= $i == $count - 1 ? 'class="border-radius-bottom-left"' : ''; ?>>
                                                                    <?= $claimInd[$i]['indicator']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="right dashboard-table-scroll">
                                                    <table>
                                                        <thead>
                                                        <tr class="height-45 bg-grey">
                                                            <?php foreach ($monthlist as $i => $month): ?>
                                                                <th class="text-center bg-font-grey <?= $i == count($monthlist) - 1 ? 'border-radius-top-right' : ''; ?>">
                                                                    <?= $month; ?>
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $count = sizeof($claimInd); for ($i = 0; $i < $count; $i++): ?>
                                                            <tr class="<?= $i % 2 == 0 ? 'info' : 'success'; ?>">
                                                                <?php foreach ($progoti_claim_data[$i] as $k => $dataindex): ?>
                                                                    <td class="cell booked <?= $i == ($count - 1) && $k == (count($progoti_claim_data[$i]) - 1) ? 'border-radius-bottom-right' : ''; ?>">
                                                                        <?= $dataindex->total === NULL ? 0 : $i == 3 ? number_format((float)$dataindex->total, 2, '.', '') : number_format($dataindex->total); ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
