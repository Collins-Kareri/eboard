<?php
//import your database configurations
include "config/database.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../index.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/8c33923d38.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <main id="container">
        <div id="sidebar">
            <h2 style="white-space: nowrap; margin-bottom:16px;">Employee Dashboard</h2>
            <section id="sidebar_header">
                <div id="current_user">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p class="username">John Doe</p>
                    <p class="title">Hr Manager</p>
                </div>
                <a id="add_employee" href="../addEmployee.php">
                    <button style="margin-top: 8px; margin-bottom:16px;" id="add_employee">
                        <i class="fas fa-user-plus" style="margin-right:8px;"></i>
                        Add Employee
                    </button>
                </a>
            </section>
            <a class="active sidebar_link" href="../manageEmployees.php
            ">Manage Employees</a>
        </div>
        <div id="content">