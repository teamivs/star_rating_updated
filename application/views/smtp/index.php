<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SMTP Credentials</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: rgb(240, 242, 245);
            }

            .content-wrapper {
                margin-left: 25%;
                
                min-height: 100vh;
            }

            .btn {
                width: 20%;
                margin-left: 80%;
            }

            .main-content {
                padding: 20px;
                width: calc(100% - 20%);
            }

            .card {
                border-radius: 10px;
                background: white;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 768px) {
                .content-wrapper {
                    margin-left: 0;
                    width: 100%;
                }

                
            }

            
       

            
        </style>
    </head>

    <body>

        <div class="container-scroller">

            <?php $this->load->view('components/navbar'); ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                <?php $this->load->view('components/sidebar') ?>

                <div class="content-wrapper">
                    <div class="main-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <h4 class="fw-bold text-center mb-4">SMTP Credentials</h4>

                                        <table class="table table-bordered">
                                            <tr>
                                                <th>SMTP Host</th>
                                                <td><?= htmlspecialchars($credentials['smtp_host'] ?? 'Not Set') ?></td>
                                            </tr>
                                            <tr>
                                                <th>SMTP Port</th>
                                                <td><?= htmlspecialchars($credentials['smtp_port'] ?? 'Not Set') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email (Username)</th>
                                                <td><?= htmlspecialchars($credentials['smtp_email'] ?? 'Not Set') ?></td>
                                            </tr>
                                            <tr>
                                                <th>Password</th>
                                                <td><?= htmlspecialchars($credentials['smtp_password'] ?? 'Not Set') ?></td>
                                                <!-- Hide password for security -->
                                            </tr>
                                        </table>

                                        <a href="<?= base_url('smtp/edit/' . $credentials['id']) ?>" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>