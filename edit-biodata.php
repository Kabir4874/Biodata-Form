<?php
require './config/database.php';

if (!isset($_SESSION['user-id'])) {
    header('location: login.php');
    die();
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM biodata WHERE id=$id";
$result = mysqli_query($connection, $query);
$biodata = mysqli_fetch_assoc($result);

if (!$biodata) {
    $_SESSION['edit-biodata-error'] = "Biodata not found";
    header('location: view-biodata.php');
    die();
}

$form_data = isset($_SESSION['edit-biodata-data']) ? $_SESSION['edit-biodata-data'] : [
    'fullName' => $biodata['full_name'],
    'nickname' => $biodata['nickname'],
    'dateOfBirth' => $biodata['date_of_birth'],
    'age' => $biodata['age'],
    'height' => $biodata['height'],
    'weight' => $biodata['weight'],
    'gender' => $biodata['gender'],
    'religion' => $biodata['religion'],
    'caste' => $biodata['caste'],
    'motherTongue' => $biodata['mother_tongue'],
    'email' => $biodata['email'],
    'phone' => $biodata['phone'],
    'address' => $biodata['address'],
    'education' => $biodata['education'],
    'degree' => $biodata['degree'],
    'occupation' => $biodata['occupation'],
    'income' => $biodata['income'],
    'organization' => $biodata['organization'],
    'fatherName' => $biodata['father_name'],
    'fatherOccupation' => $biodata['father_occupation'],
    'motherName' => $biodata['mother_name'],
    'motherOccupation' => $biodata['mother_occupation'],
    'siblings' => $biodata['siblings'],
    'familyType' => $biodata['family_type'],
    'familyValues' => explode(',', $biodata['family_values']),
    'prefAge' => $biodata['pref_age'],
    'prefHeight' => $biodata['pref_height'],
    'prefReligion' => $biodata['pref_religion'],
    'prefCaste' => $biodata['pref_caste'],
    'prefEducation' => $biodata['pref_education'],
    'prefProfession' => $biodata['pref_profession'],
    'aboutYourself' => $biodata['about_yourself'],
    'partnerExpectations' => $biodata['partner_expectations']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marriage Biodata Form</title>
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <div class="form-container">
        <?php if (isset($_SESSION['add-biodata-error'])): ?>
            <div class="alert-message error">
                <p><?= $_SESSION['add-biodata-error'];
                    unset($_SESSION['add-biodata-error']); ?></p>
            </div>
        <?php elseif (isset($_SESSION['add-biodata-success'])): ?>
            <div class="alert-message success">
                <p><?= $_SESSION['add-biodata-success'];
                    unset($_SESSION['add-biodata-success']); ?></p>
            </div>
        <?php endif ?>

        <div class="form-header">
            <h1>Marriage Biodata</h1>
            <p>Please provide complete information for marriage purposes</p>
        </div>
        <form action="./logic/edit-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="photo-upload">
                <img
                    src="<?= $biodata['profile_photo'] ? './uploads/' . $biodata['profile_photo'] : 'https://via.placeholder.com/180' ?>"
                    alt="Profile Photo"
                    class="photo-preview" />
                <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" />
                <label for="profilePhoto">Change Profile Photo</label>
            </div>
            <div class="row">
                <div class="col">
                    <label for="fullName" class="required-label">Full Name</label>
                    <input
                        type="text"
                        id="fullName"
                        name="fullName"
                        required
                        placeholder="As per official documents"
                        value="<?= $form_data['fullName'] ?>" />
                </div>
                <div class="col">
                    <label for="nickname">Nickname (What you like to be called)</label>
                    <input
                        type="text"
                        id="nickname"
                        name="nickname"
                        placeholder="Preferred name"
                        value="<?= $form_data['nickname'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="dateOfBirth" class="required-label">Date of Birth</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" required
                        value="<?= $form_data['dateOfBirth'] ?>" />
                </div>
                <div class="col">
                    <label for="age">Age</label>
                    <input
                        type="number"
                        id="age"
                        name="age"
                        placeholder="Your current age"
                        value="<?= $form_data['age'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="height">Height</label>
                    <input type="text" id="height" name="height" placeholder="e.g., 5'8\" or 172 cm"
                        value="<?= $form_data['height'] ?>">
                </div>
                <div class="col">
                    <label for="weight">Weight</label>
                    <input
                        type="text"
                        id="weight"
                        name="weight"
                        placeholder="e.g., 65 kg"
                        value="<?= $form_data['weight'] ?>" />
                </div>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input
                            type="radio"
                            id="gender-male"
                            name="gender"
                            value="male"
                            <?= $form_data['gender'] === 'male' ? 'checked' : '' ?> />
                        <label for="gender-male">Male</label>
                    </div>
                    <div class="radio-option">
                        <input
                            type="radio"
                            id="gender-female"
                            name="gender"
                            value="female"
                            <?= $form_data['gender'] === 'female' ? 'checked' : '' ?> />
                        <label for="gender-female">Female</label>
                    </div>
                    <div class="radio-option">
                        <input
                            type="radio"
                            id="gender-other"
                            name="gender"
                            value="other"
                            <?= $form_data['gender'] === 'other' ? 'checked' : '' ?> />
                        <label for="gender-other">Other</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="religion" class="required-label">Religion</label>
                    <select id="religion" name="religion" required>
                        <option value="">Select Religion</option>
                        <option value="hindu" <?= $form_data['religion'] === 'hindu' ? 'selected' : '' ?>>Hindu</option>
                        <option value="muslim" <?= $form_data['religion'] === 'muslim' ? 'selected' : '' ?>>Muslim</option>
                        <option value="christian" <?= $form_data['religion'] === 'christian' ? 'selected' : '' ?>>Christian</option>
                        <option value="sikh" <?= $form_data['religion'] === 'sikh' ? 'selected' : '' ?>>Sikh</option>
                        <option value="jain" <?= $form_data['religion'] === 'jain' ? 'selected' : '' ?>>Jain</option>
                        <option value="buddhist" <?= $form_data['religion'] === 'buddhist' ? 'selected' : '' ?>>Buddhist</option>
                        <option value="other" <?= $form_data['religion'] === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col">
                    <label for="caste">Caste/Community</label>
                    <input
                        type="text"
                        id="caste"
                        name="caste"
                        placeholder="Your caste or community"
                        value="<?= $form_data['caste'] ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="motherTongue">Mother Tongue</label>
                <input
                    type="text"
                    id="motherTongue"
                    name="motherTongue"
                    placeholder="Your native language"
                    value="<?= $form_data['motherTongue'] ?>" />
            </div>
            <h3 class="section-title">Contact Information</h3>
            <div class="row">
                <div class="col">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="kabir@example.com"
                        value="<?= $form_data['email'] ?>" />
                </div>
                <div class="col">
                    <label for="phone" class="required-label">Phone Number</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        required
                        placeholder="+8801745648465"
                        value="<?= $form_data['phone'] ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="address">Current Address</label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    placeholder="Complete address with city and pin code"><?= $form_data['address'] ?></textarea>
            </div>
            <h3 class="section-title">Education & Profession</h3>
            <div class="row">
                <div class="col">
                    <label for="education">Highest Education</label>
                    <select id="education" name="education">
                        <option value="">Select Highest Education</option>
                        <option value="high-school" <?= $form_data['education'] === 'high-school' ? 'selected' : '' ?>>High School</option>
                        <option value="diploma" <?= $form_data['education'] === 'diploma' ? 'selected' : '' ?>>Diploma</option>
                        <option value="graduate" <?= $form_data['education'] === 'graduate' ? 'selected' : '' ?>>Graduate (Bachelor's)</option>
                        <option value="post-graduate" <?= $form_data['education'] === 'post-graduate' ? 'selected' : '' ?>>Post Graduate (Master's)</option>
                        <option value="doctorate" <?= $form_data['education'] === 'doctorate' ? 'selected' : '' ?>>Doctorate (PhD)</option>
                        <option value="other" <?= $form_data['education'] === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col">
                    <label for="degree">Degree/Field of Study</label>
                    <input
                        type="text"
                        id="degree"
                        name="degree"
                        placeholder="e.g., B.Tech Computer Science"
                        value="<?= $form_data['degree'] ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="occupation">Occupation</label>
                    <input
                        type="text"
                        id="occupation"
                        name="occupation"
                        placeholder="Your current profession"
                        value="<?= $form_data['occupation'] ?>" />
                </div>
                <div class="col">
                    <label for="income">Annual Income (approx.)</label>
                    <input
                        type="text"
                        id="income"
                        name="income"
                        placeholder="In INR or currency"
                        value="<?= $form_data['income'] ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="organization">Organization/Company Name</label>
                <input
                    type="text"
                    id="organization"
                    name="organization"
                    placeholder="Where you work"
                    value="<?= $form_data['organization'] ?>" />
            </div>
            <h3 class="section-title">Family Information</h3>
            <div class="family-details">
                <div class="row">
                    <div class="col">
                        <label for="fatherName">Father's Name</label>
                        <input
                            type="text"
                            id="fatherName"
                            name="fatherName"
                            placeholder="Father's full name"
                            value="<?= $form_data['fatherName'] ?>" />
                    </div>
                    <div class="col">
                        <label for="fatherOccupation">Father's Occupation</label>
                        <input
                            type="text"
                            id="fatherOccupation"
                            name="fatherOccupation"
                            placeholder="Father's profession"
                            value="<?= $form_data['fatherOccupation'] ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="motherName">Mother's Name</label>
                        <input
                            type="text"
                            id="motherName"
                            name="motherName"
                            placeholder="Mother's full name"
                            value="<?= $form_data['motherName'] ?>" />
                    </div>
                    <div class="col">
                        <label for="motherOccupation">Mother's Occupation</label>
                        <input
                            type="text"
                            id="motherOccupation"
                            name="motherOccupation"
                            placeholder="Mother's profession"
                            value="<?= $form_data['motherOccupation'] ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="siblings">Siblings (Brothers/Sisters)</label>
                    <input
                        type="text"
                        id="siblings"
                        name="siblings"
                        placeholder="Number and details of siblings"
                        value="<?= $form_data['siblings'] ?>" />
                </div>
                <div class="form-group">
                    <label for="familyType">Family Type</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input
                                type="radio"
                                id="family-joint"
                                name="familyType"
                                value="joint"
                                <?= $form_data['familyType'] === 'joint' ? 'checked' : '' ?> />
                            <label for="family-joint">Joint Family</label>
                        </div>
                        <div class="radio-option">
                            <input
                                type="radio"
                                id="family-nuclear"
                                name="familyType"
                                value="nuclear"
                                <?= $form_data['familyType'] === 'nuclear' ? 'checked' : '' ?> />
                            <label for="family-nuclear">Nuclear Family</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="familyValues">Family Values</label>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="value-traditional"
                                name="familyValues[]"
                                value="traditional"
                                <?= in_array('traditional', $form_data['familyValues']) ? 'checked' : '' ?> />
                            <label for="value-traditional">Traditional</label>
                        </div>
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="value-moderate"
                                name="familyValues[]"
                                value="moderate"
                                <?= in_array('moderate', $form_data['familyValues']) ? 'checked' : '' ?> />
                            <label for="value-moderate">Moderate</label>
                        </div>
                        <div class="checkbox-option">
                            <input
                                type="checkbox"
                                id="value-liberal"
                                name="familyValues[]"
                                value="liberal"
                                <?= in_array('liberal', $form_data['familyValues']) ? 'checked' : '' ?> />
                            <label for="value-liberal">Liberal</label>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="section-title">Partner Preferences (Optional)</h3>
            <div class="row">
                <div class="col">
                    <label for="prefAge">Preferred Age Range</label>
                    <input
                        type="text"
                        id="prefAge"
                        name="prefAge"
                        placeholder="e.g., 25-30 years"
                        value="<?= $form_data['prefAge'] ?>" />
                </div>
                <div class="col">
                    <label for="prefHeight">Preferred Height</label>
                    <input type="text" id="prefHeight" name="prefHeight"
                        placeholder="e.g., 5'4\" to 5'8\""
                        value="<?= $form_data['prefHeight'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="prefReligion">Preferred Religion</label>
                    <select id="prefReligion" name="prefReligion">
                        <option value="">Any</option>
                        <option value="hindu" <?= $form_data['prefReligion'] === 'hindu' ? 'selected' : '' ?>>Hindu</option>
                        <option value="muslim" <?= $form_data['prefReligion'] === 'muslim' ? 'selected' : '' ?>>Muslim</option>
                        <option value="christian" <?= $form_data['prefReligion'] === 'christian' ? 'selected' : '' ?>>Christian</option>
                        <option value="sikh" <?= $form_data['prefReligion'] === 'sikh' ? 'selected' : '' ?>>Sikh</option>
                        <option value="jain" <?= $form_data['prefReligion'] === 'jain' ? 'selected' : '' ?>>Jain</option>
                        <option value="buddhist" <?= $form_data['prefReligion'] === 'buddhist' ? 'selected' : '' ?>>Buddhist</option>
                    </select>
                </div>
                <div class="col">
                    <label for="prefCaste">Preferred Caste/Community</label>
                    <input
                        type="text"
                        id="prefCaste"
                        name="prefCaste"
                        placeholder="Specific caste or 'Any'"
                        value="<?= $form_data['prefCaste'] ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="prefEducation">Preferred Education</label>
                <input
                    type="text"
                    id="prefEducation"
                    name="prefEducation"
                    placeholder="Desired education level"
                    value="<?= $form_data['prefEducation'] ?>" />
            </div>
            <div class="form-group">
                <label for="prefProfession">Preferred Profession</label>
                <input
                    type="text"
                    id="prefProfession"
                    name="prefProfession"
                    placeholder="Desired profession"
                    value="<?= $form_data['prefProfession'] ?>" />
            </div>
            <div class="form-group">
                <label for="aboutYourself">About Yourself</label>
                <textarea
                    id="aboutYourself"
                    name="aboutYourself"
                    rows="4"
                    placeholder="Describe your personality, interests, hobbies, etc."><?= $form_data['aboutYourself'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="partnerExpectations">Expectations from Partner</label>
                <textarea
                    id="partnerExpectations"
                    name="partnerExpectations"
                    rows="4"
                    placeholder="What you're looking for in a life partner"><?= $form_data['partnerExpectations'] ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update Biodata</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="./script.js"></script>
</body>

</html>