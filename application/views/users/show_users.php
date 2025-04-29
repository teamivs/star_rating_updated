<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Users</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(240, 242, 245);
        }

        .content-wrapper {
            margin-left: 20%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .table {
            background: white;
            border-radius: 10px;
        }

        .table td:nth-child(4) {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 1%;
                margin-top: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        <!-- Navbar removed -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <?php $this->load->view('components/sidebar') ?>
            <div class="content-wrapper">
                <div class="main-content">
                    <div class="container">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php elseif ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <div class="card p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold">User List</h4>
                                <a href="<?php echo base_url('users/add'); ?>" class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Add User
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="usersTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Password</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($users)) {
                                            $sr_no = 1;
                                            foreach ($users as $user): ?>
                                                <tr>
                                                    <td data-order="<?= $sr_no; ?>"><?= $sr_no++; ?></td>
                                                    <td><?= htmlspecialchars($user['username']); ?></td>
                                                    <td><?= htmlspecialchars($user['name']); ?></td>
                                                    <td><?= htmlspecialchars($user['password']); ?></td>
                                                    <td>
                                                        <a href="<?= base_url('users/edit/' . $user['id']); ?>" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-btn" data-id="<?= $user['id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No users found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap & DataTables Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- SweetAlert2 Script -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

            <!-- DataTables -->
            <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.min.js"></script>

            <script>
                $(document).ready(function () {
                    $('#usersTable').DataTable({
                        responsive: true,
                        columnDefs: [
                            { orderable: false, targets: [4] } // Disable sorting on Actions column
                        ]
                    });

                    // Delete button click event
                    $('.delete-btn').on('click', function () {
                        var userId = $(this).data('id'); // Get the user ID
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?= base_url('users/delete/'); ?>" + userId;
                            }
                        });
                    });
                });
            </script>

</body>

</html>