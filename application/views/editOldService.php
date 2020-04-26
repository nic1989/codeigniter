<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-plane"></i> Service Management
        <small>Edit Service</small>
      </h1>
    </section>
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Service Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editService" method="post" id="editService" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Application ID</label>
                                        <input type="text" class="form-control" id="applicationId" placeholder="Application Id" name="applicationId" value="<?php echo $serviceInfo->applicationId; ?>" maxlength="255">
                                        <input type="hidden" value="<?php echo $serviceInfo->id; ?>" name="id" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="short_text">Short Text</label>
                                        <input type="text" class="form-control" id="short_text" placeholder="Enter Short Text" name="text" value="<?php echo $serviceInfo->text; ?>" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="domainRange">Domain Range</label>
                                        <input type="text" class="form-control" id="domainRange" placeholder="Domain Range" name="domain_range" value="<?php echo $serviceInfo->domain_range; ?>" maxlength="255">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="msgId">Msg ID</label>
                                        <input type="text" class="form-control" id="msgId" placeholder="Msg ID" name="msgId" value="<?php echo $serviceInfo->msgId; ?>" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="oir">OIR</label>
                                        <input type="text" class="form-control" id="oir" placeholder="OIR" name="oir" value="<?php echo $serviceInfo->oir; ?>" maxlength="255">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logLevel">Log Level</label>
                                        <input type="text" class="form-control" id="logLevel" placeholder="Enter Log Level" name="log_level" value="<?php echo $serviceInfo->log_level; ?>" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <input type="text" class="form-control" id="message" placeholder="Enter Message" name="message" value="<?php echo $serviceInfo->message; ?>" maxlength="255" style="height:100px">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="trouble_ins">Troubleshoot Instructions</label>
                                        <input type="text" class="form-control" id="trouble_ins" placeholder="Enter Troubleshoot Instruction" name="trouble_ins" value="<?php echo $serviceInfo->trouble_ins; ?>" maxlength="255" style="height:100px">
                                    </div>
                                </div>
                            </div>
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>