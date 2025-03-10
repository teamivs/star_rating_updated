<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3>Edit User</h3>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control"
                    value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control"
                    value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control"
                    value="<?php echo htmlspecialchars($user['password']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>