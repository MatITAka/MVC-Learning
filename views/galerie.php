<div class="container mt-5">
    <h1 class="text-center">Galerie</h1>

    <?php
    if (isset($_SESSION['upload_errors'])) {
        foreach ($_SESSION['upload_errors'] as $error) {
            echo "<p class='text-danger text-center'>$error</p>";
        }
    }
    ?>

    <div class="text-center">
        <?php if (isset($_SESSION['user'])): ?>

            <button type="button" class="btn btn-primary mb-5 mt-4" data-toggle="modal" data-target="#uploadModal">
                Ajouter une image
            </button>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php
        foreach ($images as $image) {
            echo '<div class="col-4 mb-2">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($image['content']) . '" class="img-thumbnail hover-zoom">';
            echo '<div class="card mt-2">';
            echo '<div class="card-body">';
            echo '<p class="card-text">' . $image['likes'] . ' likes</p>';
            echo '<table class="table table-sm">';
            foreach ($image['comments'] as $comment) {
                echo '<tr>';
                echo '<td>' . $comment['comment'] . '</td>';
                if (isset($_SESSION['user'])) {
                    echo "<td>";
                    echo "<form action='../src/delete_comment.php' method='post'>";
                    echo "<input type='hidden' name='comment_id' value='" . $comment['id'] . "'>";
                    echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                    echo "</form>";
                    echo "</td>";
                }
                echo '</tr>';
            }
            echo '</table>';
            echo "<form action='../src/like.php' method='post' class='d-inline-block'>";
            echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
            echo "<button type='submit' class='btn btn-link like-button'><i class='far fa-heart'></i></button>";
            echo "</form>";
            echo "<form action='../src/comment.php' method='post' class='d-inline-block ml-2'>";
            echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
            echo "<input type='text' name='comment' placeholder='Ajouter un commentaire...' class='form-control'>";
            echo "<button type='submit' class='btn btn-primary mt-2'>Commenter</button>";
            echo "</form>";
            echo '</div>'; // End of card-body
            if (isset($_SESSION['user'])) {
                echo "<form action='../src/delete.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $image['id'] . "'>";
                echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                echo "</form>";
            }
            echo '</div>'; // End of card
            echo '</div>'; // End of col-4 mb-2
        }
        ?>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Ajouter une image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../src/upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Choisir une image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <?php
                        if (isset($_SESSION['upload_errors'])) {
                            foreach ($_SESSION['upload_errors'] as $error) {
                                echo "<p class='text-danger'>$error</p>";
                            }
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Télécharger</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>