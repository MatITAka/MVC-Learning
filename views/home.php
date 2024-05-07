<div class="container mt-5 p-3">
    <h1 class="text-center">Bonjour et bienvenue</h1>
    <p class="lead text-center">Voici ma liste de membres</p>

    <?php
    if (isset($message)) {
        echo "<p class='alert alert-success'>" . $message . "</p>";
    }
    ?>

    <div class="table-responsive">
        <table class="table table-striped mt-5">
            <thead>
            <tr>
                <th>Prénom</th>
                <th>Age</th>
                <th>Ville</th>
            </tr>
            </thead>
            <tbody>
            <?php
            displayMembers();
            ?>
            </tbody>
        </table>
    </div>
</div>