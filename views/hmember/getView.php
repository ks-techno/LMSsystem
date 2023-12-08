
<?php if(customCompute($student)) { ?>
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')"><span class="fa fa-print"></span> <?=$this->lang->line('print')?> </button>
                <?=btn_add_pdf('hmember/print_preview/'.$student->studentID."/".$set, $this->lang->line('pdf_preview')); ?>
                <?php
                    if(customCompute($hmember)) {
                        if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                            if(permissionChecker('hmember_edit')) { 
                                echo btn_sm_edit('hmember/edit/'.$hmember->studentID."/".$set, $this->lang->line('edit')); 
                            }
                        }
                    }
                ?>
                <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#mail"><span class="fa fa-envelope-o"></span> <?=$this->lang->line('mail')?></button>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("hmember/index/$set")?>"><?=$this->lang->line('panel_title')?></a></li>
                    <li class="active"><?=$this->lang->line('view')?></li>
                </ol>
            </div>
        </div>
    </div>
<?php } ?>

<?php if(customCompute($student)) { ?>
    <div id="printablediv">
        <div class="row">
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <?=profileviewimage($student->photo)?>
                        <h3 class="student-username text-center"><?=$student->srname?></h3>
                        <p class="text-muted text-center"><?=isset($usertypes[$student->usertypeID]) ? $usertypes[$student->usertypeID] : ''?></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item" style="background-color: #FFF">
                                <b><?=$this->lang->line('hmember_registerNO')?></b> <a class="pull-right"><?=$student->srregisterNO?></a>
                            </li>
                            <li class="list-group-item" style="background-color: #FFF">
                                <b><?=$this->lang->line('hmember_roll')?></b> <a class="pull-right"><?=$student->srroll?></a>
                            </li>
                            <li class="list-group-item" style="background-color: #FFF">
                                <b><?=$this->lang->line('hmember_classes')?></b> <a class="pull-right"><?=customCompute($class) ? $class->classes : ''?></a>
                            </li>
                            <li class="list-group-item" style="background-color: #FFF">
                                <b><?=$this->lang->line('menu_section')?></b> <a class="pull-right"><?=customCompute($section) ? $section->section : ''?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab"><?=$this->lang->line('hmember_profile')?></a></li>
                        <li><a href="#document" data-toggle="tab"><?=$this->lang->line('student_document')?></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="active tab-pane" id="profile">
                            <div class="panel-body profile-view-dis">
                                <div class="row">
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_dob")?> </span>: <?php if($student->dob) { echo date("d M Y", strtotime($student->dob)); }?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_sex")?> </span>: <?=$student->sex?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_email")?> </span>: <?=$student->email?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_phone")?> </span>: <?=$student->phone?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_hname")?> </span>: <?=customCompute($hostel) ? $hostel->name : 'N/A' ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_htype")?> </span>: <?=customCompute($hostel) ? $hostel->htype : 'N/A' ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_class_type")?> </span>: <?=customCompute($category) ? $category->class_type : 'N/A' ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_tfee")?> </span>: <?=customCompute($hmember) ? $hmember->hbalance : 'N/A' ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_hostel_address")?> </span>: <?=customCompute($hostel) ? $hostel->address : 'N/A' ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_joindate")?> </span>: <?php if(customCompute($hmember)) { if($hmember->hjoindate) { echo date("d M Y", strtotime($hmember->hjoindate)); } } else { echo 'N/A'; } ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_religion")?> </span>: <?=$student->religion?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_bloodgroup")?> </span>: <?php if(isset($allbloodgroup[$student->bloodgroup])) { echo $student->bloodgroup; } ?></p>
                                    </div>
                                    
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_state")?> </span>: <?=$student->state?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_country")?> </span>: <?php if(isset($allcountry[$student->country])) { echo $allcountry[$student->country]; } ?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_remarks")?> </span>: <?=$student->remarks?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_address")?> </span>: <?=$student->address?></p>
                                    </div>
                                    <div class="profile-view-tab">
                                        <p><span><?=$this->lang->line("hmember_extracurricularactivities")?> </span>: <?=$student->extracurricularactivities?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="document">
                                <?php if(permissionChecker('student_add')) { ?>
                                    <input class="btn btn-success btn-sm" style="margin-bottom: 10px" type="button" value="<?=$this->lang->line('student_add_document')?>" data-toggle="modal" data-target="#documentupload">
                                <?php } ?>
                                <div id="hide-table">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?=$this->lang->line('slno')?></th>
                                                <th><?=$this->lang->line('student_title')?></th>
                                                <th><?=$this->lang->line('student_date')?></th>
                                                <th><?=$this->lang->line('action')?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(customCompute($documents)) { $i = 1; foreach ($documents as $document) {  ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('student_title')?>">
                                                        <?=$document->title?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('student_date')?>">
                                                        <?=date('d M Y', strtotime($document->create_date))?>
                                                    </td>

                                                    <td data-title="<?=$this->lang->line('action')?>">
                                                        <?php  
                                                            if((permissionChecker('student_add') && permissionChecker('student_delete')) || ($this->session->userdata('usertypeID') == 3 && $this->session->userdata('loginuserID') == $profile->srstudentID)) {
                                                                echo btn_download('student/download_document/'.$document->documentID.'/'.$profile->srstudentID.'/'.$profile->srclassesID, $this->lang->line('download'));
                                                            }
                                                            
                                                            if(permissionChecker('student_add') && permissionChecker('student_delete')) {
                                                                echo btn_delete_show('student/delete_document/'.$document->documentID.'/'.$profile->srstudentID."/".$profile->srclassesID, $this->lang->line('delete'));
                                                            } 
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php $i++; } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>

<?php if(customCompute($student)) { ?>
    <!-- email modal starts here -->
    <form class="form-horizontal" role="form" action="<?=base_url('hmember/send_mail');?>" method="post">
        <div class="modal fade" id="mail">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?=$this->lang->line('mail')?></h4>
                </div>
                <div class="modal-body">
                
                    <?php 
                        if(form_error('to')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="to" class="col-sm-2 control-label">
                            <?=$this->lang->line("to")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="to" name="to" value="<?=set_value('to')?>" >
                        </div>
                        <span class="col-sm-4 control-label" id="to_error">
                        </span>
                    </div>

                    <?php 
                        if(form_error('subject')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="subject" class="col-sm-2 control-label">
                            <?=$this->lang->line("subject")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subject" name="subject" value="<?=set_value('subject')?>" >
                        </div>
                        <span class="col-sm-4 control-label" id="subject_error">
                        </span>

                    </div>

                    <?php 
                        if(form_error('message')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="message" class="col-sm-2 control-label">
                            <?=$this->lang->line("message")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="message" style="resize: vertical;" name="message" value="<?=set_value('message')?>" ></textarea>
                        </div>
                    </div>

                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                    <input type="button" id="send_pdf" class="btn btn-success" value="<?=$this->lang->line("send")?>" />
                </div>
            </div>
          </div>
        </div>
    </form>
    <!-- email end here -->  

    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            window.location.reload();
        }
        
        function closeWindow() {
            location.reload(); 
        }

        function check_email(email) {
            var status = false;     
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (email.search(emailRegEx) == -1) {
                $("#to_error").html('');
                $("#to_error").html("<?=$this->lang->line('mail_valid')?>").css("text-align", "left").css("color", 'red');
            } else {
                status = true;
            }
            return status;
        }


        $("#send_pdf").click(function(){
            var to = $('#to').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            var id = "<?=$student->studentID;?>";
            var set = "<?=$set;?>";
            var error = 0;

            $("#to_error").html("");
            if(to == "" || to == null) {
                error++;
                $("#to_error").html("<?=$this->lang->line('mail_to')?>").css("text-align", "left").css("color", 'red');
            } else {
                if(check_email(to) == false) {
                    error++
                }
            } 

            if(subject == "" || subject == null) {
                error++;
                $("#subject_error").html("");
                $("#subject_error").html("<?=$this->lang->line('mail_subject')?>").css("text-align", "left").css("color", 'red');
            } else {
                $("#subject_error").html("");
            }

            if(error == 0) {
                $('#send_pdf').attr('disabled','disabled');
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url('hmember/send_mail')?>",
                    data: 'to='+ to + '&subject=' + subject + "&studentID=" + id+ "&message=" + message+ "&classesID=" + set,
                    dataType: "html",
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.status == false) {
                            $('#send_pdf').removeAttr('disabled');
                            $.each(response, function(index, value) {
                                if(index != 'status') {
                                    toastr["error"](value)
                                    toastr.options = {
                                      "closeButton": true,
                                      "debug": false,
                                      "newestOnTop": false,
                                      "progressBar": false,
                                      "positionClass": "toast-top-right",
                                      "preventDuplicates": false,
                                      "onclick": null,
                                      "showDuration": "500",
                                      "hideDuration": "500",
                                      "timeOut": "5000",
                                      "extendedTimeOut": "1000",
                                      "showEasing": "swing",
                                      "hideEasing": "linear",
                                      "showMethod": "fadeIn",
                                      "hideMethod": "fadeOut"
                                    }
                                }
                            });
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });
    </script>
<?php } ?>


    <?php if(permissionChecker('student_add')) { ?>
        <form id="documentUploadDataForm" class="form-horizontal" enctype="multipart/form-data" role="form" action="<?=base_url('student/send_mail');?>" method="post">
            <div class="modal fade" id="documentupload">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><?=$this->lang->line('student_document_upload')?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" >
                            <label for="title" class="col-sm-2 control-label">
                                <?=$this->lang->line("student_title")?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title')?>" >
                            </div>
                            <span class="col-sm-4 control-label" id="title_error">
                            </span>
                        </div>

                        <div class="form-group">
                           <label for="file" class="col-sm-2 control-label">
                                <?=$this->lang->line("student_file")?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="fa fa-remove"></span>
                                            <?=$this->lang->line('student_clear')?>
                                        </button>
                                        <div class="btn btn-success image-preview-input">
                                            <span class="fa fa-repeat"></span>
                                            <span class="image-preview-input-title">
                                            <?=$this->lang->line('student_file_browse')?></span>
                                            <input type="file" id="file" name="file"/>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <span class="col-sm-4 control-label" id="file_error">
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                        <input type="button" id="uploadfile" class="btn btn-success" value="<?=$this->lang->line("student_upload")?>" />
                    </div>
                </div>
              </div>
            </div>
        </form>

        <script type="text/javascript">
            $(document).on('click', '#uploadfile', function() {
                var title = $('#title').val();
                var file = $('#file').val();
                var error = 0;

                if(title == '' || title == null) {
                    error++;
                    $('#title_error').html("<?=$this->lang->line('student_title_required')?>");
                    $('#title_error').parent().addClass('has-error');
                } else {
                    $('#title_error').html('');
                    $('#title_error').parent().removeClass('has-error');
                }

                if(file == '' || file == null) {
                    error++;
                    $('#file_error').html("<?=$this->lang->line('student_file_required')?>");
                    $('#file_error').parent().addClass('has-error');
                } else {
                    $('#file_error').html('');
                    $('#file_error').parent().removeClass('has-error');
                }

                if(error == 0) {
                    var studentID = "<?=$profile->srstudentID?>";
                    var formData = new FormData($('#documentUploadDataForm')[0]);
                    formData.append("studentID", studentID);
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "<?=base_url('student/documentUpload')?>",
                        data: formData,
                        async: false,
                        dataType: "html",
                        success: function(data) {
                            var response = jQuery.parseJSON(data);
                            if(response.status) {
                                $('#title_error').html();
                                $('#title_error').parent().removeClass('has-error');

                                $('#file_error').html();
                                $('#file_error').parent().removeClass('has-error');
                                location.reload();
                            } else {
                                if(response.errors['title']) {
                                    $('#title_error').html(response.errors['title']);
                                    $('#title_error').parent().addClass('has-error');
                                } else {
                                    $('#title_error').html();
                                    $('#title_error').parent().removeClass('has-error');
                                }
                                
                                if(response.errors['file']) {
                                    $('#file_error').html(response.errors['file']);
                                    $('#file_error').parent().addClass('has-error');
                                } else {
                                    $('#file_error').html();
                                    $('#file_error').parent().removeClass('has-error');
                                }
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
            });     

            $(function() {
                var closebtn = $('<button/>', {
                    type:"button",
                    text: 'x',
                    id: 'close-preview',
                    style: 'font-size: initial;',
                });
                closebtn.attr("class","close pull-right");

                $('.image-preview').popover({
                    trigger:'manual',
                    html:true,
                    title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                    content: "There's no image",
                    placement:'bottom'
                });

                $('.image-preview-clear').click(function(){
                    $('.image-preview').attr("data-content","").popover('hide');
                    $('.image-preview-filename').val("");
                    $('.image-preview-clear').hide();
                    $('.image-preview-input input:file').val("");
                    $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
                });

                $(".image-preview-input input:file").change(function (){
                    var img = $('<img/>', {
                        id: 'dynamic',
                        width:250,
                        height:200,
                        overflow:'hidden'
                    });

                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
                        $(".image-preview-clear").show();
                        $(".image-preview-filename").val(file.name);
                    }
                    reader.readAsDataURL(file);
                });
            });
        </script>
    <?php } ?>