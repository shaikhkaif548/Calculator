<?php

include_once "database.php";

class calculation extends database
{

    public function calc($value1, $method, $value2)
    {

        switch ($method)
        {
            case "+":;
                return $value1 + $value2;
                break;
            case "-":;
                return $value1 - $value2;
                break;
            case "*":;
                return $value1 * $value2;
                break;
            case "/":;
                return $value1 / $value2;
                break;
            default:
        }
    }
    
    public function delete($id)
    {
        return $this->deleteData($id);
    }

}
?>
