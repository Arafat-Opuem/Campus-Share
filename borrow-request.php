<?php

include "config/database.php";
include "includes/header.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

if (!isset($_GET['id'])) {

    header("Location: items.php");
    exit();

}

$itemID = intval($_GET['id']);

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $borrowerID =
        $_SESSION['user_id'];

    $startDate =
        $_POST['start_date'];

    $returnDate =
        $_POST['return_date'];


    $sql = "INSERT INTO BorrowRequests
            (ItemID, BorrowerID,
             StartDate, ReturnDate)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iiss",
        $itemID,
        $borrowerID,
        $startDate,
        $returnDate
    );


    if ($stmt->execute()) {

        $message =
            "Borrow request sent successfully.";

    } else {

        $message =
            "Failed to send request.";

    }

}

?>

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card p-4">

            <h2 class="mb-4">
                Borrow Request
            </h2>

            <?php if ($message): ?>

                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <form method="POST">

                <div class="mb-3">

                    <label>Borrow Start Date</label>

                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>Return Date</label>

                    <input
                        type="date"
                        name="return_date"
                        class="form-control"
                        required>

                </div>


                <button
                    type="submit"
                    class="btn btn-dark">

                    Send Request

                </button>

            </form>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>