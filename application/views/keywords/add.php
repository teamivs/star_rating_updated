<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Keyword</h3>
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

                    <?php echo form_open('keywords/save'); ?>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>"><?= ucfirst(str_replace('_', ' ', $cat)) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keyword">Keyword</label>
                        <input type="text" name="keyword" id="keyword" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                value="1" checked>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Keyword</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>