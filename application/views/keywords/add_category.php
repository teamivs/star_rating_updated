<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Category</h3>
                    <div class="card-tools">
                        <a href="<?php echo base_url('keywords'); ?>" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('keywords/save_category'); ?>
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" name="category" id="category" class="form-control" required
                            placeholder="Enter category name">
                        <small class="form-text text-muted">Use underscores for spaces (e.g., service_quality)</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>