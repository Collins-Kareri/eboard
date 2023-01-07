/*Creating the initial database*/
DROP DATABASE proj_database;
CREATE DATABASE IF NOT EXISTS proj_database;
USE proj_database;

-- /*Customer table creation*/
CREATE TABLE IF NOT EXISTS customers (COL_1 varchar(5), COL_2 varchar(10), COL_3 varchar(9), COL_4 varchar(9), COL_5 varchar(16), COL_6 varchar(16), COL_7 varchar(15), COL_8 varchar(10), COL_9 varchar(7), COL_10 varchar(7)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- /*Insert data into Customer Table*/
INSERT INTO customers VALUES ('id', 'first name', 'last name', 'date', 'sales details', '', '', 'qtty sales', 'amount', 'target'),
 ('', '', '', '', 'Product A (@400)', 'Product B (@200)', 'Product C (@50)', '', '', ''),
 ('TC002', 'Kiptanui ', 'Baliaj', '1/10/2023', '200,000', '50,000', '30,000', '1,350', '280,000', '200,000'),
 ('TC008', 'Cynthia ', 'Obuga', '1/10/2023', '50000', '300000', '10000', '475', '360,000', '100,000'),
 ('TC011', 'Lizel ', 'Murigi', '1/10/2023', '30000', '150000', '20000', '1225', '200,000', '100,000'),
 ('TC014', 'Anam ', 'Omoga', '1/10/2023', '50000', '5000', '5000', '250', '60,000', '100,000'),
 ('TC016', 'Mark ', 'Wanderi', '1/10/2023', '10000', '50000', '40000', '1075', '100,000', '100,000'),
 ('TC017', 'Andrew ', 'Kibiwott', '1/10/2023', '40000', '10000', '15000', '450', '65,000', '100,000'),
 ('', '', '', '', '380,000', '565,000', '120,000', '', '', '');
 
-- /*Employees table creation*/
CREATE TABLE IF NOT EXISTS employees (COL_1 varchar(5), COL_2 varchar(11), COL_3 varchar(19), COL_4 varchar(11), COL_5 varchar(10), COL_6 varchar(10), COL_7 varchar(12), COL_8 varchar(17), COL_9 varchar(10), COL_10 varchar(9), COL_11 varchar(10), COL_12 varchar(7), COL_13 varchar(10), COL_14 varchar(13)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- /*Insert data into Customer Table*/
INSERT INTO employees VALUES ('id', 'Employee_id', 'job email address', 'first name', 'last name', 'id_number', 'contact no','home_address', 'DOB', 'Job_title', 'Department', 'manager', 'Hire date', 'Salary/m(KSH)'),
 ('TC001', '1', 'jndirangu@tc.co.ke', 'Jackline ', 'Ndirangu', '20012548', '734889654', 'westlands nairobi', '1/20/1970', 'CEO', 'CEO', 'CEO', '12/20/2022', '500,000'),
 ('TC002', '2', 'kbaliaj@tc.co.ke', 'Kiptanui ', 'Baliaj', '20145698', '722894563', 'nairobi', '8/4/1996', 'MANAGER', 'Sales', 'MD', '1/4/2023', '250000'),
 ('TC003', '3', 'ckareri@tc.co.ke', 'Collins ', 'Kareri', '21478963', '719333456', 'parklands nairobi', '12/6/1990', 'MANAGER', 'IT', 'MD', '1/4/2023', '250,000'),
 ('TC004', '4', 'dakoi@tc.co.ke', 'Dvock ', 'Akoi', '22589643', '718565656', 'nairobi', '6/4/1995', 'MANAGER', 'Finance', 'MD', '1/4/2023', '250000'),
 ('TC005', '5', 'lnzisa@tc.co.ke', 'Leah ', 'Nzisa', '21894352', '714636963', 'nairobi', '3/6/1998', 'OFFICER', 'HR', 'MANAGER', '1/4/2023', '150,000'),
 ('TC006', '6', 'lsawe@tc.co.ke', 'Lewis ', 'Sawe', '22896347', '725105005', 'nairobi', '4/2/1975', 'OFFICER', 'Finance', 'MANAGER', '1/4/2023', '150,000'),
 ('TC007', '7', 'vmutai@tc.co.ke', 'Vivianna ', 'Mutai', '20024563', '733452698', 'westlands nairobi', '7/15/1979', 'MD', 'CEO', 'CEO', '12/20/2022', '400,000'),
 ('TC008', '8', 'cobuga@tc.co.ke', 'Cynthia ', 'Obuga', '19524178', '722639363', 'nairobi', '3/4/2001', 'OFFICER', 'Sales', 'MANAGER', '1/4/2023', '150,000'),
 ('TC009', '9', 'snjoroge@tc.co.ke', 'Samuel ', 'Njoroge', '20007965', '720568974', 'nairobi', '5/7/1989', 'OFFICER', 'Legal', 'MANAGER', '1/4/2023', '150,000'),
 ('TC010', '10', 'smurimi@tc.co.ke', 'Steve ', 'Murimi', '18945203', '720807060', 'lavington nairobi', '10/16/1982', 'OFFICER', 'IT', 'MANAGER', '1/4/2023', '150,000'),
 ('TC011', '11', 'lmurigi@tc.co.ke', 'Lizel ', 'Murigi', '21879654', '733658741', 'nairobi', '2/4/1994', 'OFFICER', 'Sales', 'MANAGER', '1/4/2023', '150,000'),
 ('TC012', '12', 'fyegon@tc.co.ke', 'Festus', 'Yegon', '22634189', '735256525', 'nairobi', '7/3/1993', 'MANAGER', 'Legal', 'MD', '1/4/2023', '250000'),
 ('TC013', '13', 'pchepkirui@tc.co.ke', 'Patience ', 'Chepkirui', '24895623', '702428442', 'nairobi', '2/6/1997', 'OFFICER', 'Finance', 'MANAGER', '1/4/2023', '150,000'),
 ('TC014', '14', 'aomoga@tc.co.ke', 'Anam ', 'Omoga', '21854565', '701234987', 'nairobi', '3/8/1996', 'OFFICER', 'Sales', 'MANAGER', '1/4/2023', '150,000'),
 ('TC015', '15', 'gmugambi@tc.co.ke', 'Gaceri ', 'Mugambi', '20213254', '723414182', 'nairobi', '2/9/2003', 'MANAGER', 'HR', 'MD', '1/4/2023', '250000'),
 ('TC016', '16', 'mwanderi@tc.co.ke', 'Mark ', 'Wanderi', '20030508', '722858595', 'nairobi', '9/4/1993', 'OFFICER', 'Sales', 'MANAGER', '1/4/2023', '150,000'),
 ('TC017', '17', 'akibiwott@tc.co.ke', 'Andrew ', 'Kibiwott', '21436587', '726363936', 'nairobi', '8/7/1997', 'OFFICER', 'Sales', 'MANAGER', '1/4/2023', '150,000');


-- /*Managers table creation*/
CREATE TABLE IF NOT EXISTS managers (COL_1 varchar(2), COL_2 varchar(11)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- /*Insert data into Managers Table*/ 
INSERT INTO managers VALUES ('id', 'Designation'), ('1', 'CEO'), ('2', 'Manager'), ('3', 'MD');


-- /*Product table creation*/
CREATE TABLE IF NOT EXISTS products (COL_1 varchar(4), COL_2 varchar(12), COL_3 varchar(13)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- /*Insert data into products Table*/ 
INSERT INTO products VALUES ('id', 'Product Name', 'Product price'), ('PD01', 'A', '400'), ('PD02', 'B', '200'), ('PD03', 'C', '50');

-- /*Sales table creation*/
CREATE TABLE IF NOT EXISTS sales (COL_1 varchar(5), COL_2 varchar(10), COL_3 varchar(9), COL_4 varchar(9), COL_5 varchar(16), COL_6 varchar(16), COL_7 varchar(15), COL_8 varchar(10), COL_9 varchar(7), COL_10 varchar(7)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


-- /*Insert data into Sales Table*/ 
INSERT INTO sales VALUES ('id', 'first name', 'last name', 'date', 'sales details', '', '', 'qtty sales', 'amount', 'target'),
 ('', '', '', '', 'Product A (@400)', 'Product B (@200)', 'Product C (@50)', '', '', ''),
 ('TC002', 'Kiptanui ', 'Baliaj', '1/10/2023', '200,000', '50,000', '30,000', '1,350', '280,000', '200,000'),
 ('TC008', 'Cynthia ', 'Obuga', '1/10/2023', '50000', '300000', '10000', '475', '360,000', '100,000'),
 ('TC011', 'Lizel ', 'Murigi', '1/10/2023', '30000', '150000', '20000', '1225', '200,000', '100,000'),
 ('TC014', 'Anam ', 'Omoga', '1/10/2023', '50000', '5000', '5000', '250', '60,000', '100,000'),
 ('TC016', 'Mark ', 'Wanderi', '1/10/2023', '10000', '50000', '40000', '1075', '100,000', '100,000'),
 ('TC017', 'Andrew ', 'Kibiwott', '1/10/2023', '40000', '10000', '15000', '450', '65,000', '100,000');