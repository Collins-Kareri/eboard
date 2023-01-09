<?php
include "incl/header.php"
?>

<!-- get employees adn store the data in an array -->
<?php
$sql = 'SELECT * FROM employees';
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
    <div class="my_grid">
        <!--loop through employees gettinng employees details -->
        <?php foreach ($employees as $employee) : ?>
            <div class="employee_details_card">
                <section class="card_actions">
                    <a aria-label="edit employee" title="edit employee" href="editEmployee.php?id=<?php echo $employee['id'] ?>">
                        <i class="fas fa-user-edit edit_employee"></i>
                    </a>
                    <a aria-label="delete employee" title="delete employee" onclick="deleteEmployee('<?php echo $employee["id"]; ?>')">
                        <i class="fas fa-trash-alt delete_employee"></i>
                    </a>
                </section>

                <script type="text/javascript">
                    function deleteEmployee(id) {
                        fetch("deleteEmployee.php", {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id
                            })
                        }).then(async (res) => {
                            if (res.ok) {
                                alert("delete successful");
                                location.href = "manageEmployees.php";
                            } else {
                                alert("couldn't delete employee");
                            }
                        });
                        return;
                    }
                </script>

                <section class="card_group">
                    <p>
                        <b>Id: </b>
                        <?php echo $employee["id"]; ?>
                    </p>
                    <p>
                        <b>Name: </b>
                        <?php echo ucwords("{$employee['first_name']} {$employee['last_name']}"); ?>
                    </p>
                    <p>
                        <b>Dob: </b>
                        <?php echo $employee['DOB']; ?>
                    </p>
                    <p>
                        <b>Id number: </b>
                        <?php echo $employee['id_number']; ?>
                    </p>
                </section>
                <section class="card_group">
                    <p>
                        <b><i class="fas fa-envelope"></i> </b>
                        <?php echo $employee["job_email_address"]; ?>
                    </p>
                    <p>
                        <b><i class="fas fa-phone"></i> </b>
                        <?php echo $employee["contact_no"]; ?>
                    </p>
                    <p>
                        <b><i class="fas fa-map-marker-alt"></i> </b>
                        <?php echo $employee["home_address"]; ?>
                    </p>
                </section>


                <section class="card_group">
                    <p>
                        <b>Department: </b>
                        <?php echo $employee["Department"]; ?>
                    </p>
                    <p>
                        <b>Position: </b>
                        <?php echo $employee["Job_title"]; ?>
                    </p>
                    <p>
                        <b>Salary: </b>
                        <?php echo $employee["Salary"]; ?>
                    </p>
                    <p>
                        <b>Hiring date: </b>
                        <?php echo $employee["Hire_date"]; ?>
                    </p>
                </section>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include "incl/footer.php" ?>