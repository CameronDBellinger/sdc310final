<?php
// ==========================================================
// MODEL
// This file handles the database connection and SQL queries.
// ==========================================================
 

// ----------------------------------------------------------
// STEP 1: Connect to the database
// ----------------------------------------------------------

$hostname = "localhost";
$username = "ecpi_user";
$password = "Password1";
$dbname = "sdc310midterm";

$conn = mysqli_connect(
    $hostname,
    $username,
    $password,
    $dbname
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


// ----------------------------------------------------------
// STEP 2: Create the table if it does not exist
// ----------------------------------------------------------

$createTable = "CREATE TABLE IF NOT EXISTS personalinfo (
    AddressNo INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(25) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Street VARCHAR(100) NOT NULL,
    City VARCHAR(25) NOT NULL,
    State VARCHAR(2) NOT NULL,
    Zip INT NOT NULL,
    PRIMARY KEY (AddressNo)
)";

if (!mysqli_query($conn, $createTable)) {
    die("Table creation error: " . mysqli_error($conn));
}


// ----------------------------------------------------------
// STEP 3: Add sample data if the table is empty
// ----------------------------------------------------------

$countQuery = "SELECT COUNT(*) AS total FROM personalinfo";

$countResult = mysqli_query($conn, $countQuery);

$countRow = mysqli_fetch_assoc($countResult);

if ($countRow["total"] == 0) {

    $sample1 = "INSERT INTO personalinfo
        (FirstName, LastName, Street, City, State, Zip)
        VALUES
        ('Cameron', 'Bellinger', '1111 Up St', 'Uptown', 'UV', 12345)";

    $sample2 = "INSERT INTO personalinfo
        (FirstName, LastName, Street, City, State, Zip)
        VALUES
        ('Jan', 'Smith', '1111 Down St', 'DownVille', 'DV', 54321)";

    mysqli_query($conn, $sample1);
    mysqli_query($conn, $sample2);
}


// ==========================================================
// DATABASE FUNCTIONS
// ==========================================================


// ----------------------------------------------------------
// STEP 4: Get all addresses
// ----------------------------------------------------------

function getAllAddresses($conn)
{
    $query = "SELECT * FROM personalinfo ORDER BY AddressNo";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Display error: " . mysqli_error($conn));
    }

    return $result;
}


// ----------------------------------------------------------
// STEP 5: Get one address for editing
// ----------------------------------------------------------

function getAddress($conn, $addressNo)
{
    $addressNo = (int)$addressNo;

    $query = "SELECT * FROM personalinfo
              WHERE AddressNo = $addressNo";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Edit error: " . mysqli_error($conn));
    }

    return mysqli_fetch_assoc($result);
}


// ----------------------------------------------------------
// STEP 6: Add a new address
// ----------------------------------------------------------

function addAddress(
    $conn,
    $firstName,
    $lastName,
    $street,
    $city,
    $state,
    $zip
) {

    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $street = mysqli_real_escape_string($conn, $street);
    $city = mysqli_real_escape_string($conn, $city);
    $state = mysqli_real_escape_string($conn, $state);
    $zip = (int)$zip;

    $query = "INSERT INTO personalinfo
        (FirstName, LastName, Street, City, State, Zip)
        VALUES
        ('$firstName', '$lastName', '$street', '$city', '$state', $zip)";

    if (!mysqli_query($conn, $query)) {
        die("Add error: " . mysqli_error($conn));
    }
}


// ----------------------------------------------------------
// STEP 7: Update an existing address
// ----------------------------------------------------------

function updateAddress(
    $conn,
    $addressNo,
    $firstName,
    $lastName,
    $street,
    $city,
    $state,
    $zip
) {

    $addressNo = (int)$addressNo;

    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $street = mysqli_real_escape_string($conn, $street);
    $city = mysqli_real_escape_string($conn, $city);
    $state = mysqli_real_escape_string($conn, $state);
    $zip = (int)$zip;

    $query = "UPDATE personalinfo SET
        FirstName = '$firstName',
        LastName = '$lastName',
        Street = '$street',
        City = '$city',
        State = '$state',
        Zip = $zip
        WHERE AddressNo = $addressNo";

    if (!mysqli_query($conn, $query)) {
        die("Update error: " . mysqli_error($conn));
    }
}


// ----------------------------------------------------------
// STEP 8: Delete an address
// ----------------------------------------------------------

function deleteAddress($conn, $addressNo)
{
    $addressNo = (int)$addressNo;

    $query = "DELETE FROM personalinfo
              WHERE AddressNo = $addressNo";

    if (!mysqli_query($conn, $query)) {
        die("Delete error: " . mysqli_error($conn));
    }
}
?>
