<nav class="navbar navbar-light bg-light fixed-top" style="width: 100%; z-index: 1000;">
  <div class="container-fluid">
    <div class="dropdown ms-auto">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="<?php echo base_url('settings'); ?>">Settings</a></li>
        <li><a class="dropdown-item" href="<?php echo base_url('reviews/logout'); ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Include FontAwesome for the user icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body {
        padding-top: 56px; /* Adjust this value based on the height of your navbar */
    }
</style>