<?php
require_once "db/Db.php";

class Select extends DB
{
    public function selectData()
    {

        $sql = 'SELECT * FROM questions';
        $result = $this->select($sql);

        $final_arr = [];
        $clean_data = [];
        $arr = [];

        foreach ($result as $res) {
            $sql = 'SELECT * FROM answers WHERE question_id = ' . $res['id'];
            $answers = $this->select($sql);

            array_push($clean_data, $res);
            array_push($clean_data, $answers);

        }
        return json_encode($final_arr);
    }
}


$index = new Select();
echo $response = $index->selectData();