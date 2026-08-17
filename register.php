<?php

include "config/database.php";
include "includes/header.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $universityID = trim($_POST['university_id']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $department = trim($_POST['department']);

    if (
        empty($name) ||
        empty($universityID) ||
        empty($email) ||
        empty($password)
    ) {

        $message = "Please fill in all required fields.";

    } else {

        $hashedPassword =
            password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Users
                (Name, UniversityID, Email, Password, Department)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssss",
            $name,
            $universityID,
            $email,
            $hashedPassword,
            $department
        );

        if ($stmt->execute()) {

            $message =
                "Registration successful! You can now login.";

        } else {

            $message =
                "Registration failed. Email or ID may already exist.";

        }

        $stmt->close();
    }
}

?>

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card p-4">

            <h2 class="text-center mb-4">
                Create Account
            </h2>

            <?php if ($message): ?>

                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <form method="POST">

                <div class="mb-3">

                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>University ID</label>

                    <input
                        type="text"
                        name="university_id"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>

                </div>


                <div class="mb-3">

                    <label>Department</label>

                    <input
                        type="text"
                        name="department"
                        class="form-control">

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

                    Register

                </button>

            </form>

        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>