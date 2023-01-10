<?php include "incl/header.php" ?>

<?php
$id = $id_number = $first_name = $last_name = $email = $department = $position = $contact_no = $job_title = $home_address = $DOB = $hire_date = NULL;

try {
    //handle form submit
    if (isset($_POST['submit'])) {
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $id_number = (int)filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        $department = strtoupper(filter_input(INPUT_POST, "department", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $job_title = strtoupper(filter_input(INPUT_POST, "job_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $contact_no = (int)filter_input(INPUT_POST, "contact_no", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $home_address = strtoupper(filter_input(INPUT_POST, "home_address", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $DOB = filter_input(INPUT_POST, "DOB", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $hire_date = strtoupper(filter_input(INPUT_POST, "hire_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $salary = 500000;

        switch ($job_title) {
            case ("MANAGER"):
                $salary = 250000;
                break;
            case ("OFFICER"):
                $salary = 150000;
                break;
            default:
                return;
        }

        $sql = "INSERT INTO employees (id, Employee_id, job_email_address, first_name, last_name, id_number, contact_no, home_address, DOB, Job_title, Department, Hire_date, Salary) VALUES ('$id', 18, '$email', '$first_name', '$last_name', $id_number, '$contact_no', '$home_address', '$DOB', '$job_title', '$department', '$hire_date', '$salary')";

        //run the query in database
        if (mysqli_query($conn, $sql)) {
            //on success redirect to employees table
            header("Location: manageEmployees.php");
        } else {
            echo "<script>alert('Error: could not add employee');</script>";
        }
    }
} catch (Exception $err) {
    // echo "error: ", $err->getMessage();
    echo "<script>alert('Error: could not add employee');</script>";
}

?>

<form id="add_employee_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <h2>Add Employee</h2>

    <!-- first name and last name -->
    <section class="group">
        <div class="input_container">
            <label for="first_name"> First Name </label>
            <input name="first_name" id="first_name" type="text" required placeholder="enter first name" />
        </div>

        <div class="input_container">
            <label for="last_name"> Last Name </label>
            <input name="last_name" id="last_name" type="text" required placeholder="enter last name" />
        </div>
    </section>

    <!-- id and countries id number -->
    <section class="group">
        <div class="input_container">
            <label for="id"> Employee Id </label>
            <input name="id" id="id" type="text" required placeholder="employee id format TC***" />
        </div>

        <div class="input_container">
            <label for="id_number"> Id Number </label>
            <input name="id_number" id="id_number" type="text" required placeholder="enter country id card number" maxlength="8" minlength="8" />
        </div>
    </section>

    <!-- email -->
    <div class="input_container">
        <label for="email"> Email </label>
        <input name="email" id="email" type="email" required placeholder="enter work mail" />
    </div>

    <!-- departments and job_title -->
    <section class="group">
        <div class="input_container">
            <label for="department"> Department </label>
            <select name="department" id="department">
                <option value="hr">HR</option>
                <option value="sales">SALES</option>
                <option value="finance">FINANCE</option>
                <option value="IT">IT</option>
                <option value="marketing">MARKETING</option>
                <option value="legal">LEGAL</option>
                <option value="outreach">OUTREACH</option>
            </select>
        </div>

        <div class="input_container">
            <label for="job_title"> Position </label>
            <select name="job_title" id="job_title">
                <option value="manager">MANAGER</option>
                <option value="officer">OFFICER</option>
            </select>
        </div>
    </section>

    <!-- contact_no -->
    <div class="input_container">
        <label for="contact_no">Contact number</label>
        <input name="contact_no" id="contact_no" type="text" required placeholder="enter phone number, format 7******" maxlength="9" minlength="9" />
    </div>

    <!-- script to set display custom error message on contact_no and id_number length violation -->
    <script type="text/javascript" defer>
        const contact_no_input = document.querySelector("#contact_no"),
            id_number_input = document.querySelector("#id_number");

        function setCustomLengthValidtyMsg(el, msg) {
            el.addEventListener("input", () => {
                el.setCustomValidity("");
            });

            el.addEventListener("invalid", () => {
                el.setCustomValidity(msg);
            });
        }

        setCustomLengthValidtyMsg(contact_no_input, "Number must have 9 characters.");
        setCustomLengthValidtyMsg(id_number_input, "Id number contains 8 characters.");
    </script>

    <!-- home_address -->
    <div class="input_container">
        <label for="home_address">Home Address</label>
        <input name="home_address" id="home_address" type="text" required placeholder="enter town city or just city" />
    </div>

    <!-- Hire_date and DOB -->
    <section class="group">
        <div class="input_container">
            <label for="DOB"> DOB </label>
            <input name="DOB" id="DOB" type="text" required placeholder="dd/mm/yyyy" />
        </div>

        <div class="input_container">
            <label for="hire_date"> Hire Date </label>
            <input name="hire_date" id="hire_date" type="text" required placeholder="dd/mm/yyyy" />
        </div>
    </section>

    <!-- form buttons -->
    <section class="group form_actions">
        <button type="reset" class="secondary">Clear Fields</button>
        <button name="submit" type="submit">Add Employee</button>
    </section>
</form>

<?php include "incl/footer.php" ?>