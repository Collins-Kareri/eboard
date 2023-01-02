<?php include "incl/header.php" ?>

<?php
    $first_name=$last_name=$email=$department=$position=$phone_no=$employee_status=NULL;

    //handle form submit
    if (isset($_POST['submit'])) {
        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    
        $department = strtoupper(filter_input(INPUT_POST, "department", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    
        $position = strtoupper(filter_input(INPUT_POST, "position", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    
        $phone_no = filter_input(INPUT_POST, "phone_no", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $employee_status = strtoupper(filter_input(INPUT_POST, "employee_status", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    
        $sql = "INSERT INTO employees_data (first_name,last_name,email,department,employee_position,phone_number,employee_status) VALUES ('$first_name','$last_name','$email','$department','$position','$phone_no','$employee_status')";
    
        //run the query in database
        if (mysqli_query($conn, $sql)) {
            //on success redirect to employees table
            header("Location: manageEmployees.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
        
?>

<form id="add_employee_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
    <h2>Add Employee</h2>

    <section class="group">
        <div class="input_container">
            <label for="first_name">
                First Name
            </label>
            <input name="first_name" id="first_name" type="text" required />
        </div>

        <div class="input_container">
            <label for="last_name">
                Last Name
            </label>
            <input name="last_name" id="last_name" type="text" required />
        </div>
    </section>


    <div class="input_container">
        <label for="email">
            Email
        </label>
        <input name="email" id="email" type="email" required />
    </div>

    <section class="group">
        <div class="input_container">
            <label for="department">
                Department
            </label>
            <select name="department" id="department">
                <option value="hr">hr</option>
                <option value="finance">finance</option>
                <option value="IT">it</option>
                <option value="marketing">marketing</option>
                <option value="legal">legal</option>
                <option value="outreach">outreach</option>
            </select>
        </div>

        <div class="input_container">
            <label for="position">
                Position
            </label>
            <select name="position" id="position">
                <option value="manager">manager</option>
                <option value="member">member</opt>
            </select>
        </div>
    </section>

    <div class="input_container">
        <label for="phone_no">
            Phone Number
        </label>
        <input name="phone_no" id="phone_no" type="text" required />
    </div>

    <div class="input_container">
        <label for="employee_status">
            Employee Status
        </label>
        <select name="employee_status" id="employee_status" required>
            <option value="full_time">full-time</option>
            <option value="part_time">part-time</option>
            <option value="contract">contract</option>
            <option value="laid_off">laid-off</option>
        </select>
    </div>

    <section class="group">
        <button type="reset" class="secondary">Clear Fields</button>
        <button type="submit" name="submit">Add Employee</button>
    </section>

</form>

<?php include "incl/footer.php" ?>