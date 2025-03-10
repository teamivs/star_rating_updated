<?php
session_start();
include 'db_con.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch reviews from the database
$query = "SELECT * FROM comments";
$result = $conn->query($query);
?>

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
            /* display: flex; */
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
            overflow-y: auto;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .star {
            color: #ffc107;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <!-- Include Sidebar -->
    <?php include 'components/sidebar.php'; ?>
    <?php include 'components/navbar.php'; ?>
    <div class="content-wrapper">
        <!-- Include Navbar -->


        <div class="main-content">
            <div class="table-container">
                <h4 class="text-center fw-bold mb-4">Review List</h4>

                <div class="d-flex justify-content-end pb-3">
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>

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
                            <?php
                            if ($result->num_rows > 0) {
                                $sr_no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$sr_no}</td>";
                                    echo "<td>" . htmlspecialchars($row['name_add']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['mobile_no']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['comments']) . "</td>";
                                    echo "<td>";
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $row['star_rating'] ? '<i class="fas fa-star star"></i>' : '<i class="far fa-star"></i>';
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    $sr_no++;
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No reviews found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & DataTables Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#reviewsTable').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [0, 1, 2] }
                ]
            });
        });
    </script>

</body>

</html>