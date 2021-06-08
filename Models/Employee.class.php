<?php
class Employee {
    private $id;
        //private static int idCounter = 1;
    //Personal Information
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $gender;

    //Contact details
    private $email;
    private $phoneNumber;
    private $street;
    private $city;
    private $country;
    private $postcode;
    private $bsn;

    //Emergency contact detials
    private $emConName;
    private $emConRelation;
    private $emConEmail;
    private $emConPhoneNum;


    // Job specifications
    private $employmentType;
    private $hourlyWages;
    private $department;

    private $remainingHolidayDays;

    private $shifts = array();

    public function __construct($id, $firstName, $lastName, $dateOfBirth, $gender, $email, $phoneNumber, $street, $city, $country, $postcode, $emConName, $emConRelation, $emConEmail, $emConPhoneNum, $employmentType, $hourlyWages, $department)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->gender = $gender;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
        $this->postcode = $postcode;
        $this->emConName = $emConName;
        $this->emConRelation = $emConRelation;
        $this->emConEmail = $emConEmail;
        $this->emConPhoneNum = $emConPhoneNum;
        $this->employmentType = $employmentType;
        $this->hourlyWages = $hourlyWages;
        $this->department = $department;

    }
    public function GetID()
    {
        return $this->id;
    }


    public function GetFirstName()
    {
        return $this->firstName;
    }
    public function SetFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function GetLastName()
    {
        return $this->lastName;
    }
    public function SetLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function GetDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function SetDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function GetGender()
    {
        return $this->firstName;
    }
    public function SetGender($gender)
    {
        $this->gender = $gender;
    }
    public function GetEmail()
    {
        return $this->email;
    }
    public function SetEmail($email)
    {
        $this->email = $email;
    }

    public function GetPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function SetPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    public function GetStreet()
    {
        return $this->firstName;
    }
    public function SetStreet($street)
    {
        $this->street = $street;
    }

    public function GetCity()
    {
        return $this->city;
    }
    public function SetCity($city)
    {
        $this->city = $city;
    }

    public function GetCountry()
    {
        return $this->country;
    }
    public function SetCounrty($country)
    {
        $this->country = $country;
    }

    public function GetPostCode()
    {
        return $this->postcode;
    }
    public function SetPostCode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function GetEmConName()
    {
        return $this->emConName;
    }
    public function SetEmConName($emConName)
    {
        $this->emConName = $emConName;
    }



    public function GetEmCOnRelation()
    {
        return $this->emConRelation;
    }
    public function SetEmCOnRelation($emConRelation)
    {
        $this->emConRelation = $emConRelation;
    }


    public function GetEmConEmail()
    {
        return $this->emConEmail;
    }
    public function SetEmConEmail($emConEmail)
    {
        $this->emConEmail = $emConEmail;
    }




    public function GetEmConPhone()
    {
        return $this->emConPhoneNum;
    }
    public function SetEmConPhone($emConPhoneNum)
    {
        $this->emConPhoneNum = $emConPhoneNum;
    }



    public function GetEmploymentType()
    {
        return $this->employmentType;
    }
    public function SetEmploymentType($employmentType)
    {
        $this->employmentType = $employmentType;
    }




    public function GetHourlyWages()
    {
        return $this->hourlyWages;
    }
    public function SetHourlyWages($hourlyWages)
    {
        $this->hourlyWages = $hourlyWages;
    }


    public function GetDepartment()
    {
        return $this->department;
    }
    public function SetDepartment($department)
    {
        $this->department = $department;
    }


    public function GetRemainingHolidayDays()
    {
        return $this->remainingHolidayDays;
    }
    public function SetRemainingHolidayDays($remainingHolidayDays)
    {
        $this->remainingHolidayDays = $remainingHolidayDays;
    }
}
?>
