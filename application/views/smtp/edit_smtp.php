<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit SMTP Credentials</title>
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
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .main-content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php $this->load->view('components/sidebar'); ?>
    <?php $this->load->view('components/navbar'); ?>

    <div class="content-wrapper">
        <div class="main-content">
            <div class="container">
            

                <div class="card">    <h4 class="fw-bold text-center mb-4">Edit SMTP Credentials</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" name="smtp_host" value="<?= $credentials['smtp_host'] ?? '' ?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="text" name="smtp_port" value="<?= $credentials['smtp_port'] ?? '' ?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="smtp_email">SMTP Email</label>
                            <input type="email" name="smtp_email" value="<?= $credentials['smtp_email'] ?? '' ?>"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="smtp_password">SMTP Password</label>
                            <input type="password" name="smtp_password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <?= $credentials ? 'Update' : 'Add' ?> Credentials
                        </button>
                    </form>


                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>