<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->

            <!-- Dashboard -->
            <li class="nav-item start <?= $active_menu == 'dashboard' ? 'active open' : ''; ?>">
                <a href="<?= site_url(); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>

            <!-- Enrollment Report -->
            <li class="nav-item start <?= $active_menu == 'enrollment' ? 'active open' : ''; ?>">
                <a href="<?= site_url('enrollment') ?>" class="nav-link">
                    <i class="icon-docs"></i>
                    <span class="title">Enrolment Report</span>
                    <span class="selected"></span>
                </a>
            </li>

            <!-- Premium Report -->
            <li class="nav-item start <?= $active_menu == 'premium' ? 'active open' : ''; ?>">
                <a href="<?= site_url('premium') ?>" class="nav-link">
                    <i class="icon-docs"></i>
                    <span class="title">Premium Report</span>
                    <span class="selected"></span>
                </a>
            </li>

            <!-- Claim Report -->
            <li class="nav-item  <?= $active_menu == 'claim' ? 'active open' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Claim Report</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?= isset($active_sub_menu) && $active_sub_menu == 'consolidated' ? 'active open' : ''; ?>">
                        <a href="<?= site_url('claim/consolidated'); ?>" class="nav-link">
                            <span class="title">Consolidated Report</span>
                            <?= isset($active_sub_menu) && $active_sub_menu == 'consolidated' ? '<span class="selected"></span>' : ''; ?>
                        </a>
                    </li>
                    <li class="nav-item  <?= isset($active_sub_menu) && $active_sub_menu == 'detailed' ? 'active open' : ''; ?>">
                        <a href="<?= site_url('claim/detailed'); ?>" class="nav-link">
                            <span class="title">Member Claim Detail and Timeline Report</span>
                            <?= isset($active_sub_menu) && $active_sub_menu == 'detailed' ? '<span class="selected"></span>' : ''; ?>
                        </a>
                    </li>
                </ul>
            </li>

            <?php if (in_array($this->session->userdata('user_level_8'), [276, 277])): ?>
            <!-- Admin -->
            <li class="nav-item  <?= $active_menu == 'admin' ? 'active open' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Admin</span>
                    <span class="arrow <?= $active_menu == 'admin' ? 'open' : ''; ?>"></span>
                </a>
                <ul class="sub-menu">
                    <!-- Data Import -->
                    <li class="nav-item  <?= isset($active_sub_menu) && $active_sub_menu == 'dataimport' ? 'active open' : ''; ?>">
                        <a href="<?= site_url('admin/dataimport'); ?>" class="nav-link ">
                            <span class="title">Data Import</span>
            <?= isset($active_sub_menu) && $active_sub_menu == 'dataimport' ? '<span class="selected"></span>' : ''; ?>
                        </a>
                    </li>

                    <!-- Pull Data -->
                    <li class="nav-item  <?= isset($active_sub_menu) && $active_sub_menu == 'pulldata' ? 'active open' : ''; ?>">
                        <a href="<?= site_url('admin/pulldata'); ?>" class="nav-link ">
                            <span class="title">Pull Data</span>
            <?= isset($active_sub_menu) && $active_sub_menu == 'pulldata' ? '<span class="selected"></span>' : ''; ?>
                        </a>
                    </li>

                    <!-- Data Reprocess -->
                    <li class="nav-item  <?= isset($active_sub_menu) && $active_sub_menu == 'datareprocess' ? 'active open' : ''; ?>">
                        <a href="<?= site_url('admin/datareprocess'); ?>" class="nav-link ">
                            <span class="title">Data Reprocess</span>
            <?= isset($active_sub_menu) && $active_sub_menu == 'datareprocess' ? '<span class="selected"></span>' : ''; ?>
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>


            <li class="nav-item start <?= $active_menu == 'video' ? 'active open' : ''; ?>">
                <a href="<?= site_url('video'); ?>" class="nav-link">
                    <i class="icon-docs"></i>
                    <span class="title">Video</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start">
                <a href="<?= site_url('auth/logout'); ?>" class="nav-link">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>

            <!-- Basic Profile Report -->
            <!--<li class="nav-item start <?/*= $active_menu == 'basic' ? 'active open' : ''; */?>">
                <a href="<?/*= site_url('basic') */?>" class="nav-link">
                    <i class="icon-docs"></i>
                    <span class="title">Basic Profile Report</span>
                    <span class="selected"></span>
                </a>
            </li>-->
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->