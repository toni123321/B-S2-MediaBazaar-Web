<?php
class HolidayLeaveRequest{
    private $id;
    private $empId;
    private $startDay;
    private $endDay;
    private $totalDays;
    private $status;
    private $reason;
    private $requestDate;

    public function __construct($id, $empId, $startDay, $endDay, $totalDays, $status, $reason, $requestDate){
        $this->id = $id;
        $this->empId = $empId;
        $this->startDay = $startDay;
        $this->endDay = $endDay;
        $this->totalDays = $totalDays;
        $this->status = $status;
        $this->reason = $reason;
        $this->requestDate = $requestDate;
    }

    public function SetId($id){
        $this->id = $id;
    }

    public function GetId(){
        return $this->id;
    }

    public function SetEmpId($id){
        $this->empId = $id;
    }

    public function GetEmpId(){
        return $this->empId;
    }

    public function SetStartDay($date)
    {
        $this->startDay=$date;
    }

    public function GetStartDay(): DateTime
    {
        return new DateTime($this->startDay);
    }

    public function SetEndDay($date)
    {
        $this->endDay=$date;
    }

    public function GetEndDay(): DateTime
    {
        return new DateTime($this->endDay);
    }

    public function SetTotalDays($totalDays){
        $this->totalDays = $totalDays;
    }

    public function GetTotalDays(){
        return $this->totalDays;
    }

    public function SetStatus($status){
        $this->status = $status;
    }

    public function GetStatus(){
        return $this->status;
    }

    public function SetReason($reason){
        $this->reason = $reason;
    }

    public function GetReason(){
        return $this->reason;
    }

    public function SetRequestDate($requestDate){
        $this->requestDate = $requestDate;
    }

    public function GetRequestDate(): DateTime {
        return new DateTime($this->requestDate);
    }

}
?>