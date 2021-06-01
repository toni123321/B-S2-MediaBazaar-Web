<?php include '../Models/Employee.php'; ?>

<?php
class Department
{
    //Fields
    private $id;
    private $name;
    private $manager;

    //Properties
    public function GetID()
    {
        return $this->id;
    }
    public function SetID($id)
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


    public function __construct($id, $name, $manager)
    {
        $this->id = $id;
        $this->name = $name;
        $this->manager=$manager;
    }


}
?>
