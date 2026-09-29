<?php
// ==========================================================
// CONTROLLER
// This file controls what happens when the user interacts
// with the application.
// ==========================================================

   
// ----------------------------------------------------------
// STEP 1: Load the Model
// ----------------------------------------------------------

require_once "../model/AddressModel.php";


// ----------------------------------------------------------
// STEP 2: Set default form values
// ----------------------------------------------------------

$addressNo = -1;

$firstName = "";
$lastName = "";
$street = "";
$city = "";
$state = "";
$zip = 0;


// Keep track of which action is happening

$edit = false;


// ----------------------------------------------------------
// STEP 3: Check which button the user clicked
// ----------------------------------------------------------

if (isset($_POST['address_no'])) {

    $addressNo = (int)$_POST['address_no'];
}


// ----------------------------------------------------------
// STEP 4: ADD
// ----------------------------------------------------------

if (isset($_POST['add'])) {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    addAddress(
        $conn,
        $firstName,
        $lastName,
        $street,
        $city,
        $state,
        $zip
    );

    // Clear the form after adding

    $addressNo = -1;

    $firstName = "";
    $lastName = "";
    $street = "";
    $city = "";
    $state = "";
    $zip = 0;
}


// ----------------------------------------------------------
// STEP 5: EDIT
// ----------------------------------------------------------

else if (isset($_POST['edit'])) {

    $edit = true;

    $row = getAddress($conn, $addressNo);

    if ($row) {

        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
        $street = $row["Street"];
        $city = $row["City"];
        $state = $row["State"];
        $zip = $row["Zip"];
    }
}


// ----------------------------------------------------------
// STEP 6: UPDATE
// ----------------------------------------------------------

else if (isset($_POST['update'])) {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    updateAddress(
        $conn,
        $addressNo,
        $firstName,
        $lastName,
        $street,
        $city,
        $state,
        $zip
    );

    // Clear the form after updating

    $addressNo = -1;

    $firstName = "";
    $lastName = "";
    $street = "";
    $city = "";
    $state = "";
    $zip = 0;
}


// ----------------------------------------------------------
// STEP 7: DELETE
// ----------------------------------------------------------

else if (isset($_POST['delete'])) {

    deleteAddress($conn, $addressNo);

    $addressNo = -1;
}


// ----------------------------------------------------------
// STEP 8: Get all addresses for the View
// ----------------------------------------------------------

$result = getAllAddresses($conn);


// ----------------------------------------------------------
// STEP 9: Load the View
// ----------------------------------------------------------

require_once "../view/addressView.php";

?>
