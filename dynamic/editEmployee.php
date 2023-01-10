<?php
include "incl/header.php"
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $employee = mysqli_fetch_array($result);
}

try {
    //update data in database
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
        $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "UPDATE employees SET job_email_address='$email',first_name='$first_name',last_name='$last_name',id_number=$id_number,contact_no=$contact_no,home_address='$home_address',DOB='$DOB',Job_title='$job_title',Department='$department',Hire_date='$hire_date',Salary='$salary' WHERE id='$id'";
        //run the query in database
        if (mysqli_query($conn, $sql)) {
            //on success redirect to employees table
            header("Location: manageEmployees.php");
        } else {
            echo "<script>alert('Error: could not edit employee.');</script>";
        }
    }
} catch (Exception $err) {
    echo "<script>alert('Error: could not edit employee.');</script>";
}
?>

<?php if (empty($employee)) : ?>
    <p style="text-align: center;">
        No Employee found
    </p>
<?php else : ?>
    <form id="edit_employee_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <h2>Edit Employee</h2>

        <input type="hidden" style="display: none;" id="id" name="id" value="<?php echo $employee["id"]; ?>" />

        <!-- first name and last name -->
        <section class="group">
            <div class="input_container">
                <label for="first_name"> First Name </label>
                <input name="first_name" id="first_name" type="text" required placeholder="enter first name" value="<?php echo $employee["first_name"] ?>" />
            </div>

            <div class="input_container">
                <label for="last_name"> Last Name </label>
                <input name="last_name" id="last_name" type="text" required placeholder="enter last name" value="<?php echo $employee["last_name"] ?>" />
            </div>
        </section>

        <!-- email and countries id number -->
        <section class="group">
            <div class="input_container">
                <label for="email"> Email </label>
                <input name="email" id="email" type="email" required placeholder="enter work mail" value="<?php echo $employee["job_email_address"] ?>" />
            </div>

            <div class="input_container">
                <label for="id_number"> Id Number </label>
                <input name="id_number" id="id_number" type="text" required placeholder="enter country id card number" maxlength="8" minlength="8" value="<?php echo $employee["id_number"] ?>" />
            </div>
        </section>

        <!-- departments and job_title -->
        <section class="group">
            <div class="input_container">
                <label for="department"> Department </label>
                <select name="department" id="department">
                    <option value="ceo">CEO</option>
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
                    <option value="ceo">CEO</option>
                    <option value="manager">MANAGER</option>
                    <option value="officer">OFFICER</option>
                </select>
            </div>
        </section>

        <!-- to set default values on the department dropdown and job_title dropdown -->
        <script type="text/javascript">
            //element that contain department options
            const department_dropdown_el = document.querySelector('#department');

            //the department value as from database
            const employee_department_value = "<?php echo $employee["Department"] ?>";

            //element that contain job_title options
            const job_title_dropdown_el = document.querySelector('#job_title');

            //the job_title value as from database
            const employee_job_title_value = "<?php echo $employee["Job_title"] ?>";

            //loop through options from deparment dropdown element
            for (let option of department_dropdown_el) {
                if (employee_department_value.length > 0 && (option.value.toLowerCase() === employee_department_value.toLowerCase())) {
                    option.selected = true;
                    break;
                }
            }

            //loop through options from job_title dropdown element
            for (let option of job_title_dropdown_el) {
                if (employee_job_title_value.length > 0 && (option.value.toLowerCase() === employee_job_title_value.toLowerCase())) {
                    option.selected = true;
                    break;
                }
            }
        </script>

        <div class="input_container">
            <label for="salary">Salary</label>
            <input name="salary" id="salary" type="text" required value="<?php echo $employee["Salary"] ?>" />
        </div>

        <!-- contact_no -->
        <div class="input_container">
            <label for="contact_no">Contact number</label>
            <input name="contact_no" id="contact_no" type="text" required placeholder="enter phone number, format 7******" maxlength="9" minlength="9" value="<?php echo $employee["contact_no"] ?>" />
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
            <input name="home_address" id="home_address" type="text" required placeholder="enter town city or just city" value="<?php echo $employee["home_address"] ?>" />
        </div>

        <!-- Hire_date and DOB -->
        <section class="group">
            <div class="input_container">
                <label for="DOB"> DOB </label>
                <input name="DOB" id="DOB" type="text" required placeholder="dd/mm/yyyy" value="<?php echo $employee["DOB"] ?>" />
            </div>

            <div class="input_container">
                <label for="hire_date"> Hire Date </label>
                <input name="hire_date" id="hire_date" type="text" required placeholder="dd/mm/yyyy" value="<?php echo $employee["Hire_date"] ?>" />
            </div>
        </section>

        <!-- form buttons -->
        <section class="group form_actions">
            <button class="secondary" id="cancel" type="button">Cancel</button>
            <button name="submit" type="submit">Update Employee</button>
        </section>

        <!-- cancel button functionality -->
        <script type="text/javascript">
            //element that contain department options
            const cancel_button = document.querySelector("#cancel");

            cancel_button.addEventListener("click", (evt) => {
                evt.preventDefault();
                evt.stopImmediatePropagation();
                location.href = "manageEmployees.php";
            });
        </script>
    </form>
<?php endif; ?>

<?php
include "incl/footer.php";
?>