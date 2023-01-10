<?php include "incl/header.php" ?>

<!-- get employees adn store the data in an array -->
<?php
$sql = 'select * FROM employees';
$result = mysqli_query($conn, $sql);
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <th>id</th>
                <th>details</th>
                <th>contacts</th>
                <!-- <th>department</th>
                <th>hire date</th> -->
                <th>salary(ksh)</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <!--loop through employees gettinng employees details -->
            <?php foreach ($employees as $employee) : ?>
                <tr>

                    <td class="employee_id">
                        <?php echo $employee["id"]; ?>
                    </td>

                    <td class="employee_details">
                        <p><b>Name: </b><?php echo ucwords("{$employee['first_name']} {$employee['last_name']}"); ?></p>
                        <p><b>DOB: </b><?php echo ucwords("{$employee['DOB']}"); ?></p>
                        <p><b>Title: </b><?php echo ucwords("{$employee['Job_title']}"); ?></p>
                    </td>

                    <td class="employee_contacts">
                        <div class="table_cell">
                            <i class="fas fa-phone"></i>
                            <p><?php echo $employee["contact_no."]; ?></p>
                        </div>
                        <div class="table_cell">
                            <i class="fas fa-envelope"></i>
                            <p><?php echo $employee["job_email_address"]; ?></p>
                        </div>
                        <div class="table_cell">
                            <i class="fas fa-map-marker-alt"></i>
                            <p><?php echo $employee["home_address"]; ?></p>
                        </div>
                    </td>

                    <!-- <td class="employee_department">
                        <?php echo $employee["Department"]; ?>
                    </td>

                    <td class="hire_date">
                        <?php echo $employee["Hire_date"]; ?>
                    </td> -->

                    <td class="salary">
                        <?php echo $employee["Salary/m(KSH)"]; ?>
                    </td>

                    <td class="cell_actions">
                        <a aria-label="edit employee" title="edit employee">
                            <i class="fas fa-user-edit edit_employee"></i>
                        </a>
                        <a aria-label="delete employee" title="delete employee">
                            <i class="fas fa-trash-alt delete_employee"></i>
                        </a>
                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>

<?php include "incl/footer.php" ?>