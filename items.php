<?php

include "config/database.php";
include "includes/header.php";

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}


if ($search != "") {

    $sql = "SELECT
                Items.*,
                Users.Name AS OwnerName,
                Categories.CategoryName

            FROM Items

            JOIN Users
                ON Items.OwnerID = Users.UserID

            JOIN Categories
                ON Items.CategoryID =
                   Categories.CategoryID

            WHERE Items.Availability = 'Available'
            AND Items.ItemName LIKE ?

            ORDER BY Items.CreatedAt DESC";

    $stmt = $conn->prepare($sql);

    $searchValue = "%" . $search . "%";

    $stmt->bind_param(
        "s",
        $searchValue
    );

    $stmt->execute();

    $items = $stmt->get_result();

} else {

    $sql = "SELECT
                Items.*,
                Users.Name AS OwnerName,
                Categories.CategoryName

            FROM Items

            JOIN Users
                ON Items.OwnerID = Users.UserID

            JOIN Categories
                ON Items.CategoryID =
                   Categories.CategoryID

            WHERE Items.Availability = 'Available'

            ORDER BY Items.CreatedAt DESC";

    $items = $conn->query($sql);

}

?>

<div class="d-flex justify-content-between
            align-items-center mb-4">

    <h2>Available Items</h2>

</div>


<form method="GET" class="mb-4">

    <div class="input-group">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search equipment..."
            value="<?= htmlspecialchars($search) ?>">

        <button
            class="btn btn-dark">

            Search

        </button>

    </div>

</form>


<div class="row">

<?php if ($items->num_rows > 0): ?>

    <?php while ($item = $items->fetch_assoc()): ?>

        <div class="col-md-4 mb-4">

            <div class="card item-card p-3 h-100">

                <h4>
                    <?= htmlspecialchars(
                        $item['ItemName']
                    ) ?>
                </h4>

                <span class="badge bg-secondary mb-2">
                    <?= htmlspecialchars(
                        $item['CategoryName']
                    ) ?>
                </span>

                <p>
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

                <a
                    href="item-details.php?id=<?= $item['ItemID'] ?>"
                    class="btn btn-dark mt-auto">

                    View Details

                </a>

            </div>

        </div>

    <?php endwhile; ?>

<?php else: ?>

    <div class="alert alert-info">
        No available items found.
    </div>

<?php endif; ?>

</div>


<?php include "includes/footer.php"; ?>