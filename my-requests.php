<?php

include "config/database.php";
include "includes/header.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$userID = $_SESSION['user_id'];

$sql = "SELECT
            BorrowRequests.*,
            Items.ItemName,
            Users.Name AS OwnerName

        FROM BorrowRequests

        JOIN Items
            ON BorrowRequests.ItemID =
               Items.ItemID

        JOIN Users
            ON Items.OwnerID =
               Users.UserID

        WHERE BorrowRequests.BorrowerID = ?

        ORDER BY BorrowRequests.RequestDate DESC";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $userID
);

$stmt->execute();

$requests = $stmt->get_result();

?>

<h2 class="mb-4">
    My Borrow Requests
</h2>


<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

    <th>Item</th>
    <th>Owner</th>
    <th>Start Date</th>
    <th>Return Date</th>
    <th>Status</th>

</tr>

</thead>


<tbody>

<?php while (
    $request =
    $requests->fetch_assoc()
): ?>

<tr>

    <td>
        <?= htmlspecialchars(
            $request['ItemName']
        ) ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $request['OwnerName']
        ) ?>
    </td>

    <td>
        <?= $request['StartDate'] ?>
    </td>

    <td>
        <?= $request['ReturnDate'] ?>
    </td>

    <td>

        <?php

        $status =
            $request['Status'];

        $badge = "bg-secondary";

        if ($status == "Approved") {
            $badge = "bg-success";
        }

        if ($status == "Rejected") {
            $badge = "bg-danger";
        }

        if ($status == "Pending") {
            $badge = "bg-warning text-dark";
        }

        ?>

        <span class="badge <?= $badge ?>">

            <?= $status ?>

        </span>

    </td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>


<?php include "includes/footer.php"; ?>