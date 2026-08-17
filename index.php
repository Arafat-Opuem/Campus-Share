<?php include "includes/header.php"; ?>

<div class="hero">

    <h1>CampusShare</h1>

    <p>
        Share. Borrow. Save. Reuse.
    </p>

    <p>
        A Peer-to-Peer Campus Tool & Equipment Library
    </p>

    <div class="mt-4">

        <a href="items.php"
           class="btn btn-light btn-lg me-2">
            Browse Items
        </a>

        <?php if (!isset($_SESSION['user_id'])): ?>

            <a href="register.php"
               class="btn btn-outline-light btn-lg">
                Join CampusShare
            </a>

        <?php endif; ?>

    </div>

</div>


<div class="row text-center mt-5">

    <div class="col-md-4">

        <div class="card p-4">

            <h2>♻</h2>

            <h4>Reduce E-Waste</h4>

            <p>
                Reuse existing equipment instead of
                buying new products.
            </p>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card p-4">

            <h2>💰</h2>

            <h4>Save Money</h4>

            <p>
                Borrow equipment from other students
                instead of purchasing expensive items.
            </p>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card p-4">

            <h2>🤝</h2>

            <h4>Share Resources</h4>

            <p>
                Build a campus culture based on
                sharing and collaboration.
            </p>

        </div>

    </div>

</div>


<?php include "includes/footer.php"; ?>