<?php

include "config/database.php";
include "includes/header.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT *
            FROM Users
            WHERE Email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (
            password_verify(
                $password,
                $user['Password']
            )
        ) {

            $_SESSION['user_id'] =
                $user['UserID'];

            $_SESSION['user_name'] =
                $user['Name'];

            $_SESSION['role'] =
                $user['Role'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Incorrect password.";

        }

    } else {

        $message = "Account not found.";

    }

    $stmt->close();
}

?>

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card p-4">

            <h2 class="text-center mb-4">
                Login
            </h2>

            <?php if ($message): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <form method="POST">

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                </div>


                <button
                    type="submit"
                    class="btn btn-dark w-100">

                    Login

                </button>

            </form>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>