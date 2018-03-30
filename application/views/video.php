<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>

    .paddingContent{
        padding: 40px;
    }
    .bgcol1{
        background-color: #D0FAF7;
        min-height: 550px !important;
    }
    .paddingVideo{
        padding: 10px;
    }
    .bgColor{
        background-color: #2c7772;
        box-shadow: 0px 0px 60px  purple;
    }
    .bgcol{

        background-color: #0a001f;
        box-shadow: 0px 0px 20px  #004080;
    }
    .center{
        text-align: center;
        border: 3px  solid #512E5F;
    }

</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content bgcol1">
        <div class="page-bar ">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?= site_url(); ?>">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Video Tutorial</span>
                </li>
            </ul>
        </div><br>
        <div class="col-md-10 col-md-offset-1 center rounded-div paddingContent bgColor ">
            <div class=" col-md-12 center paddingVideo bgcol  rounded-div ">
                <video  class="video1 img-responsive col-md-10 col-md-offset-1 " controls >
                    <source src="<?php echo base_url('assets/video/csi-video.mp4'); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
