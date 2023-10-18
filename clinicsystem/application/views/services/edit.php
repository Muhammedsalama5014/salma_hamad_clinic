<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <?php echo form_open_multipart($this->uri->uri_string()); ?>
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-wheelchair"></i> <?php echo translate('update') . " " . translate('services'); ?></h4>
                </div>
                <div class="panel-body">
                    <!-- basic details -->

                    <div class="row">
                        <div class="col-md-6 mb-sm">
                            <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                                <label class="control-label"><?php echo translate('name'); ?> <span class="required">*</span></label>
                                
                                    <input class="form-control" name="name" type="text"  value="<?php echo $services['name']; ?>">

                                    <input class="form-control" name="id" type="hidden"  value="<?php echo $services['id']; ?>">
                                <span class="error"><?php echo form_error('name'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-sm">
                            <div class="form-group <?php if (form_error('amount')) echo 'has-error'; ?>">
                                <label class="control-label"><?php echo translate('amount'); ?> <span class="required">*</span></label>
                                
                                    <input class="form-control" name="amount" type="text"    required value="<?php echo $services['amount']; ?>">
                                <span class="error"><?php echo form_error('amount'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-sm">
                            <div class="form-group <?php if (form_error('from date')) echo 'has-error'; ?>">
                                <label class="control-label"><?php echo translate('from'); ?> <span class="required">*</span></label>
                                
                                    <input class="form-control" name="from_date" type="date" required value="<?php echo $services['from_date']; ?>">
                                <span class="error"><?php echo form_error('from_date'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-sm">
                            <div class="form-group <?php if (form_error('to date')) echo 'has-error'; ?>">
                                <label class="control-label"><?php echo translate('to'); ?> <span class="required">*</span></label>
                                
                                    <input class="form-control" name="to_date" type="date"  required value="<?php echo $services['to_date']; ?>">
                                <span class="error"><?php echo form_error('to_date'); ?></span>
                            </div>
                        </div>
                        
                        
                    </div>

                    
                    </div>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-offset-10 col-md-2">
                            <button type="submit" name="update" value="1" class="btn btn btn-default btn-block"><i class="fas fa-plus-circle"></i> <?php echo translate('update'); ?></button>
                        </div>
                    </div>
                </footer>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>