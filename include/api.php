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

    $response['response'] = loginUser($data['emailUsername'], $data['password']);
    if ($response['response']) {
        $response['message'] = "Login successful!";
        $response['redirect'] = "index.php";
    } else {
        $response['message'] = "Error login";
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
    $response['response'] = newPost($_SESSION['username'], $data['visibilityType'], $data['newPostTitleInput'],$data['newPostContentInput']);

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
    }else{
        $loggedUser="publicPost";
    }
    $response['response'] = updatePost($id, $postTitle, $postContent);
    if ($response['response']) {
        $response['message'] = "Post Updated";

        $response['redirect'] = "view.php?id=".$id."&loggedUser=".$loggedUser;
    } else {
        $response['message'] = "Error Updating the Post!";
    }
} else {

    echo "bad request - not found";
    die();

}

//Encode response to send back
echo json_encode($response);