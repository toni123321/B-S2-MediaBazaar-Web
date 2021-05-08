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


}
?>