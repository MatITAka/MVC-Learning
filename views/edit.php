<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Modifier Membre</h1>

            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $member['age']; ?>">
                </div>
                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $member['city']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
            </form>
        </div>
    </div>
</div>