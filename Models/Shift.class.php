<?php
class Shift{
    private $id;
    private $empId;
    private $date;
    private $hasAttended;
    private $noShowReason;
    private $type;
    private $wfh;


    public function __construct($id, $empId, $date, $hasAttended, $noShowReason, $type, $wfh)
    {
        $this->id = $id;
        $this->empId = $empId;
        $this->date = $date;
        $this->hasAttended = $hasAttended;
        $this->noShowReason = $noShowReason;
        $this->type = $type;
        $this->wfh = $wfh;
    }

    public function GetId(){
        return $this->id;
    }
    public function SetId($id)
    {
        $this->id=$id;
    }
    public function GetEmpId(){
        return $this->empId;
    }
    public function SetEmpId($empId)
    {
        $this->empId=$empId;
    }
    public function GetDate(): DateTime
    {
        return new DateTime($this->date);
    }
    public function SetDate($date)
    {
        $this->date=$date;
    }
    public function GetHasAttended(){
        return $this->hasAttended;
    }
    public function SetHasAttended($hasAttended)
    {
        $this->hasAttended=$hasAttended;
    }
    public function GetNoShowReason(){
        return $this->noShowReason;
    }
    public function SetNoShowReason($noShowReason)
    {
        $this->noShowReason=$noShowReason;
    }
    public function GetType(){
        return $this->type;
    }
    public function SetType($type)
    {
        $this->type=$type;
    }
    public function GetWfh(){
        return $this->wfh;
    }
    public function SetWfh($wfh)
    {
        $this->wfh=$wfh;
    }


}
?>