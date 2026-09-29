<!DOCTYPE html>
<html>

<head>

    <!-- =====================================================
         VIEW
         This file controls what the user sees.
         ===================================================== -->

    <title>Cameron Bellinger Midterm/Final MVC Model</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            color: darkblue;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: lightblue;
        }

        tr:nth-child(even) {
            background-color: whitesmoke;
        }

        tr:nth-child(odd) {
            background-color: lightgray;
        }

        input {
            margin: 5px;
            padding: 7px;
        }

        .form-section {
            border: 1px solid black;
            padding: 20px;
            width: 500px;
        }

        .button {
            padding: 8px 15px;
            cursor: pointer;
        }

    </style>

</head>

<body>


<!-- =====================================================
     PAGE TITLE
     ===================================================== -->

<h1>Cameron Bellinger Midterm/Final MVC Model</h1>

<h2>Address Book</h2>


<!-- =====================================================
     ADDRESS TABLE
     ===================================================== -->

<table>

    <tr>

        <th>Address No.</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Street</th>

        <th>City</th>

        <th>State</th>

        <th>Zip</th>

        <th>Edit</th>

        <th>Delete</th>

    </tr>


    <!-- =================================================
         DISPLAY DATABASE RECORDS
         ================================================= -->

    <?php while ($row = mysqli_fetch_assoc($result)): ?>

    <tr>

        <td>
            <?php echo htmlspecialchars($row["AddressNo"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["FirstName"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["LastName"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["Street"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["City"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["State"]); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row["Zip"]); ?>
        </td>


        <!-- =============================================
             EDIT BUTTON
             ============================================= -->

        <td>

            <form method="POST">

                <input
                    type="hidden"
                    name="address_no"
                    value="<?php echo $row["AddressNo"]; ?>"
                >

                <input
                    class="button"
                    type="submit"
                    name="edit"
                    value="Edit"
                >

            </form>

        </td>


        <!-- =============================================
             DELETE BUTTON
             ============================================= -->

        <td>

            <form method="POST">

                <input
                    type="hidden"
                    name="address_no"
                    value="<?php echo $row["AddressNo"]; ?>"
                >

                <input
                    class="button"
                    type="submit"
                    name="delete"
                    value="Delete"
                >

            </form>

        </td>

    </tr>

    <?php endwhile; ?>

</table>


<!-- ====================================================
     ADD / UPDATE FORM
     ===================================================== -->

<div class="form-section">


    <!-- Change heading depending on edit mode -->

    <h2>

        <?php

        if ($edit) {

            echo "Update Address";

        } else {

            echo "Add Address";

        }

        ?>

    </h2>


    <form method="POST">


        <!-- Address Number -->

        <input
            type="hidden"
            name="address_no"
            value="<?php echo $addressNo; ?>"
        >


        <!-- First Name -->

        <label>First Name:</label>

        <br>

        <input
            type="text"
            name="first_name"
            maxlength="25"
            value="<?php echo htmlspecialchars($firstName); ?>"
            required
        >
 
        <br>


        <!-- Last Name -->

        <label>Last Name:</label>

        <br>

        <input
            type="text"
            name="last_name"
            maxlength="30"
            value="<?php echo htmlspecialchars($lastName); ?>"
            required
        >

        <br>


        <!-- Street -->

        <label>Street:</label>

        <br>

        <input
            type="text"
            name="street"
            maxlength="100"
            value="<?php echo htmlspecialchars($street); ?>"
            required
        >

        <br>


        <!-- City -->

        <label>City:</label>

        <br>

        <input
            type="text"
            name="city"
            maxlength="25"
            value="<?php echo htmlspecialchars($city); ?>"
            required
        >

        <br>


        <!-- State -->

        <label>State:</label>

        <br>

        <input
            type="text"
            name="state"
            maxlength="2"
            value="<?php echo htmlspecialchars($state); ?>"
            required
        >

        <br>


        <!-- Zip -->

        <label>Zip:</label>

        <br>

        <input
            type="number"
            name="zip"
            value="<?php echo htmlspecialchars($zip); ?>"
            required
        >

        <br><br>


        <!-- =============================================
             ADD OR UPDATE BUTTON
             ============================================= -->

        <?php if ($edit): ?>

            <input
                class="button"
                type="submit"
                name="update"
                value="Update Address"
            >

        <?php else: ?>

            <input
                class="button"
                type="submit"
                name="add"
                value="Add Address"
            >

        <?php endif; ?>


    </form>

</div>


</body>

</html>
