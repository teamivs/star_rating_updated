<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keywords Management</h3>
                    <div class="card-tools">
                        <a href="<?php echo base_url('keywords/add'); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Keyword
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="get" class="form-inline mb-3">
                        <div class="form-group mr-2">
                            <input type="text" name="keyword" class="form-control" placeholder="Search keyword"
                                value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                        </div>
                        <div class="form-group mr-2">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>" <?= $this->input->get('category') == $cat ? 'selected' : '' ?>>
                                        <?= ucfirst(str_replace('_', ' ', $cat)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?= site_url('keywords') ?>" class="btn btn-secondary ml-2">Reset</a>
                    </form>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <!--<th>ID</th>-->
                                <th>Category</th>
                                <th>Keyword</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($keywords)): ?>
                                <?php foreach ($keywords as $keyword): ?>
                                    <tr>
                                        <!--<td><?php echo $keyword['id']; ?></td>-->
                                        <td><?php echo ucfirst(str_replace('_', ' ', $keyword['category'])); ?></td>
                                        <td><?php echo $keyword['keyword']; ?></td>
                                        <td>
                                            <?php if ($keyword['is_active']): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('keywords/toggle_status/' . $keyword['id']); ?>"
                                                class="btn btn-sm <?php echo $keyword['is_active'] ? 'btn-warning' : 'btn-success'; ?>"
                                                onclick="return confirm('Are you sure you want to <?php echo $keyword['is_active'] ? 'deactivate' : 'activate'; ?> this keyword?');">
                                                <i class="fas fa-power-off"></i>
                                            </a>
                                            <a href="<?php echo site_url('keywords/delete/' . $keyword['id']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this keyword?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No keywords found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>