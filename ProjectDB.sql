-- Creating the initial database
DROP database proj_database;
CREATE DATABASE IF NOT EXISTS proj_database;

-- Customer table creation
CREATE TABLE IF NOT EXISTS proj_database.customers (
  COL1 varchar(5),
  COL2 varchar(10),
  COL3 varchar(9),
  COL4 varchar(9),
  COL5 varchar(16),
  COL6 varchar(16),
  COL7 varchar(15),
  COL8 varchar(10),
  COL9 varchar(7),
  COL10 varchar(7)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Insert data into Customer Table
INSERT INTO `proj_database`.`customers` VALUES 
('id', 'first name', 'last name', 'date', 'sales details', '', '', 'qtty sales', 'amount', 'target'),
('', '', '', '', 'Product A (@400)', 'Product B (@200)', 'Product C (@50)', '', '', ''),
('TC002', 'Kiptanui ', 'Baliaj', '1/10/2023', '200,000', '50,000', '30,000', '1,350', '280,000', '200,000'),
('TC008', 'Cynthia ', 'Obuga', '1/10/2023', '50000', '300000', '10000', '475', '360,000', '100,000'),
('TC011', 'Lizel ', 'Murigi', '1/10/2023', '30000', '150000', '20000', '1225', '200,000', '100,000'),
('TC014', 'Anam ', 'Omoga', '1/10/2023', '50000', '5000', '5000', '250', '60,000', '100,000'),
('TC016', 'Mark ', 'Wanderi', '1/10/2023', '10000', '50000', '40000', '1075', '100,000', '100,000'),
('TC017', 'Andrew ', 'Kibiwott', '1/10/2023', '40000', '10000', '15000', '450', '65,000', '100,000'),
('', '', '', '', '380,000', '565,000', '120,000', '', '', '');

 
-- Employees table creation
CREATE TABLE IF NOT EXISTS `proj_database`.`employees` (
`id` varchar(255),
  `job_email_address` varchar(255),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `id_number` int(8),
  `contact_no` int(9),
  `home_address` varchar(255),
  `DOB` varchar(255),
  `Job_title` varchar(255),
  `Department` varchar(255),
  `Hire_date` varchar(255),
  `Salary` varchar(255)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- insert data into employee TABLE
INSERT INTO `proj_database`.`employees` (
`id`,
    `job_email_address`,
    `first_name`,
    `last_name`,
    `id_number`,
    `contact_no`,
    `home_address`,
    `DOB`,
    `Job_title`,
    `Department`,
    `Hire_date`,
    `Salary`
  )
VALUES (
'TC001',
    'jndirangu@tc.co.ke',
    'Jackline ',
    'Ndirangu',
    20012548,
    734889654,
    'westlands nairobi',
    '1/20/1970',
    'CEO',
    'CEO',
    '12/20/2022',
    '500,000'
  ),
(
  'TC002',
  'kbaliaj@tc.co.ke',
  'Kiptanui ',
  'Baliaj',
  20145698,
  722894563,
  'nairobi',
  '8/4/1996',
  'MANAGER',
  'Sales',
  '1/4/2023',
  '250000'
),
(
  'TC003',
  'ckareri@tc.co.ke',
  'Collins ',
  'Kareri',
  21478963,
  719333456,
  'parklands nairobi',
  '12/6/1990',
  'MANAGER',
  'IT',
  '1/4/2023',
  '250,000'
),
(
  'TC004',
  'dakoi@tc.co.ke',
  'Dvock ',
  'Akoi',
  22589643,
  718565656,
  'nairobi',
  '6/4/1995',
  'MANAGER',
  'Finance',
  '1/4/2023',
  '250000'
),
(
  'TC005',
  'lnzisa@tc.co.ke',
  'Leah ',
  'Nzisa',
  21894352,
  714636963,
  'nairobi',
  '3/6/1998',
  'OFFICER',
  'HR',
  '1/4/2023',
  '150,000'
),
(
  'TC006',
  'lsawe@tc.co.ke',
  'Lewis ',
  'Sawe',
  22896347,
  725105005,
  'nairobi',
  '4/2/1975',
  'OFFICER',
  'Finance',
  '1/4/2023',
  '150,000'
),
(
  'TC007',
  'vmutai@tc.co.ke',
  'Vivianna ',
  'Mutai',
  20024563,
  733452698,
  'westlands nairobi',
  '7/15/1979',
  'MD',
  'CEO',
  '12/20/2022',
  '400,000'
),
(
  'TC008',
  'cobuga@tc.co.ke',
  'Cynthia ',
  'Obuga',
  19524178,
  722639363,
  'nairobi',
  '3/4/2001',
  'OFFICER',
  'Sales',
  '1/4/2023',
  '150,000'
),
(
  'TC009',
  'snjoroge@tc.co.ke',
  'Samuel ',
  'Njoroge',
  20007965,
  720568974,
  'nairobi',
  '5/7/1989',
  'OFFICER',
  'Legal',
  '1/4/2023',
  '150,000'
),
(
  'TC010',
  'smurimi@tc.co.ke',
  'Steve ',
  'Murimi',
  18945203,
  720807060,
  'lavington nairobi',
  '10/16/1982',
  'OFFICER',
  'IT',
  '1/4/2023',
  '150,000'
),
(
  'TC011',
  'lmurigi@tc.co.ke',
  'Lizel ',
  'Murigi',
  21879654,
  733658741,
  'nairobi',
  '2/4/1994',
  'OFFICER',
  'Sales',
  '1/4/2023',
  '150,000'
),
(
  'TC012',
  'fyegon@tc.co.ke',
  'Festus',
  'Yegon',
  22634189,
  735256525,
  'nairobi',
  '7/3/1993',
  'MANAGER',
  'Legal',
  '1/4/2023',
  '250000'
),
(
  'TC013',
  'pchepkirui@tc.co.ke',
  'Patience ',
  'Chepkirui',
  24895623,
  702428442,
  'nairobi',
  '2/6/1997',
  'OFFICER',
  'Finance',
  '1/4/2023',
  '150,000'
),
(
  'TC014',
  'aomoga@tc.co.ke',
  'Anam ',
  'Omoga',
  21854565,
  701234987,
  'nairobi',
  '3/8/1996',
  'OFFICER',
  'Sales',
  '1/4/2023',
  '150,000'
),
(
  'TC015',
  'gmugambi@tc.co.ke',
  'Gaceri ',
  'Mugambi',
  20213254,
  723414182,
  'nairobi',
  '2/9/2003',
  'MANAGER',
  'HR',
  '1/4/2023',
  '250000'
),
(
  'TC016',
  'mwanderi@tc.co.ke',
  'Mark ',
  'Wanderi',
  20030508,
  722858595,
  'nairobi',
  '9/4/1993',
  'OFFICER',
  'Sales',
  '1/4/2023',
  '150,000'
),
(
  'TC017',
  'akibiwott@tc.co.ke',
  'Andrew ',
  'Kibiwott',
  21436587,
  726363936,
  'nairobi',
  '8/7/1997',
  'OFFICER',
  'Sales',
  '1/4/2023',
  '150,000'
);



-- Managers table creation
CREATE TABLE IF NOT EXISTS `proj_database`.`managers` (
  `COL 1` varchar(2), 
  `COL 2` varchar(11)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Insert data into Managers Table 
INSERT INTO `proj_database`.`managers` (`COL 1`, `COL 2`) VALUES 
('1', 'CEO'), 
('2', 'Manager'), 
('3', 'MD');


-- Product table creation
CREATE TABLE IF NOT EXISTS `proj_database`.`products` (`COL 1` varchar(4), `COL 2` varchar(12), `COL 3` varchar(13)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Insert data into products Table
CREATE TABLE IF NOT EXISTS `proj_database`.`products` (
  `COL 1` varchar(4),
  `COL 2` varchar(12),
  `COL 3` varchar(13)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;



-- Sales table creation
CREATE TABLE IF NOT EXISTS `proj_database`.`sales` (`COL 1` varchar(5), `COL 2` varchar(10), `COL 3` varchar(9), `COL 4` varchar(9), `COL 5` varchar(16), `COL 6` varchar(16), `COL 7` varchar(15), `COL 8` varchar(10), `COL 9` varchar(7), `COL 10` varchar(7)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Insert data into Sales Table
INSERT INTO `proj_database`.`sales` VALUES ('id', 'first name', 'last name', 'date', 'sales details', '', '', 'qtty sales', 'amount', 'target'),
 ('', '', '', '', 'Product A (@400)', 'Product B (@200)', 'Product C (@50)', '', '', ''),
 ('TC002', 'Kiptanui ', 'Baliaj', '1/10/2023', '200,000', '50,000', '30,000', '1,350', '280,000', '200,000'),
 ('TC008', 'Cynthia ', 'Obuga', '1/10/2023', '50000', '300000', '10000', '475', '360,000', '100,000'),
 ('TC011', 'Lizel ', 'Murigi', '1/10/2023', '30000', '150000', '20000', '1225', '200,000', '100,000'),
 ('TC014', 'Anam ', 'Omoga', '1/10/2023', '50000', '5000', '5000', '250', '60,000', '100,000'),
 ('TC016', 'Mark ', 'Wanderi', '1/10/2023', '10000', '50000', '40000', '1075', '100,000', '100,000'),
 ('TC017', 'Andrew ', 'Kibiwott', '1/10/2023', '40000', '10000', '15000', '450', '65,000', '100,000');
 

 
 
 
