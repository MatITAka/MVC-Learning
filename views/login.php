
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Login</h1>

            <?php
            if (isset($login_error) && $login_error) {
                echo '<div class="alert alert-danger">' . $login_error . '</div>';
            }
            ?>

            <form action="../src/login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>