<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-member"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('panel_title')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                 <div class="col-sm-12">
                <?php if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('usertypeID') == 5)) { ?>
                    <?php if(permissionChecker('invoice_add')) { ?>
                        <h5 class="page-header">
                            <a href="<?php echo base_url('hinvoice/index') ?>">
                                <i class="fa fa-plus"></i> 
                                Add Hostel Invoice
                            </a>  &nbsp; &nbsp;&nbsp;
                           
                        </h5>
                    <?php } ?>
                <?php } ?>
                </div>
                <?php if($this->session->userdata('usertypeID') != 3) { ?>
                    <h5 class="page-header">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right drop-marg">
                            <?php
                                $array = array("0" => $this->lang->line("hmember_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control select2'");
                            ?>
                        </div>
                    </h5>
                <?php } ?>

                <?php
                error_reporting(0);
                 if(customCompute($students) > 0 ) { ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("hmember_all_students")?></a></li>
                            <?php foreach ($sections as $key => $section) {
                                echo '<li class=""><a data-toggle="tab" href="#tab'.$section->classesID.$section->sectionID .'" aria-expanded="false">'. $this->lang->line("hmember_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                            } ?>
                        </ul>

                        <div class="tab-content">
                            <div id="all" class="tab-pane active">
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_photo')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_name')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_roll')?></th>
                                                <th class="col-sm-2">Reg. No</th>
                                                <th class="col-sm-2">Total Fee</th>
                                                <th class="col-sm-2">Discount</th>
                                                <th class="col-sm-2">Join Date</th>
                                                <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(customCompute($students)) {$i = 1; foreach($students as $student) { ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_photo')?>">
                                                        <?=profileimage($student->photo)?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_name')?>">
                                                        <?php echo $student->srname; ?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('hmember_roll')?>">
                                                        <?php echo $student->srroll; ?>
                                                    </td>

                                                    <td data-title="Reg. No.">
                                                        <?php   echo $student->srregisterNO; ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hbalance); ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hostel_discount); ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hjoindate); ?>
                                                    </td>
                                        
                                                    <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <td data-title="<?=$this->lang->line('action')?>">
                                                        <?php
                                                            if($student->hostel == 0) {
                                                                if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                    echo btn_add('hmember/add/'.$student->studentID."/".$student->classesID, $this->lang->line('hmember'));
                                                                }
                                                            } else {
                                                                echo btn_view('hmember/view/'.$student->studentID."/".$student->classesID, $this->lang->line('view')). " ";
                                                                echo btn_invoice('hmember/clearanceslip/'.$student->studentID."/".$student->classesID, 'Clearance Slip'). " ";
                                                                if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                    echo btn_edit_show('hmember/leave/'.$student->studentID."/".$student->classesID, 'Leave'). " ";
                                                                    echo btn_delete('hmember/delete/'.$student->studentID."/".$student->classesID, $this->lang->line('delete'));
                                                                    echo btn_edit('hmember/edit/'.$student->studentID."/".$student->classesID, 'edit'). " ";
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php $i++; }} ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <?php if(customCompute($sections)) { foreach ($sections as $key => $section) { ?>
                                    <div id="tab<?=$section->classesID.$section->sectionID?>" class="tab-pane">
                                        <div id="hide-table">
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                <thead>
                                            <tr>
                                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_photo')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_name')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_roll')?></th>
                                                <th class="col-sm-2">Total Fee</th>
                                                <th class="col-sm-2">Discount</th>
                                                <th class="col-sm-2">Join Date</th>
                                                <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                                <tbody>
                                            <?php if(customCompute($students)) {$i = 1; foreach($students as $student) { ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_photo')?>">
                                                        <?=profileimage($student->photo)?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_name')?>">
                                                        <?php echo $student->srname; ?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('hmember_roll')?>">
                                                        <?php echo $student->srroll; ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hbalance); ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hostel_discount); ?>
                                                    </td>

                                                    <td data-title="Discount">
                                                        <?php //echo $student->hostel_discount; ?>
                                                <?php  echo ($hmember[$student->studentID]->hjoindate); ?>
                                                    </td>
                                        
                                                    <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <td data-title="<?=$this->lang->line('action')?>">
                                                        <?php
                                                            if($student->hostel == 0) {
                                                                if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                    echo btn_add('hmember/add/'.$student->studentID."/".$student->classesID, $this->lang->line('hmember'));
                                                                }
                                                            } else {
                                                                echo btn_view('hmember/view/'.$student->studentID."/".$student->classesID, $this->lang->line('view')). " ";
                                                                if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                    echo btn_edit('hmember/edit/'.$student->studentID."/".$student->classesID, $this->lang->line('edit')). " ";
                                                                    echo btn_delete('hmember/delete/'.$student->studentID."/".$student->classesID, $this->lang->line('delete'));
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php $i++; }} ?>
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                            <?php } } ?>
                        </div>
                    </div> <!-- nav-tabs-custom -->
                <?php } else { ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("hmember_all_students")?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="all" class="tab-pane active">
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_photo')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_name')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_roll')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('hmember_email')?></th>
                                                <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(customCompute($students)) {$i = 1; foreach($students as $student) { ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_photo')?>">
                                                        <?php $array = array(
                                                                "src" => base_url('uploads/images/'.$student->photo),
                                                                'width' => '35px',
                                                                'height' => '35px',
                                                                'class' => 'img-rounded'
                                                            );
                                                            echo img($array);
                                                        ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('hmember_name')?>">
                                                        <?php echo $student->name; ?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('hmember_roll')?>">
                                                        <?php echo $student->roll; ?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('hmember_email')?>">
                                                        <?php echo $student->email; ?>
                                                    </td>
                                        
                                                    <?php if(permissionChecker('hmember_add') || permissionChecker('hmember_edit') || permissionChecker('hmember_delete') || permissionChecker('hmember_view')) { ?>
                                                    <td data-title="<?=$this->lang->line('action')?>">
                                                        <?php
                                                            if($student->hostel == 0) {
                                                                echo btn_add('hmember/add/'.$student->studentID."/".$student->classesID, $this->lang->line('hmember'));
                                                            } else {
                                                                echo btn_view('hmember/view/'.$student->studentID."/".$student->classesID, $this->lang->line('view')). " ";
                                                                echo btn_edit('hmember/edit/'.$student->studentID."/".$student->classesID, $this->lang->line('edit')). " ";
                                                                echo btn_delete('hmember/delete/'.$student->studentID."/".$student->classesID, $this->lang->line('delete'));
                                                            }
                                                        ?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php $i++; }} ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> <!-- nav-tabs-custom -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('load', function() {
        setTimeout(lazyLoad, 1000);
    });

    function lazyLoad() {
        var card_images = document.querySelectorAll('.card-image');
        card_images.forEach(function(card_image) {
            var image_url = card_image.getAttribute('data-image-full');
            var content_image = card_image.querySelector('img');
            content_image.src = image_url;
            content_image.addEventListener('load', function() {
                card_image.style.backgroundImage = 'url(' + image_url + ')';
                card_image.className = card_image.className + ' is-loaded';
            });
        });
    }
</script>

<script type="text/javascript">
    $('.select2').select2();
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('hmember/student_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>