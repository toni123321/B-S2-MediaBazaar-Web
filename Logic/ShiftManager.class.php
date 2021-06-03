<?php
include_once '../DataAccess/DbHelper.php';

class ShiftManager{
    private $shifts = array();
    private $storage;

    public function __construct()
    {
        $this->storage = new DbHelper();
        $this->LoadFromStorage();
    }

    public function LoadFromStorage()
    {
        $this->shifts = $this->storage->GetShifts();
    }

    public function GetShift($shiftId)
    {
        foreach ($this->shifts as $shift) {
            if($shift->GetId() == $shiftId)
            {
                return $shift;
            }
        }
        return null;
    }

    public function GetAllShifts()
    {
        return $this->shifts;
    }

    public function GetAllShiftsEmp($empId)
    {
        $employeeShifts = array();
        foreach ($this->shifts as $shift){
            if($shift->GetEmpId() == $empId)
            {
                $employeeShifts[] = $shift;
            }
        }
        return $employeeShifts;
    }
}
?>