<?php

include "config/database.php";
include "includes/header.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$message = "";

$categories = $conn->query(
    "SELECT * FROM Categories"
);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ownerID = $_SESSION['user_id'];

    $categoryID = $_POST['category_id'];

    $itemName = trim($_POST['item_name']);

    $description = trim($_POST['description']);

    $condition = trim($_POST['item_condition']);


    $sql = "INSERT INTO Items
            (OwnerID, CategoryID, ItemName,
             Description, ItemCondition)
            VALUES (?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);


    $stmt->bind_param(
        "iisss",
        $ownerID,
        $categoryID,
        $itemName,
        $description,
        $condition
    );


    if ($stmt->execute()) {

        $message = "Item listed successfully!";

    } else {

        $message = "Failed to list item.";

    }

    $stmt->close();
}

?>


<div class="row justify-content-center">

    <div class="col-md-7">

        <div class="card p-4">

            <h2 class="mb-4">
                List Your Item
            </h2>


            <?php if ($message): ?>

                <div class="alert alert-info">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <form method="POST">


                <!-- Item Name -->

                <div class="mb-3">

                    <label class="form-label">
                        Item Name
                    </label>

                    <input
                        type="text"
                        name="item_name"
                        class="form-control"
                        placeholder="Example: Arduino Kit"
                        required>

                </div>


                <!-- Category -->

                <div class="mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select
                        name="category_id"
                        class="form-select"
                        required>

                        <option value="">
                            Select Category
                        </option>


                        <?php while (
                            $category =
                            $categories->fetch_assoc()
                        ): ?>

                            <option
                                value="<?= $category['CategoryID'] ?>">

                                <?= htmlspecialchars(
                                    $category['CategoryName']
                                ) ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>


                <!-- Description -->

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Describe your item..."
                        required></textarea>

                </div>


                <!-- Condition -->

                <div class="mb-3">

                    <label class="form-label">
                        Condition
                    </label>

                    <select
                        name="item_condition"
                        class="form-select">

                        <option value="Excellent">
                            Excellent
                        </option>

                        <option value="Good">
                            Good
                        </option>

                        <option value="Fair">
                            Fair
                        </option>

                    </select>

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    class="btn btn-dark">

                    List Item

                </button>


            </form>

        </div>

    </div>

</div>


<?php include "includes/footer.php"; ?>