<!DOCTYPE html>
<?php
require '../db/config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:../index.php');
}

$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT * FROM `employee` WHERE `employee_id`='$id'");
$sql->execute();
$fetch = $sql->fetch();

$innerJoinSql = "
    SELECT 
        employee.firstname, 
        employee.lastname, 
        order_details.product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        order_details 
    JOIN 
        employee ON order_details.employee_id = employee.employee_id";

$rightJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    RIGHT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";

$leftJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";

$outerJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    RIGHT JOIN 
        order_details ON employee.employee_id = order_details.employee_id
    UNION
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";
?>

<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Employee Dashboard</title>
    <style>
        /* General Styling */
        body {
            background-image: url('https://i.pinimg.com/736x/d6/ea/6f/d6ea6f1ecf597cd976fe10519f495f3a.jpg'); /* Update this with your own background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        
        /* Container Styling */
        .container {
            width: 90%;
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Header */
        .header {
            background-color: #ff66b2;
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 22px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        h3 {
            color: white;
            text-align: center;
            font-size: 28px;
        }

        h4 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
        }

        /* Logout Button */
        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout:hover {
            background-color: green;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: green;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #292929;
        }

        tr:nth-child(odd) {
            background-color: #333;
        }

        tr:hover {
            background-color: #444;
        }

        /* Card Container for Sections */
        .card {
            background-color: #2c2c2c;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card h4 {
            color: white;
            font-size: 22px;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .header, .card {
                font-size: 16px;
                padding: 20px;
            }

            h3 {
                font-size: 24px;
            }

            h4 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logout Button -->
        <a href="logout.php" class="logout">Logout</a>
        
        <!-- Dashboard Header -->
        <h3>Welcome to the Employee Dashboard</h3>
        <h4><?php echo htmlspecialchars($fetch['firstname'] . " " . $fetch['lastname']); ?></h4>

        <!-- Inner Join Results -->
        <div class="card">
            <h4>Inner Join Results</h4>
            <table>
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($innerJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Right Join Results -->
        <div class="card">
            <h4>Right Join Results</h4>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($rightJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Left Join Results -->
        <div class="card">
            <h4>Left Join Results</h4>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($leftJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Outer Join Results -->
        <div class="card">
            <h4>Outer Join Results</h4>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($outerJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
