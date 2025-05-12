<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Review List</h4>
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="reviewsTable">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Comment</th>
                                    <th>Star Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reviews)) {
                                    $sr_no = 1;
                                    foreach ($reviews as $row) {
                                        if ($row['star_rating'] <= 3) { // Show only 1-3 star reviews ?>
                                            <tr>
                                                <td data-order="<?= $sr_no; ?>"><?= $sr_no++; ?></td>
                                                <td><?= htmlspecialchars($row['name_add']); ?></td>
                                                <td><?= htmlspecialchars($row['mobile_no']); ?></td>
                                                <td><?= htmlspecialchars($row['comments']); ?></td>
                                                <td>
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        echo $i <= $row['star_rating'] ? '<i class="fas fa-star star"></i>' : '<i class="far fa-star"></i>';
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    }
                                    // Show message if no 1-3 star reviews are found
                                    if ($sr_no === 1) { ?>
                                        <tr>
                                            <td colspan='5' class='text-center'>No reviews with 1-3 stars
                                                found</td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan='5' class='text-center'>No reviews found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>