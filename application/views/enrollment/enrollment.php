<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= site_url(); ?>">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Enrolment Report</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->

        <div class="col-md-12">
            <?php $attr = []; ?>
            <div id="selectors">
                <?= form_open(site_url('enrollment'), $attr) ?>
                <div class="row">
                    <div class="col-md-6 no-padding-left">
                        <div class="form-group">

                            <!-- Project Selector -->
                            <div class="col-md-6 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Project :</label>

                                    <?php if (isset($associateproject)): ?>
                                        <?php if ($csiProject == 1): ?>
                                            <select class="form-control input-sm" name="prog_selector" id="proj_selector">
                                                <option value=""> -- Select -- </option>
                                                <option value="1,15" <?= $projectdata->id == 1 ? 'selected' : '' ?>>DABI</option>
                                                <option value="2,279" <?= $projectdata->id == 2 ? 'selected' : '' ?>>BCUP</option>
                                            </select>
                                        <?php else: ?>
                                            <input type="text" class="form-control input-sm" disabled value="<?= trim($associateproject->project_name); ?>" />
                                            <input type="hidden" name="prog_selector" value="<?= $associateproject->id . ',' . $associateproject->project_code; ?>" />
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <select class="form-control input-sm" name="prog_selector" id="proj_selector" <?= $admin ? 'required' : ''; ?>>
                                            <option value=""> -- Select -- </option>
                                            <?php if (count($project)): ?>
                                                <?php foreach ($project as $p): ?>
                                                    <option value="<?= $p->id . ',' . $p->project_code; ?>" <?= isset($projectdata) && $projectdata->id == $p->id ? 'selected' : '' ?>><?= $p->project_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Product Selector -->
                            <div class="col-md-6 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Product :</label>
                                    <select class="form-control input-sm" name="prod_selector" id="prod_selector">
                                        <option value=""> -- Select -- </option>

                                        <!-- After submission -->
                                        <?php if (isset($productRows)): ?>
                                            <?php foreach ($productRows as $row): ?>
                                                <option value="<?= $row->id; ?>" <?= isset($productdata) && $productdata->id == $row->id ? 'selected' : '' ?>><?= $row->product_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 no-padding-left">
                        <div class="form-group">

                            <!-- Division Selector -->
                            <div class="col-md-3 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Division Name :</label>
                                    <?php if (isset($associatedivision)): ?>
                                        <div id="disabledDivisionInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'none' : 'block' ?>">
                                            <input type="text" class="form-control input-sm" disabled value="<?= trim($associatedivision->division_name); ?>" />
                                            <input type="hidden" name="div_selector" value="<?= $associatedivision->id ?>" id="div_selector" />
                                        </div>
                                        <div id="selectBoxDivisionInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'block' : 'none' ?>">
                                            <select class="form-control input-sm" name="div_selector" id="div_selector_ass">
                                                <option value=""> -- Select -- </option>

                                                <!-- After submission -->
                                                <?php if (isset($divisionRows)): ?>
                                                    <?php foreach ($divisionRows as $row): ?>
                                                        <option value="<?= $row->id ?>" <?= isset($divisiondata) && $divisiondata->id == $row->id ? 'selected' : '' ?>><?= $row->division_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <select class="form-control input-sm" name="div_selector" id="div_selector">
                                            <option value=""> -- Select -- </option>

                                            <!-- After submission -->
                                            <?php if (isset($divisionRows)): ?>
                                                <?php foreach ($divisionRows as $row): ?>
                                                    <option value="<?= $row->id ?>" <?= isset($divisiondata) && $divisiondata->id == $row->id ? 'selected' : '' ?>><?= $row->division_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Region Selector -->
                            <div class="col-md-3 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Region Name :</label>
                                    <?php if (isset($associateregion)): ?>
                                        <div id="disabledRegionInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'none' : 'block' ?>" >
                                            <input type="text" class="form-control input-sm" disabled value="<?= trim($associateregion->region_name); ?>" />
                                            <input type="hidden" name="reg_selector" value="<?= $associateregion->id ?>" id="reg_selector" />
                                        </div>

                                        <div id="selectBoxRegionInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'block' : 'none' ?>">
                                            <select class="form-control input-sm" name="reg_selector" id="reg_selector_ass">
                                                <option value=""> -- Select -- </option>

                                                <!-- After submission -->
                                                <?php if (isset($regionRows)): ?>
                                                    <?php foreach ($regionRows as $row): ?>
                                                        <option value="<?= $row->id ?>" <?= isset($regiondata) && $regiondata->id == $row->id ? 'selected' : '' ?>><?= $row->region_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <select class="form-control input-sm" name="reg_selector" id="reg_selector">
                                            <option value=""> -- Select -- </option>

                                            <!-- After submission -->
                                            <?php if (isset($regionRows)): ?>
                                                <?php foreach ($regionRows as $row): ?>
                                                    <option value="<?= $row->id ?>" <?= isset($regiondata) && $regiondata->id == $row->id ? 'selected' : '' ?>><?= $row->region_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Area Selector -->
                            <div class="col-md-3 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Area Name :</label>
                                    <?php if (isset($associatearea)): ?>
                                        <div id="disabledAreaInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'none' : 'block' ?>">
                                            <input type="text"
                                                   class="form-control input-sm"
                                                   disabled
                                                   value="<?= trim($associatearea->area_name); ?>" />
                                            <input type="hidden" name="area_selector" value="<?= $associatearea->id ?>" id="area_selector" />
                                        </div>
                                        <div id="selectBoxAreaInput" style="display: <?= ($csiProject == 1 && $projectdata->id == 2) ? 'block' : 'none' ?>">
                                            <select class="form-control input-sm" name="area_selector" id="area_selector_ass">
                                                <option value=""> -- Select -- </option>

                                                <!-- After submission -->
                                                <?php if (isset($areaRows)): ?>
                                                    <?php foreach ($areaRows as $row): ?>
                                                        <option value="<?= $row->id ?>" <?= isset($areadata) && $areadata->id == $row->id ? 'selected' : '' ?>><?= $row->area_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <select class="form-control input-sm" name="area_selector" id="area_selector">
                                            <option value=""> -- Select -- </option>

                                            <!-- After submission -->
                                            <?php if (isset($areaRows)): ?>
                                                <?php foreach ($areaRows as $row): ?>
                                                    <option value="<?= $row->id ?>" <?= isset($areadata) && $areadata->id == $row->id ? 'selected' : '' ?>><?= $row->area_name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Branch Selector -->
                            <div class="col-md-3 no-padding-left">
                                <div class="form-group">
                                    <label class="font-size-12">Branch Name :</label>
                                    <select class="form-control input-sm" name="branch_selector" id="branch_selector">
                                        <option value=""> -- Select -- </option>

                                        <!-- After submission -->
                                        <?php if (isset($branchRows)): ?>
                                            <?php foreach ($branchRows as $row): ?>
                                                <option value="<?= $row->branch_code ?>" <?= isset($branchdata) && $branchdata->branch_code == $row->branch_code ? 'selected' : '' ?>><?= $row->branch_code ?>-<?= $row->branch_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 no-padding-left">

                        <!-- Month Range Selector -->
                        <div class="col-md-3 no-padding-left">
                            <div class="form-group">
                                <label class="font-size-12">Select Month Range :</label>
                                <div class="input-group date-picker input-daterange">
                                    <input type="text" class="form-control input-sm date_picker_from_class" name="from" required value="<?= isset($from) ? $from : date('Y-m', strtotime($maxdate . "-12 months")); ?>">
                                    <span class="input-group-addon"> to </span>
                                    <input type="text" class="form-control input-sm date_picker_to_class" name="to" required value="<?= isset($to) ? $to : date('Y-m', strtotime($maxdate)) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 no-padding-left">
                            <div class="form-actions">
                                <div class="btn-group padding-top-24">

                                    <!-- Form Submit Button -->
                                    <?php
                                    $data = [
                                        'name' => 'enroll-rep-submit',
                                        'class' => 'btn btn-sm green-meadow',
                                        'type' => 'submit',
                                        'content' => 'Submit',
                                        'value' => 'enroll-Submit'
                                    ];
                                    echo form_button($data);
                                    ?>

                                    <!-- Reset -->
                                    <div class="btn-group padding-left-10">
                                        <button class="btn btn-sm red" onclick="location.reload();">Reset</button>
                                    </div>

                                    <!-- Items -->
                                    <div class="btn-group padding-left-10 dropdown" id="items-dropdown">
                                        <button class="btn blue dropdown-toggle btn-sm" data-toggle="dropdown">Items
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($trend_indicator as $i => $indicator): ?>
                                                <?php if (!$indicator->default_or_not && trim($indicator->data_source) == 'xyz'): ?>
                                                    <li class="dropdown-submenuu" data-value="<?= $indicator->id; ?>">
                                                        <div class="radio">
                                                            <label for="indicatortitle<?= $indicator->id; ?>"><input type="radio" name="indicator"> <?= $indicator->indicator; ?></label>
                                                        </div>
                                                        <ul class="dropdown-menu hidden indi-submenu" id="indi-submenu<?= $indicator->id; ?>">
                                                            <li data-value="all_<?= $indicator->indicatormaster_id; ?>"
                                                                tabIndex="-1"
                                                                class="hid-indicators"
                                                                id="all_<?= $indicator->indicatormaster_id; ?>">
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" id="allIndicators" value="all"> Select All</label>
                                                                </div>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <?php foreach ($trend_indicator as $indi): ?>
                                                                <?php if (!$indicator->default_or_not && trim($indi->data_source) != 'xyz' && $indicator->indicatormaster_id == $indi->indicatormaster_id): ?>
                                                                    <li data-value="<?= $indi->id; ?>,<?= $indicator->id; ?>"
                                                                        data-master-id="<?= $indicator->indicatormaster_id ?>"
                                                                        class="indicate_<?= $indi->indicatormaster_id; ?> hid-indicators"
                                                                        tabIndex="-1">
                                                                        <div class="checkbox">
                                                                            <label for="indicator<?= $indi->id; ?>"><input type="checkbox" id="indicator<?= $indi->id; ?>" name="indicator"> <?= $indi->indicator; ?></label>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="divider"></li>
                                            <li id="allIndi" data-value="all-inidicators-selected">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" value="all"> Select All</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- log data -->
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" id="actionExcel" name="actionExcel" value="<?php echo $actionExcel; ?>">
                                    <!-- Export -->
                                    <div class="btn-group padding-left-10">
                                        <button class="btn green dropdown-toggle btn-sm" data-toggle="dropdown">Export
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu" style="min-width: 120px;font-size: 12px;">
                                            <li id="excelExport" >
                                                <a href="javascript:void(0)"> Save As Excel </a>
                                            </li>
                                            <!--<li id="PDFExport">
                                                <a href="javascript:void(0)"> Save As PDF</a>
                                            </li>-->
                                            <!--<li onclick="window.print()">
                                                <a href="#" > Print Report </a>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>

            <?php if ($showTable): ?>
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="portlet light bordered">

                            <!-- Filter Names -->
                            <div class="portlet-title" id="search-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-dark hide"></i>
                                    <span class="caption-subject font-dark bold" style="font-size: 12px">       
                                        <?= isset($productdata) ? 'Product: ' . $productdata->product_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?= isset($divisiondata) ? 'Division: ' . $divisiondata->division_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?= isset($regiondata) ? 'Region: ' . $regiondata->region_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?= isset($areadata) ? 'Area: ' . $areadata->area_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <?= isset($branchdata) ? 'Branch: ' . $branchdata->branch_code . ' - ' . $branchdata->branch_name : '' ?>
                                    </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- Fetching Datas using json -->
                                <!--<table data-toggle="table" data-url="<?/*= base_url('assets/global/plugins/bootstrap-table/data/data1.json') */?>" data-height="365">
                                    <thead>
                                    <tr>
                                        <th data-field="id">Sl.</th>
                                        <th data-field="name">Item Name</th>
                                        <th data-field="price">Feb-2016</th>
                                        <th data-field="id2">Mar-2016</th>
                                        <th data-field="name2">Apr-2016</th>
                                        <th data-field="price2">May-2016</th>
                                        <th data-field="id3">Jun-2016</th>
                                        <th data-field="name3">Jul-2016</th>
                                        <th data-field="price3">Aug-2016</th>
                                        <th data-field="id4">Sep-2016</th>
                                        <th data-field="name4">Oct-2016</th>
                                        <th data-field="price4">Nov-2016</th>
                                        <th data-field="id5">Dec-2016</th>
                                        <th data-field="name5">Jan-2017</th>
                                    </tr>
                                    </thead>
                                </table>-->

                                <section id="printReport">

                                    <!-- Report Header (Export Only) -->
                                    <div class="col-md-12" id="report">
                                        <div class="row">
                                            <div class="col-md-4 text-center" id="global-report">
                                                <h5 id="report-excel-title">Credit Shield Insurance Enrolment Report as on <?= isset($to) ? $to : date('F Y', strtotime($maxdate)) ?> (<?= trim($projectdata->project_name) ?>)</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 id="brac-mf">BRAC Microfinance</h5>
                                                <h6 id="report-name">Enrolment Report</h6>
                                            </div>
                                            <div class="col-md-4 pull-right" id="printed_date">
                                                Printed Date: <?= date('d/m/y'); ?>
                                            </div>
                                        </div>
                                        <div class="portlet-title" id="print-search-filters">
                                            <div class="caption">
                                                <i class="icon-social-dribbble font-dark hide"></i>
                                                <span class="caption-subject font-dark bold" style="font-size: 12px" id="search-filters-title">
                                                    <span id="projName" class="hidden"><?= $projectdata->project_name; ?></span>
                                                    <span id="prodName"> <?= isset($productdata) ? 'Product: ' . $productdata->product_name . '</span>' : '' ?> &nbsp;&nbsp;&nbsp;&nbsp;                                      
                                                        <span id="divName"><?= isset($divisiondata) ? 'Division: ' . $divisiondata->division_name . '</span>' : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span id="regName"><?= isset($regiondata) ? 'Region: ' . $regiondata->region_name . '</span>' : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span id="areaName"><?= isset($areadata) ? 'Area: ' . $areadata->area_name . '</span>' : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <span id="brName"><?= isset($branchdata) ? 'Branch: ' . $branchdata->branch_code . ' - ' . $branchdata->branch_name . '</span>' : '' ?>
                                                                    </span>
                                                                    </div>
                                                                    </div>
                                                                    </div>

                                                                    <!-- Fetching Datas normally -->
                                                                    <!-- Report Details Table -->
                                                                    <table data-toggle="table" data-height="calc(100vh - 322px)" id="report-details">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.</th>
                                                                                <th>Item Name</th>
                                                                                <?php foreach ($monthlist as $month): ?>
                                                                                    <th><?= $month; ?></th>
                                                                                <?php endforeach; ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($trend_indicator as $i => $indicator): ?>
                                                                                <tr data-value="<?= $indicator->id ?>" data-master-id="<?= $indicator->indicatormaster_id ?>" id="indicator_<?= $indicator->id ?>" class="indi_<?= $indicator->indicatormaster_id ?> <?= $indicator->default_or_not ? '' : 'hidden hidden-indicators' ?> <?= trim($indicator->data_source) == 'xyz' ? 'success indicator-title"' : ''; ?> <?= trim($indicator->data_source) != 'xyz' && !$indicator->default_or_not ? 'danger"' : ''; ?>">
                                                                                    <td>
                                                                                        <?php if (!$indicator->default_or_not && trim($indicator->data_source) != 'xyz'): ?>
                                                                                            <span class="removable-row">
                                                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                                            </span>
                                                                                        <?php endif; ?>
                                                                                        <?= trim($indicator->data_source) == 'xyz' ? '<b>' . trim($indicator->item_no) . '</b>' : '' ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?= trim($indicator->data_source) == 'xyz' ? '<b>' . trim($indicator->indicator) . '</b>' : trim($indicator->indicator); ?>
                                                                                    </td>

                                                                                    <?php foreach ($project_master[$i] as $pm): ?>
                                                                                        <td <?= trim($indicator->data_source) == 'xyz' ? 'class="full-row"' : '' ?>>
                                                                                            <?= trim($indicator->data_source) == 'xyz' ? '' : ($pm->total === NULL ? 0 : number_format($pm->total)); ?>
                                                                                        </td>
                                                                                    <?php endforeach; ?>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>

                                                                    </section>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                </div>
                                                                </div>
                                                                <!-- END CONTENT BODY -->
                                                                </div>
                                                                <!-- END CONTENT -->                                                                                                                               
                                                                