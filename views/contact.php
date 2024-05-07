<div class="container mt-5 p-3">
    <h1 class="text-center">Inscrivez-vous</h1>
    <form action="../data/data.php" method="post">
        <div class="form-group m-2">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
        </div>
        <div class="form-group m-2">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" name="age" placeholder="Votre age" required>
        </div>
        <div class="form-group m-2">
            <label for="city">Ville</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Votre Ville" required>
        </div>
        <button type="submit" class="btn btn-primary m-2">Envoyer</button>
    </form>
</div>
