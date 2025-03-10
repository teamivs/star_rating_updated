<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Users</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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
            margin-left: 250px;
            width: calc(100% - 250px);
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
    </style>
</head>

<body>
    <?php $this->load->view('components/sidebar'); ?>
    <?php $this->load->view('components/navbar'); ?>

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
                        <a href="<?php echo base_url('index.php/users/add'); ?>" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Add User
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="usersTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('index.php/users/edit/' . $user['id']); ?>"
                                                class="btn btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="javascript:void(0);" class="btn btn-sm delete-btn"
                                                data-id="<?php echo $user['id']; ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
                var userId = $(this).data('id'); // Get the user ID from data-id attribute
                console.log('User ID:', userId); // Debugging: Check the value of userId

                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Debugging: Confirm redirection
                        console.log('Redirecting to delete user with ID:', userId);

                        // Redirect to the delete URL if confirmed
                        window.location.href = "<?php echo base_url('index.php/users/delete/'); ?>" + userId;
                    }
                });
            });
        });
    </script>
</body>

</html>