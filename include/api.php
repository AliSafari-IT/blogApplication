<?php
//Check if there is a request with data attached
if (!isset($_POST['request']) || !isset($_POST['data'])) {
    echo "bad request - variables not set";
    die();
} else {
    $request = $_POST['request'];
    $data = $_POST['data'];
}

include "functions.php";

if ($request == "loginUser") {

    /* E-mail | Username  validation*/
    $isEmail = test_input($data['emailUsername']);
    $emailUsername = $data["emailUsername"];
    $isPassword = test_input($data["password"]);
    $password = $data["password"];
    if (empty($password)) {
        $response['message'] = "Password is required!";

    }elseif (empty($emailUsername)) {
        $response['message'] = "E-mail | Username is required!";
    } elseif (filter_var($emailUsername, FILTER_VALIDATE_EMAIL)){
        $response['response'] = loginUser($data['emailUsername'], $data['password']);
        if ($response['response']) {
            $response['message'] = "Login successful!";
            $response['redirect'] = "index.php";
        } else {
            $response['message'] = "Error login! Check your email/password combination!";
        }
    } else {
        // check if username only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9]*$/",$emailUsername)) {
            $response['message'] = "Only letters and numbers without space are allowed for a username!";
        }
        $response['response'] = loginUser($data['emailUsername'], $data['password']);
        if ($response['response']) {
            $response['message'] = "Login successful!";
            $response['redirect'] = "index.php";
        } else {
            $response['message'] = "Error login! Check your username/password combination!";
        }
    }


} else if ($request == "registerUser") {

    $response['response'] = registerUser(
        $data['firstname'],
        $data['lastname'],
        $data['email'],
        $data['username'],
        $data['password']
    );
    if ($response['response']) {
        $response['message'] = "User Registered Successfully!";
        $response['redirect'] = "login.php";
    } else {
        $response['message'] = "Error: either email or username is already taken!";
    }

} else if ($request == "getUsers") {

    $response['data'] = getUsers();


} else if ($request == "getPosts") {

    $response['data'] = getPosts();

} else if ($request == "getPost") {

    $id = $data['id'];
    $response['data'] = getPost($id);

} else if ($request == "newPost") {

    session_start();
    $response['response'] = newPost($_SESSION['username'], $data['visibilityType'], $data['newPostTitleInput'], $data['newPostContentInput']);

    if ($response['response']) {
        $response['message'] = "Message Posted";
        $response['redirect'] = "index.php";
    } else {
        $response['message'] = "Error Posting Message";
    }

} else if ($request == "deletePost") {

    $id = $data['id'];
    $response['response'] = deletePost($id);

    if ($response['response']) {
        $response['message'] = "Post Deleted";
    } else {
        $response['message'] = "Error Deleting Message";
    }

} else if ($request == "getUser") {

    $id = $data['id'];
    $response['data'] = getUser($id);

} else if ($request == "updatePost") {
    session_start();

    $id = $data['postID'];
    $postTitle = $data['newPostTitle'];
    $postContent = $data['newPostContent'];
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        $loggedUser = $_SESSION['username'];
    } else {
        $loggedUser = "publicPost";
    }
    $response['response'] = updatePost($id, $postTitle, $postContent);
    if ($response['response']) {
        $response['message'] = "Post Updated";

        $response['redirect'] = "view.php?id=" . $id . "&loggedUser=" . $loggedUser;
    } else {
        $response['message'] = "Error Updating the Post!";
    }
} else {

    echo "bad request - not found";
    die();

}

//Encode response to send back
echo json_encode($response);