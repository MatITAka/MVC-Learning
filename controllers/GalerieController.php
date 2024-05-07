<?php
class GalerieController {
    public function galerie() {
        // Include the logic file
        require __DIR__ . '/../src/galerie.php';

        // Call the function to include the view file
        includeGalerieView($images);
    }

    // ... other methods for handling upload, likes, comments, etc ...
}