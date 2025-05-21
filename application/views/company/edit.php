<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }

        .main-container {
            margin-left: 20%;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .img-container {
            max-height: 70vh;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .card {
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .company-logo {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            object-fit: contain;
            border: 1px solid #eee;
            padding: 5px;
            background: white;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        .btn-success {
            background: linear-gradient(45deg, #4361ee, #3f37c9);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #3f37c9, #4361ee);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        @media (max-width: 768px) {
            .main-container {
                margin-left: 0;
                margin-top: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-container">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <h4 class="fw-bold text-center mb-4"></h4>
                    <?= form_open_multipart('company/edit', ['class' => 'needs-validation']); ?>
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" required
                            value="<?= $company['company_name'] ?? '' ?>">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Company Logo</label>
                        <input type="file" name="company_logo" class="form-control" accept="image/*">
                        <?php if (!empty($company['company_logo'])): ?>
                            <img src="<?= base_url($company['company_logo']) ?>" alt="Company Logo"
                                class="company-logo mt-2">
                        <?php endif; ?>
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label">Company Logo</label>
                        <input type="file" id="logoInput" name="company_logo" class="form-control" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('logoInput').click()">
                            <i class="fas fa-image me-2"></i>Choose Logo
                        </button>
                        <input type="hidden" id="croppedImageData" name="cropped_image">
                        <?php if (!empty($company['company_logo'])): ?>
                            <div class="mt-3">
                                <img src="<?= base_url($company['company_logo']) ?>" alt="Current Logo" class="company-logo mt-2" id="currentLogo">
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Cropping Modal -->
                    <div class="modal fade" id="cropModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Crop Logo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-container">
                                        <img id="imageToCrop" src="" alt="Logo to crop" style="max-width: 100%;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="cropButton">Crop & Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company URL</label>
                        <input type="url" name="company_url" class="form-control" required
                            value="<?= $company['company_url'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google URL</label>
                        <input type="url" name="google_url" class="form-control" required
                            value="<?= $company['google_url'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Location</label>
                        <input type="text" name="company_location" class="form-control"
                            value="<?= $company['company_location'] ?? '' ?>">
                        <small class="text-muted">Enter the city or area where your company is located</small>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize variables
        let cropper;
        const image = document.getElementById('imageToCrop');
        const logoInput = document.getElementById('logoInput');
        const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
        const currentLogo = document.getElementById('currentLogo');

        // When file is selected
        logoInput.addEventListener('change', function(e) {
            const files = e.target.files;

            if (files && files.length > 0) {
                const file = files[0];

                // Check if file is an image
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    return;
                }

                // Create a URL for the selected file
                const reader = new FileReader();

                reader.onload = function(event) {
                    // Destroy previous cropper instance if exists
                    if (cropper) {
                        cropper.destroy();
                    }

                    // Set image source and show modal
                    image.src = event.target.result;
                    cropModal.show();

                    // Initialize cropper when modal is shown
                    cropModal._element.addEventListener('shown.bs.modal', function() {
                        cropper = new Cropper(image, {
                            aspectRatio: 1, // Square aspect ratio
                            viewMode: 1,
                            autoCropArea: 0.8,
                            responsive: true,
                            guides: false
                        });
                    });
                };

                reader.readAsDataURL(file);
            }
        });

        // Handle crop button click
        document.getElementById('cropButton').addEventListener('click', function() {
            // Get cropped canvas
            const canvas = cropper.getCroppedCanvas({
                width: 500, // Set your desired width
                height: 500, // Set your desired height
                minWidth: 256,
                minHeight: 256,
                maxWidth: 1024,
                maxHeight: 1024,
                fillColor: '#fff',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            if (canvas) {
                // Convert canvas to blob
                canvas.toBlob(function(blob) {
                    // Create form data to send to server
                    const formData = new FormData();
                    formData.append('croppedImage', blob, 'company_logo.png');

                    // Send to server via AJAX
                    fetch('<?= base_url("company/upload_logo") ?>', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update the hidden field with the file path
                                document.getElementById('croppedImageData').value = data.file_path;

                                // Update the preview if exists
                                if (currentLogo) {
                                    currentLogo.src = '<?= base_url() ?>' + data.file_path;
                                }

                                // Hide modal
                                cropModal.hide();
                            } else {
                                alert('Error: ' + data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while uploading the image.');
                        });
                }, 'image/png');
            }
        });

        // Clean up cropper when modal is hidden
        cropModal._element.addEventListener('hidden.bs.modal', function() {
            if (cropper) {
                cropper.destroy();
            }
        });
    </script>
</body>

</html>