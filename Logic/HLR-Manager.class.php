<?php include_once '../DataAccess/DbHelper.php'; ?>
<?php
class HLRManager {
    private $requestsEmp = array();
    private $storage;

    public function __construct(){
        $storage = new DbHelper();
        $this->LoadMostRecentRequests();
    }

    public function LoadMostRecentRequests($employeeId){
        $this->requestsEmp = $this->storage->GetAllHolidayRequestsForEmployee($employeeId, 0);
    }

    public function LoadMoreRequests(){

    }
}
?>