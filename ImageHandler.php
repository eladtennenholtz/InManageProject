<?php
class ImageHandler {
    public function fetchAndSaveImage($imageUrl, $localImagePath) {
        $imageContent = file_get_contents($imageUrl);

        if ($imageContent === false) {
            return false; // Failed to fetch the image
        } else {
            $result = file_put_contents($localImagePath, $imageContent);
            return $result !== false; // Return true if image saved successfully
        }
    }
}

?>