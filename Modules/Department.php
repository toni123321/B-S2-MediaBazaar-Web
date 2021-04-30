<?php
class Department
{
    //Fields
    private $id;
    private $deptId;
    private $name;
    private $manager;
    private $employees = array();

    //Properties
    public function GetId()
    {
        return $this->id;
    }
    public function SetId($id)
    {
        $this->id = $id;
    }
    public function SetName($name)
    {
        $this->name = $name;
    }
    public function GetName()
    {
        return $this->name;
    }

    public function SetManager($manager)
    {
        $this->manager = $manager;
    }

    public function GetManager()
    {
        return $this->manager;
    }


    public function __construct($id, $name, $manager=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->manager = $manager;
    }

    public function GetEmployeeById($id)
    {
        foreach ($this->employees as $emp)        {
            if ($emp->GetId() == $id)
            {
                return emp;
            }
        }
        return null;
    }

    public function GetEmployeeByEmail($email)
    {
        foreach ($this->employees as $emp)        {
            if ($emp->GetEmail() == $email)
            {
                return emp;
            }
        }
        return null;
    }

    public function isEmpExist($email, $departmentManagement)
    {
        foreach ($departmentManagement->GetAllEmployees() as $emp)
        {
            if($emp->GetEmail  == $email)
            {
                return true;
            }
        }
        return false;
    }


//    public function AddEmployee(DepartmentManagement $departmentManagement, $firstName, $lastName, $dateOfBirth, $gender, $email,
//                                $phoneNumber, $street, $city, $country, $postcode, $bsn,
//                                $emConName, $emConRelation, $emConEmail, $emConPhoneNum,
//                                EmploymentType employmentType, double hourlyWages, Department department)
//    {
//
//
//    }
//    public bool AddEmployee(DepartmentManagement departmentManagement, string firstName, string lastName, DateTime dateOfBirth, Gender gender, string email,
//    string phoneNumber, string street, string city, string country, string postcode, string bsn,
//    string emConName, EmergencyContactRelation emConRelation, string emConEmail, string emConPhoneNum,
//    EmploymentType employmentType, double hourlyWages, Department department)
//    {
//
//    if (!isEmpExist(email, departmentManagement))
//    {
//    Employee newEmp = new Employee(firstName, lastName, dateOfBirth, gender, email, phoneNumber,
//    street, city, country, postcode, bsn, emConName, emConRelation, emConEmail, emConPhoneNum,
//    employmentType, hourlyWages, department);
//    employees.Add(newEmp);
//    return true;
//    }
//    return false;
//    }
//


    public function RemoveEmployee($email)
    {
        $currEmp = GetEmployeeByEmail($email);
        if ($currEmp != null)
        {
            $this->employees.remove($currEmp);
            return true;
        }
        return false;
    }

    public function GetAllEmployees()
    {
        return $this->employees;
    }

}
?>