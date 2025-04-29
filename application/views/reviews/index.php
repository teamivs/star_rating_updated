<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Show Reviews</title>

        <!-- Bootstrap & FontAwesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: rgb(240, 242, 245);
              
            }
           
            .content-wrapper {
                 margin-right: 20%;
                width: calc(100% - 20%);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                 /* align-items: center;
            justify-content: center; */
            }

            .main-content {
                flex-grow: 1;
                padding: 10px;
            }

            .table-container {
                background: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin: 0 auto;
                max-width: 1200px;
                width: 100%;
            }

            .table-responsive {
                margin: 0 auto;
            }

            #reviewsTable {
                margin: 0 auto;
                width: 100%;
            }

            .dataTables_wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .dataTables_filter {
                margin-bottom: 15px;
            }

            .dataTables_length {
                margin-bottom: 15px;
            }

            .star {
                color: #ffc107;
                font-size: 18px;
            }

            /* Custom sorting icon color */
            table.dataTable thead .sorting::after,
            table.dataTable thead .sorting_asc::after,
            table.dataTable thead .sorting_desc::after {
                color: rgb(255, 255, 255);
                /* Customize this color */
            }

            @media (max-width: 768px) {
                .content-wrapper {
                    margin-left: 0;
                    width: 100%;
                }

                .table-container {
                    padding: 10px;
                }

                /* Adjust column widths for mobile */
                table tr td:nth-child(1),
                /* Sr. No */
                table tr th:nth-child(1) {
                    width: 10%;
                }

                table tr td:nth-child(2),
                /* Name */
                table tr th:nth-child(2) {
                    width: 20%;
                }

                table tr td:nth-child(3),
                /* Mobile No */
                table tr th:nth-child(3) {
                    width: 20%;
                }

                table tr td:nth-child(4),
                /* Comment */
                table tr th:nth-child(4) {
                    width: 20%;
                }

                table tr td:nth-child(5),
                /* Star Rating */
                table tr th:nth-child(5) {
                    width: 10%;
                }
            }


            /* Optional: Change text color on hover */
        </style>

    </head>

    <body>

        <!-- Include Sidebar & Navbar -->
        <div class="container-scroller">

            <!-- Navbar removed -->
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
        
                <!-- Sidebar removed -->

        <div class="content-wrapper">
            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-container">
                                <h4 class="text-center fw-bold mb-4">Review List</h4>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="reviewsTable">
                                        <thead class="table-dark">
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
                                                        <td colspan='5' class='text-center'>No reviews with 1-3 stars found</td>
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
        </div>

        <!-- Bootstrap & DataTables Scripts -->
        <!-- jQuery (required for DataTables) -->
        <!-- jQuery (Required for DataTables) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables Core and Bootstrap 5 Integration -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#reviewsTable').DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    dom: '<"d-flex justify-content-between align-items-center"lf>t<"d-flex justify-content-between align-items-center"ip>',
                    columnDefs: [
                        { orderable: false, targets: [3, 4] } // Disable sorting for 'Comment' and 'Star Rating' columns if needed
                    ],
                    language: {
                        search: "Search",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ reviews",
                        paginate: {
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });


                // Additional CSS to style search box if needed
                $('.dataTables_filter').addClass('text-end');
            });
        </script>

    </body>

</html>