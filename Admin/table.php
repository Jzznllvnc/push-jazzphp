<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examinees</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Examinees</h2>
        <a class="btn btn-primary" href="/jazzphp/Admin/create.php" role="button">Create New Examinee</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "idgenerate";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // read all row from database table
                $sql = "SELECT * FROM examinees";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/jazzphp/Admin/edit.php?id=$row[id]'>Edit</a>
                            <button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#examineeModal$row[id]'>View</button>
                            <a class='btn btn-danger btn-sm' href='/jazzphp/Admin/delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";

                    // Modal for each examinee
                    echo "
                    <div class='modal fade' id='examineeModal$row[id]' tabindex='-1' aria-labelledby='examineeModalLabel$row[id]' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='examineeModalLabel$row[id]'>Examinee Details</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <p><strong>Name:</strong> $row[name]</p>
                                    <p><strong>Email:</strong> $row[email]</p>
                                    <p><strong>Phone:</strong> $row[phone]</p>
                                    <p><strong>Address:</strong> $row[address]</p>
                                    <p><strong>Created At:</strong> $row[created_at]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script defer src="js/bootstrap.bundle.min.js"></script>
</body>
</html>