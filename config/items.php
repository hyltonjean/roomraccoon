<?php
class Items extends Database
{

    //Function to insert data
    public function executeQuery($sql)
    {
        $res = $this->connect()->query($sql);
        if ($res)
            return true;
        else
            return false;
    }

    // Function to get all items
    public function getAllItems()
    {
        $sql = "select * from shoppinglists order by id desc";
        $result = $this->connect()->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Function to get all items
    public function getItem($id)
    {
        $sql = "select * from shoppinglists where id = " . $id;
        $result = $this->connect()->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }
}
