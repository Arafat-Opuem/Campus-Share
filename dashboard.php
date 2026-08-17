<?php

session_start();

include "config/database.php";
include "includes/header.php";


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}


// Get logged-in user's name
$userID = $_SESSION['user_id'];

$sql = "SELECT Name FROM Users WHERE UserID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $userID);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

$userName = $user['Name'] ?? 'User';

?>



<!-- =========================================
     DASHBOARD
========================================= -->

<div class="container py-5">


    <!-- Welcome Section -->

    <div class="mb-5">

        <h1 class="fw-bold">
            Welcome, <?= htmlspecialchars($userName) ?>!
        </h1>

        <p class="text-muted">
            Manage your CampusShare activities from your dashboard.
        </p>

    </div>



    <!-- Dashboard Cards -->

    <div class="row g-4">


        <!-- =====================================
             CARD 1 - BROWSE ITEMS
        ====================================== -->

        <div class="col-md-4">

            <div class="dashboard-card bg-primary">


                <div>

                    <h3>
                        Browse Items
                    </h3>

                    <p>
                        Find equipment available for borrowing.
                    </p>

                </div>


                <a
                    href="items.php"
                    class="btn btn-light">

                    Browse

                </a>


            </div>

        </div>



        <!-- =====================================
             CARD 2 - LIST ITEM
        ====================================== -->

        <div class="col-md-4">

            <div class="dashboard-card bg-success">


                <div>

                    <h3>
                        List an Item
                    </h3>

                    <p>
                        Share your unused equipment with other students.
                    </p>

                </div>


                <a
                    href="add-item.php"
                    class="btn btn-light">

                    Add Item

                </a>


            </div>

        </div>



        <!-- =====================================
             CARD 3 - VIEW REQUESTS
        ====================================== -->

        <div class="col-md-4">

            <div class="dashboard-card bg-dark">


                <div>

                    <h3>
                        View Requests
                    </h3>

                    <p>
                        Manage borrowing requests for your items.
                    </p>

                </div>


                <a
                    href="my-requests.php"
                    class="btn btn-light">

                    View Requests

                </a>


            </div>

        </div>


    </div>



    <!-- =========================================
         QUICK INFORMATION
    ========================================== -->

    <div class="row mt-5">


        <div class="col-md-12">

            <div class="card p-4">


                <h4 class="fw-bold mb-3">
                    How CampusShare Works
                </h4>


                <div class="row text-center">


                    <div class="col-md-4 mb-3">

                        <h5>
                            1. List
                        </h5>

                        <p class="text-muted">
                            List your unused tools,
                            equipment or books.
                        </p>

                    </div>


                    <div class="col-md-4 mb-3">

                        <h5>
                            2. Borrow
                        </h5>

                        <p class="text-muted">
                            Find and request items
                            from other students.
                        </p>

                    </div>


                    <div class="col-md-4 mb-3">

                        <h5>
                            3. Share
                        </h5>

                        <p class="text-muted">
                            Share resources and
                            reduce unnecessary purchases.
                        </p>

                    </div>


                </div>


            </div>

        </div>


    </div>


</div>



<?php

include "includes/footer.php";

?>