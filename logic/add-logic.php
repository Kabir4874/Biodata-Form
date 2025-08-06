<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
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

    $profile_photo = '';
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['name']) {
        $time = time();
        $photo_name = $time . $_FILES['profilePhoto']['name'];
        $photo_tmp_name = $_FILES['profilePhoto']['tmp_name'];
        $photo_destination_path = '../uploads/' . $photo_name;

        $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
        $extension = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));

        if (in_array($extension, $allowed_files)) {
            if ($_FILES['profilePhoto']['size'] < 2_000_000) {
                move_uploaded_file($photo_tmp_name, $photo_destination_path);
                $profile_photo = $photo_name;
            } else {
                $_SESSION['add-biodata-error'] = "File size too big. Should be less than 2mb";
            }
        } else {
            $_SESSION['add-biodata-error'] = "File should be png, jpg, jpeg or webp";
        }
    }

    if (!$full_name) {
        $_SESSION['add-biodata-error'] = "Full name is required";
    } elseif (!$date_of_birth) {
        $_SESSION['add-biodata-error'] = "Date of birth is required";
    } elseif (!$religion) {
        $_SESSION['add-biodata-error'] = "Religion is required";
    } elseif (!$phone) {
        $_SESSION['add-biodata-error'] = "Phone number is required";
    }

    if (isset($_SESSION['add-biodata-error'])) {
        $_SESSION['add-biodata-data'] = $_POST;
        header('location: ' . ROOT_URL . '/add-biodata.php');
        die();
    }

    $query = "INSERT INTO biodata (
        profile_photo, full_name, nickname, date_of_birth, age, height, weight, gender, 
        religion, caste, mother_tongue, email, phone, address, education, degree, 
        occupation, income, organization, father_name, father_occupation, mother_name, 
        mother_occupation, siblings, family_type, family_values, pref_age, pref_height, 
        pref_religion, pref_caste, pref_education, pref_profession, about_yourself, 
        partner_expectations
    ) VALUES (
        '$profile_photo', '$full_name', '$nickname', '$date_of_birth', $age, '$height', 
        '$weight', '$gender', '$religion', '$caste', '$mother_tongue', '$email', 
        '$phone', '$address', '$education', '$degree', '$occupation', '$income', 
        '$organization', '$father_name', '$father_occupation', '$mother_name', 
        '$mother_occupation', '$siblings', '$family_type', '$family_values', 
        '$pref_age', '$pref_height', '$pref_religion', '$pref_caste', 
        '$pref_education', '$pref_profession', '$about_yourself', 
        '$partner_expectations'
    )";

    $result = mysqli_query($connection, $query);

    if (!mysqli_errno($connection)) {
        $_SESSION['add-biodata-success'] = "Biodata added successfully";
        header('location: ' . ROOT_URL . '/index.php');
        die();
    } else {
        $_SESSION['add-biodata-error'] = "Failed to add biodata";
        $_SESSION['add-biodata-data'] = $_POST;
        header('location: ' . ROOT_URL . '/add-biodata.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . '/add-biodata.php');
    die();
}
