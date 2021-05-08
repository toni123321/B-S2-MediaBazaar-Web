
<?php include '../Models/Department.php'; ?>

<?php

class DbHelper {
    private $conn;

    private $host;
    private $dbName;
    private $username;
    private $password;

    public function __construct($host="studmysql01.fhict.local", $dbName="dbi453373", $username="dbi453373", $password="12345")
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }

    public function GetUsers()
    {
        $employees = array();
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT e.*, d.Name as'DepName'
                    from employee as e
                    inner join department as d
                    on d.ID = e.DepartmentID";


            $result = $this->conn->query($sql);


            foreach ($result as $row)
            {
                $id = $row['ID'];
                $firstName = $row['FirstName'];
                $lastName = $row['LastName'];
                $dateOfBirth = $row['DateOfBirth'];
                $gender = $row['Gender'];

                //Contact details
                $email = $row['Email'];
                $phoneNumber = $row['PhoneNumber'];
                $street = $row['Street'];
                $city = $row['City'];
                $country = $row['Country'];
                $postcode = $row['PostCode'];
                $bsn = $row['BSN'];

                //Emergency contact detials
                $emConName = $row['EmergencyContactName'];
                $emConRelation = $row['EmergencyContactRelation'];
                $emConEmail = $row['EmergencyContactEmail'];
                $emConPhoneNum = $row['EmergencyContactPhone'];


                // Job specifications
                $employmentType = $row['EmploymentType'];
                $hourlyWages = $row['HourlyWages'];
                $departmentID = $row['DepartmentID'];

                $remainingHolidayDays = $row['RemainingHolidayDays'];
                $depName = $row['DepName'];

                $department = new Department($departmentID, $depName);

                $employee = new Employee($id, $firstName, $lastName, $dateOfBirth, $gender, $email,
                $phoneNumber, $street, $city, $country, $postcode, $bsn, $emConName, $emConRelation,
                $emConEmail, $emConPhoneNum, $employmentType, $hourlyWages, $department, $remainingHolidayDays);

                $employees[] = $employee;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $employees;
    }

    public function GetDepartments()
    {
        $departments = array();
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT ID, Name
                    from department";


            $result = $this->conn->query($sql);


            foreach ($result as $row)
            {

                $id = $row['ID'];
                $name = $row['Name'];

                $department = new Department($id, $name);
                $departments[] = $department;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $departments;
    }



}
?>
