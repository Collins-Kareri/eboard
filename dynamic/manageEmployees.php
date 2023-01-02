<?php
    include "incl/header.php" 
?>

<!-- get employees and store the data in an array -->
<?php
    $sql = 'select * FROM employees_data';
    $result=mysqli_query($conn,$sql);
    $employees=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<!-- check if employees array is empty -->
<?php if (empty($employees)) : ?>
    <p style="text-align: center;">
        NO EMPLOYEES
        <br />
        <a href="./addEmployee.php">
            <button style="margin-top: 8px; margin-bottom:16px;" id="add_employee">
                <i class="fas fa-user-plus" style="margin-right:8px;"></i>
                Add Employee
            </button>
        </a>
    </p>
<?php else : ?>
    <table id="employee_table">
        <caption style="display: table-caption; text-align:left; text-transform:uppercase;margin-bottom:16px;">Employees</caption>
        <thead>
            <tr>
                <th>
                    id
                </th>
                <th>
                    name
                </th>
                <th>
                    contacts
                </th>
                <th>
                    department
                </th>
                <th>
                    status
                </th>
            </tr>
        </thead>

        <tbody>
            <!--loop through employees gettinng employees details -->
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td class="employee_id">
                        <?php echo $employee["employee_id"]; ?>
                    </td>

                    <td class="employee_names">
                        <?php echo ucwords("${employee['first_name']} ${employee['last_name']}"); ?>
                    </td>

                    <td class="employee_contacts">
                        <div class="table_cell">
                            <i class="fas fa-phone"></i>
                            <p><?php echo $employee["phone_number"]; ?></p>
                        </div>
                        <div class="table_cell">
                            <i class="fas fa-envelope"></i>
                            <p><?php echo $employee["email"]; ?></p>
                        </div>
                    </td>

                    <td class="employee_department">
                        <?php echo $employee["department"]; ?>
                    </td>

                    <td class="employee_status">
                        <?php echo strtolower($employee["employee_status"]); ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>

<?php include "incl/footer.php" ?>