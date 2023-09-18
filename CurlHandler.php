<?php

class CurlHandler {
    public function fetchAndInsertUsers($conn) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $users = json_decode($response, true);
            foreach ($users as $user) {
                $id = $user['id'];
                $name = $user['name'];
                $email = $user['email'];
                $active = 'yes'; 
                $query = "INSERT INTO users (id, name, email, active) VALUES ($id, '$name', '$email', '$active')";
                $conn->exec($query);
            }
        } else {
            echo 'cURL request to fetch users failed.';
        }
    }

    public function fetchAndInsertPosts($conn) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $posts = json_decode($response, true);
            foreach ($posts as $post) {
                $id = $post['id'];
                $user_id = $post['userId'];
                $title = $post['title'];
                $body = $post['body'];
                $created_at = date('Y-m-d H:i:s'); // Set the creation date as the current date
                $active = 'yes'; 
                $query = "INSERT INTO posts (id, user_id, title, body, created_at, active) VALUES ($id, $user_id, '$title', '$body', '$created_at', '$active')";
                $conn->exec($query);
            }
        } else {
            echo 'cURL request to fetch posts failed.';
        }
    }
}

?>