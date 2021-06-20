
<?php include_once '../Models/Department.class.php'; ?>
<?php include_once '../Models/Shift.class.php'; ?>
<?php include_once '../Models/HolidayLeaveRequest.class.php';?>
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

    public function GetUsersExpiringContract($id, $email, $depName){
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT count(*)
                    from employee as e
                    inner join department as d
                    on d.ID = e.DepartmentID 
                    where EndDate < CURDATE() and e.ID = ? and e.Email = ? and d.Name = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id, $email, $depName]);

            $result = $stmt->fetchColumn();


            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        if($result == 0){
            return false;
        }
        else{
            return true;
        }
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
                    on d.ID = e.DepartmentID 
                    where EndDate >= CURDATE() or EndDate is NULL";


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

                //Emergency contact detials
                $emConName = $row['EmergencyContactName'];
                $emConRelation = $row['EmergencyContactRelation'];
                $emConEmail = $row['EmergencyContactEmail'];
                $emConPhoneNum = $row['EmergencyContactPhone'];


                // Job specifications
                $employmentType = $row['EmploymentType'];
                $hourlyWages = $row['HourlyWages'];
                $departmentID = $row['DepartmentID'];

                $depName = $row['DepName'];

                $department = new Department($departmentID, $depName);

                $employee = new Employee($id, $firstName, $lastName, $dateOfBirth, $gender, $email,
                $phoneNumber, $street, $city, $country, $postcode, $emConName, $emConRelation,
                $emConEmail, $emConPhoneNum, $employmentType, $hourlyWages, $department);

                $employees[] = $employee;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $employees;
    }

    public function UpdateUser($emp)
    {
      try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE employee
                    SET Email = ?,
                    PhoneNumber = ?,
                    Street = ?,
                    City = ?,
                    Country = ?,
                    PostCode = ?,
                    EmergencyContactName = ?,
                    EmergencyContactRelation = ?,
                    EmergencyContactEmail = ?,
                    EmergencyContactPhone = ?
                    WHERE ID = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$emp->GetEmail(), $emp->GetPhoneNumber(), $emp->GetStreet(), $emp->GetCity(), $emp->GetCountry(), $emp->GetPostCode(), $emp->GetEmConName(), $emp->GetEmConRelation(), $emp->GetEmConEmail(), $emp->GetEmConPhone(), $emp->GetID()]);

            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function IsAccountEditRequestSent($id)
    {
        $isRequestSent = false;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT count(*) FROM pending_changed_details 
                    WHERE ID=? and Status=?";

            $stmt = $this->conn->prepare($sql);
            $status = "InProgress";
            $stmt->execute([$id, $status]);
            $result = $stmt->fetchColumn();


            if($result == 1)
            {
                $isRequestSent = true;
            }

            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $isRequestSent;
    }

    public function SendAccountEditRequest($emp, DateTime $requestDate)
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO 
                    pending_changed_details
                    (ID, Email, PhoneNumber, Street, City, Country, PostCode, 
                     EmergencyContactName, EmergencyContactRelation, EmergencyContactEmail, 
                     EmergencyContactPhone, Status, RequestDate) 
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $defaultStatus = "InProgress";
            $stmt->execute([$emp->GetId(), $emp->GetEmail(), $emp->GetPhoneNumber(), $emp->GetStreet(), $emp->GetCity(), $emp->GetCountry(), $emp->GetPostCode(), $emp->GetEmConName(), $emp->GetEmConRelation(), $emp->GetEmConEmail(), $emp->GetEmConPhone(), $defaultStatus, $requestDate->format('Y-m-d H:i:s')]);

            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function UpdateAccountEditRequest($emp, $newRequestDate)
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE pending_changed_details 
                    SET Email = ?,
                    PhoneNumber = ?,
                    Street = ?,
                    City = ?,
                    Country = ?,
                    PostCode = ?,
                    EmergencyContactName = ?,
                    EmergencyContactRelation = ?,
                    EmergencyContactEmail = ?, 
                    EmergencyContactPhone = ?, 
                    RequestDate = ?
                    WHERE ID = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$emp->GetEmail(), $emp->GetPhoneNumber(), $emp->GetStreet(), $emp->GetCity(), $emp->GetCountry(), $emp->GetPostCode(), $emp->GetEmConName(), $emp->GetEmConRelation(), $emp->GetEmConEmail(), $emp->GetEmConPhone(), $newRequestDate->format('Y-m-d H:i:s'), $emp->GetID()]);

            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
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

    public function GetShifts(){
        $shifts = array();

        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT ID, EmployeeID, Date, HasAttended, NoShowReason, Type, wfh
                    from shift";

            $result = $this->conn->query($sql);


            foreach ($result as $row)
            {

                $id = $row['ID'];
                $empId = $row['EmployeeID'];
                $date = $row['Date'];
                $hasAttended = $row['HasAttended'];
                $noShowReason = $row['NoShowReason'];
                $type = $row['Type'];
                $wfh = $row['wfh'];

                $shift = new Shift($id, $empId, $date, $hasAttended, $noShowReason, $type, $wfh);
                $shifts[] = $shift;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $shifts;
    }

    public function GetAllHolidayRequestsForEmployee($employeeId, $startingIndex){
        $hlrs = array();

        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM holiday_leave_request Where EmployeeID = :employeeId LIMIT :startIndex,5";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':employeeId', (int) $employeeId, PDO::PARAM_INT);
            $stmt->bindValue(':startIndex', (int) $startingIndex, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll();

            foreach ($result as $row)
            {

                $id = $row['ID'];
                $empId = $row['EmployeeID'];
                $startDay = $row['StartDay'];
                $endDay = $row['EndDay'];
                $totalDays = $row['TotalDays'];
                $status = $row['Status'];
                $reason = $row['Comments'];
                $requestDate = $row['RequestDate'];

                $hlr = new HolidayLeaveRequest($id, $empId, $startDay, $endDay, $totalDays, $status, $reason, $requestDate);
                $hlrs[] = $hlr;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $hlrs;
    }

    public function GetRemainingHolidayDays($id){
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(RemainingHolidayDays) FROM remaining_holiday_days WHERE EmployeeID = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchColumn();

            if($result == null)
            {
                $result = 0;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function GetUsedHolidayDays($id){
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT SUM(TotalDays) FROM holiday_leave_request WHERE EmployeeID = ? AND Status = 'Accepted'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchColumn();
            if($result == null)
            {
                $result = 0;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function GetPendingHolidayDays($id){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT SUM(TotalDays) FROM holiday_leave_request WHERE EmployeeID = ? AND Status = 'InProgress'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchColumn();

            if($result == null)
            {
                $result = 0;
            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function GetNumberHLRsPerEmp($id){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT COUNT(*) FROM holiday_leave_request WHERE EmployeeID = ? AND Status = 'InProgress'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchColumn();

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function InsertHLR($id, $startDate, $endDate, $totalDays, $comment, $requestDT){
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO holiday_leave_request(EmployeeID, StartDay, EndDay, TotalDays, Status, Comments, RequestDate) 
                    VALUES(?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id, $startDate, $endDate, $totalDays, 3, $comment, $requestDT]);
            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function CheckInShift($shiftID){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE 	shift 
                    SET HasAttended = 1
                    WHERE ID = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$shiftID]);

            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}
?>
