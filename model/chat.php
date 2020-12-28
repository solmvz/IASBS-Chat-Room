<?php
require_once "database.php";

class chat
{
    public $id;
    public $from;
    public $to;
    public $text;
    public $date;

    public function getID() { return $this->id; }
    public function setID($val) { $this->id = $val; }

    public function getSendFrom() { return $this->from; } 
    public function setSendFrom($val) { $this->from = $val; }

    public function getSendTo() { return $this->to; }
    public function setSendTo($val) { $this->to = $val; } 

    public function getText() { return $this->text; }
    public function setText($val) { $this->text = $val; }

    public function getDate() { return $this->date; }
    public function setDate($val) { $this->date = $val; } 

   function SendMsg()
    {
        $paramTypes = "ssss";
        $Parameters = array( $this->from, $this->to,
        $this->text, $this->date);
        $result = database::ExecuteQuery('AddMsg', $paramTypes, $Parameters);
        $row = $result->fetch_array();
        $this->setID($row["LAST_INSERT_ID()"]);
        return true;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    public static function LoadChatHistory($from, $to)
    {
        $paramTypes = "ss";
        $Parameters = array($from, $to);
        $result = database::ExecuteQuery('ChatHistory', $paramTypes, $Parameters);
        $chathistory = array();
        $i = 0;
        while ($row = $result->fetch_array())
        {
            $tempchat = new chat();
            $tempchat->setID($row['id']);
            $tempchat->setSendFrom($row['mfrom']);
            $tempchat->setText($row['text']);
            $tempchat->setDate($row['sent']);

            $chathistory[$i++] = $tempchat->jsonSerialize();
        }
        return $chathistory;
    }

    public static function DeleteMsg($id)
    {
        $paramTypes = "s";
        $Parameters = array($id);
        database::ExecuteQuery('DeleteMsg', $paramTypes, $Parameters);
    }

    public static function EditMsg($id, $newtext)
    {
        $paramTypes = "ss";
        $Parameters = array($id, $newtext);
        database::ExecuteQuery('EditMsg', $paramTypes, $Parameters);
    }
}
?>