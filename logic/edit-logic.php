<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // Get and sanitize all form data
    $full_name = filter_var($_POST['fullName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nickname = filter_var($_POST['nickname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date_of_birth = filter_var($_POST['dateOfBirth'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
    $height = filter_var($_POST['height'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $weight = filter_var($_POST['weight'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $religion = filter_var($_POST['religion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $caste = filter_var($_POST['caste'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mother_tongue = filter_var($_POST['motherTongue'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $education = filter_var($_POST['education'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $degree = filter_var($_POST['degree'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $income = filter_var($_POST['income'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $organization = filter_var($_POST['organization'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $father_name = filter_var($_POST['fatherName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $father_occupation = filter_var($_POST['fatherOccupation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mother_name = filter_var($_POST['motherName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mother_occupation = filter_var($_POST['motherOccupation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $siblings = filter_var($_POST['siblings'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $family_type = filter_var($_POST['familyType'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $family_values = isset($_POST['familyValues']) ? implode(',', $_POST['familyValues']) : '';
    $pref_age = filter_var($_POST['prefAge'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pref_height = filter_var($_POST['prefHeight'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pref_religion = filter_var($_POST['prefReligion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pref_caste = filter_var($_POST['prefCaste'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pref_education = filter_var($_POST['prefEducation'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pref_profession = filter_var($_POST['prefProfession'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $about_yourself = filter_var($_POST['aboutYourself'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $partner_expectations = filter_var($_POST['partnerExpectations'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Handle file upload if new photo is provided
    $profile_photo = '';
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['name']) {
        $time = time();
        $photo_name = $time . $_FILES['profilePhoto']['name'];
        $photo_tmp_name = $_FILES['profilePhoto']['tmp_name'];
        $photo_destination_path = './uploads/' . $photo_name;

        $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
        $extension = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));

        if (in_array($extension, $allowed_files)) {
            if ($_FILES['profilePhoto']['size'] < 2_000_000) {
                move_uploaded_file($photo_tmp_name, $photo_destination_path);
                $profile_photo = $photo_name;

                // Delete old photo if exists
                $old_photo_query = "SELECT profile_photo FROM biodata WHERE id=$id";
                $old_photo_result = mysqli_query($connection, $old_photo_query);
                $old_photo = mysqli_fetch_assoc($old_photo_result);

                if ($old_photo['profile_photo']) {
                    unlink('./uploads/' . $old_photo['profile_photo']);
                }
            } else {
                $_SESSION['edit-biodata-error'] = "File size too big. Should be less than 2mb";
            }
        } else {
            $_SESSION['edit-biodata-error'] = "File should be png, jpg, jpeg or webp";
        }
    }

    // Validate required fields
    if (!$full_name) {
        $_SESSION['edit-biodata-error'] = "Full name is required";
    } elseif (!$date_of_birth) {
        $_SESSION['edit-biodata-error'] = "Date of birth is required";
    } elseif (!$religion) {
        $_SESSION['edit-biodata-error'] = "Religion is required";
    } elseif (!$phone) {
        $_SESSION['edit-biodata-error'] = "Phone number is required";
    }

    // Redirect back with errors if any
    if (isset($_SESSION['edit-biodata-error'])) {
        $_SESSION['edit-biodata-data'] = $_POST;
        header('location: ' . ROOT_URL . "/edit-biodata.php?id=$id");
        die();
    }

    // Prepare the photo update part of the query
    $photo_update = $profile_photo ? "profile_photo='$profile_photo', " : '';

    // Update query
    $query = "UPDATE biodata SET 
        $photo_update
        full_name='$full_name', 
        nickname='$nickname', 
        date_of_birth='$date_of_birth', 
        age=$age, 
        height='$height', 
        weight='$weight', 
        gender='$gender', 
        religion='$religion', 
        caste='$caste', 
        mother_tongue='$mother_tongue', 
        email='$email', 
        phone='$phone', 
        address='$address', 
        education='$education', 
        degree='$degree', 
        occupation='$occupation', 
        income='$income', 
        organization='$organization', 
        father_name='$father_name', 
        father_occupation='$father_occupation', 
        mother_name='$mother_name', 
        mother_occupation='$mother_occupation', 
        siblings='$siblings', 
        family_type='$family_type', 
        family_values='$family_values', 
        pref_age='$pref_age', 
        pref_height='$pref_height', 
        pref_religion='$pref_religion', 
        pref_caste='$pref_caste', 
        pref_education='$pref_education', 
        pref_profession='$pref_profession', 
        about_yourself='$about_yourself', 
        partner_expectations='$partner_expectations' 
        WHERE id=$id";

    $result = mysqli_query($connection, $query);

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-biodata-success'] = "Biodata updated successfully";
        header('location: ' . ROOT_URL . "/index.php");
        die();
    } else {
        $_SESSION['edit-biodata-error'] = "Failed to update biodata";
        $_SESSION['edit-biodata-data'] = $_POST;
        header('location: ' . ROOT_URL . "/edit-biodata.php?id=$id");
        die();
    }
} else {
    header('location: ' . ROOT_URL . '/index.php');
    die();
}
