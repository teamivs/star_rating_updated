<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keywords Management</h3>
                    <div class="card-tools">
                        <a href="<?php echo base_url('keywords/add_category'); ?>" class="btn btn-success btn-sm mr-2">
                            <i class="fas fa-plus"></i> Add Category
                        </a>
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

                    <form method="get" class="form-inline mb-3 flex-wrap">
                        <div class="form-group mr-2 mb-2">
                            <input type="text" name="keyword" class="form-control" placeholder="Search Keyword"
                                value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                        </div>
                        <div class="form-group mr-2 mb-2">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>" <?= $this->input->get('category') == $cat ? 'selected' : '' ?>>
                                        <?= ucfirst(str_replace('_', ' ', $cat)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                            <a href="<?= site_url('keywords') ?>" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
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
                                            <td><?php echo ucfirst(str_replace('_', ' ', $keyword['category'])); ?></td>
                                            <td><?php echo $keyword['keyword']; ?></td>
                                            <td>
                                                <?php if ($keyword['is_active']): ?>
                                                    <span class="badge badge-success status-badge">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger status-badge">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo site_url('keywords/toggle_status/' . $keyword['id']); ?>"
                                                        class="btn btn-sm toggle-status <?php echo $keyword['is_active'] ? 'btn-warning' : 'btn-success'; ?>"
                                                        data-id="<?php echo $keyword['id']; ?>"
                                                        data-status="<?php echo $keyword['is_active']; ?>">
                                                        <i class="fas fa-power-off"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('keywords/delete/' . $keyword['id']); ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this keyword?');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No keywords found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin: 0;
        border-radius: 0;
    }

    .card-body {
        padding: 1.25rem;
    }

    .table-responsive {
        margin: 0;
        padding: 0;
    }

    .table {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }

        .card-tools {
            margin-top: 10px;
            width: 100%;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        .form-inline {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .form-group {
            margin-right: 0 !important;
            width: 100%;
        }

        .form-control {
            width: 100%;
        }

        .table-responsive {
            margin: 0;
            padding: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .btn-group {
            display: flex;
            gap: 5px;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }

        .table td,
        .table th {
            padding: 8px;
            font-size: 14px;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 12px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        // Handle toggle status click
        $('.toggle-status').click(function(e) {
            e.preventDefault();
            var link = $(this);
            var id = link.data('id');
            var currentStatus = parseInt(link.data('status'));
            var newStatus = currentStatus ? 0 : 1;

            if (confirm('Are you sure you want to ' + (currentStatus ? 'deactivate' : 'activate') + ' this keyword?')) {
                $.ajax({
                    url: '<?php echo site_url("keywords/toggle_status/"); ?>' + id,
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(response) {
                        // Update button appearance
                        if (newStatus) {
                            link.removeClass('btn-success').addClass('btn-warning');
                            link.closest('tr').find('.status-badge').removeClass('badge-danger').addClass('badge-success').text('Active');
                        } else {
                            link.removeClass('btn-warning').addClass('btn-success');
                            link.closest('tr').find('.status-badge').removeClass('badge-success').addClass('badge-danger').text('Inactive');
                        }
                        link.data('status', newStatus);
                    },
                    error: function() {
                        alert('Failed to update status. Please try again.');
                    }
                });
            }
        });
    });
</script>