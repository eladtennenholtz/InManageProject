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
        try {
            // SQL query to retrieve users with birthdays in the current month
            $query = "
                SELECT users.id, users.name, users.email, MAX(posts.created_at) AS latest_post_date
                FROM users
                INNER JOIN posts ON users.id = posts.user_id
                WHERE users.active = 'yes'
                    AND MONTH(users.birthdate) = :currentMonth
                GROUP BY users.id, users.name, users.email
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':currentMonth', $currentMonth, PDO::PARAM_INT);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $latestPosts = [];

            foreach ($results as $result) {
                
                $userId = $result['id'];
                $latestPostDate = $result['latest_post_date'];

               
                $postQuery = "
                    SELECT title, body
                    FROM posts
                    WHERE user_id = :userId
                        AND created_at = :latestPostDate
                        AND active = 'yes'
                ";

                
                $postStmt = $conn->prepare($postQuery);
                $postStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $postStmt->bindParam(':latestPostDate', $latestPostDate, PDO::PARAM_STR);
                $postStmt->execute();

               
                $latestPost = $postStmt->fetch(PDO::FETCH_ASSOC);

               
                if ($latestPost) {
                    $result['latest_post'] = $latestPost;
                } else {
                    $result['latest_post'] = null;
                }

               
                $latestPosts[] = $result;
            }

            return $latestPosts;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public static function createPostsCountTable($conn) {
        // Logic to create the 'PostsCount' table here
    }
}

?>