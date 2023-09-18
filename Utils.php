<?php

class Utils {
    public static function fetchAndSaveImage($imageUrl, $localImagePath) {
        $imageContent = file_get_contents($imageUrl);

        if ($imageContent === false) {
            return false; // Failed to fetch the image
        } else {
            $result = file_put_contents($localImagePath, $imageContent);
            return $result !== false; // Return true if image saved successfully
        }
    }


    public static function displaySocialMediaStyleData($userData, $imagePath) {
        foreach ($userData as $row) {
            echo '<div>';
            echo '<img src="' . $imagePath . '" alt="' . $row['name'] . '" width="100" height="100">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p>Email: ' . $row['email'] . '</p>';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>' . $row['body'] . '</p>';
            echo '</div>';
        }
    }

    public static function getLatestPostForBirthdayUsers($conn, $currentMonth) {
        // Logic to retrieve the latest posts for users with birthdays in the current month
    }

    public static function createPostsCountTable($conn) {
        // Logic to create the 'PostsCount' table here
    }
}

?>