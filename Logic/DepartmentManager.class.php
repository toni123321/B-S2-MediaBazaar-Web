<?php include_once '../DataAccess/DbHelper.php'; ?>
<?php
class DepartmentManager
{
  private $departments = array();
  private $storage;



  public function __construct()
  {
      $this->storage = new DbHelper();
      $this->LoadFromStorage();
  }

  public function LoadFromStorage()
  {
      $this->departments = $this->storage->GetDepartments();
  }

  public function AddDepartment($department)
  {
    //$this->employees[] = $newEmp;
  }

  public function GetDepartment($id)
  {
    foreach ($this->departments as $department) {
      if($department->GetID() == $id)
      {
        return $department;
      }
    }
    return null;
  }

  public function GetAllDepartments()
  {
    return $this->departments;
  }
}
?>
