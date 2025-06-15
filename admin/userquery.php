<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = ['success' => false, 'message' => '']; // Prepare a response array

    $user_name = $_POST['user_name'];
    $insurance_type = $_POST['insurance_type'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $file_path = null;
    $image_path = null;

    // Handle document file upload
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $allowed_extensions = ['pdf', 'doc', 'docx'];
        $file_info = pathinfo($_FILES['document']['name']);
        $file_extension = strtolower($file_info['extension']);

        if (in_array($file_extension, $allowed_extensions)) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_name = uniqid() . '.' . $file_extension;
            $file_path = $upload_dir . $file_name;

            if (!move_uploaded_file($_FILES['document']['tmp_name'], $file_path)) {
                $response['message'] = 'Error uploading document.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Invalid document file type.';
            echo json_encode($response);
            exit;
        }
    }

    // Handle image file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_image_extensions = ['jpg', 'jpeg', 'png'];
        $image_info = pathinfo($_FILES['image']['name']);
        $image_extension = strtolower($image_info['extension']);

        if (in_array($image_extension, $allowed_image_extensions)) {
            $image_dir = 'uploads/images/';
            if (!is_dir($image_dir)) {
                mkdir($image_dir, 0777, true);
            }
            $image_name = uniqid() . '.' . $image_extension;
            $image_path = $image_name;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $response['message'] = 'Error uploading image.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Invalid image file type.';
            echo json_encode($response);
            exit;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO users (user_name, insurance_type, location, email, phone, document, images) 
            VALUES ('$user_name', '$insurance_type', '$location', '$email', '$phone', '$file_path', '$image_path')";
    //print_r($sql);exit;
    if (mysqli_query($conn, $sql)) {
        header("Location: userlist.php"); // Redirect to userlist page
        exit;
    } else {
        $response['message'] = 'Database error: ' . mysqli_error($conn);
        echo json_encode($response);
        exit;
    }
}
?>
