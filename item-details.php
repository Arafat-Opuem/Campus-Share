<?php

include "config/database.php";
include "includes/header.php";

if (!isset($_GET['id'])) {

    header("Location: items.php");
    exit();

}

$itemID = intval($_GET['id']);

$sql = "SELECT
            Items.*,
            Users.Name AS OwnerName,
            Users.Email AS OwnerEmail,
            Categories.CategoryName

        FROM Items

        JOIN Users
            ON Items.OwnerID = Users.UserID

        JOIN Categories
            ON Items.CategoryID =
               Categories.CategoryID

        WHERE Items.ItemID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $itemID
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    echo "<div class='alert alert-danger'>
            Item not found.
          </div>";

    include "includes/footer.php";
    exit();

}

$item = $result->fetch_assoc();

?>

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card p-4">

            <h2>
                <?= htmlspecialchars(
                    $item['ItemName']
                ) ?>
            </h2>

            <hr>

            <p>
                <strong>Category:</strong>
                <?= htmlspecialchars(
                    $item['CategoryName']
                ) ?>
            </p>

            <p>
                <strong>Description:</strong>
                <?= htmlspecialchars(
                    $item['Description']
                ) ?>
            </p>

            <p>
                <strong>Condition:</strong>
                <?= htmlspecialchars(
                    $item['ItemCondition']
                ) ?>
            </p>

            <p>
                <strong>Owner:</strong>
                <?= htmlspecialchars(
                    $item['OwnerName']
                ) ?>
            </p>

            <p>
                <strong>Status:</strong>

                <span class="badge bg-success">
                    <?= $item['Availability'] ?>
                </span>

            </p>


            <?php if (
                isset($_SESSION['user_id']) &&
                $_SESSION['user_id']
                != $item['OwnerID']
            ): ?>

                <a
                    href="borrow-request.php?id=<?= $itemID ?>"
                    class="btn btn-dark">

                    Request to Borrow

                </a>

            <?php elseif (
                !isset($_SESSION['user_id'])
            ): ?>

                <a
                    href="login.php"
                    class="btn btn-dark">

                    Login to Borrow

                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>