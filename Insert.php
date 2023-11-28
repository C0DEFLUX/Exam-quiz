<?php

require_once "db/Db.php";

class Insert extends DB
{
    public function insertQuestion()
    {
        $data = [
            'question_err' => '',
            'answer_1_err' => '',
            'answer_2_err' => '',
        ];

        $rawData = file_get_contents("php://input");
        $cleanData = json_decode($rawData);

        $question = $cleanData->question;
        $answer_1 = $cleanData->answer1;
        $answer_2 = $cleanData->answer2;
        $correct_num = $cleanData->correctNum;

        if(empty($question)){
            $data["question_err"] = "Question can't be empty!";
        }

        if(empty($answer_1)){
            $data["answer_1_err"] = "Answer 1 can't be empty!";
        }

        if(empty($answer_2)){
            $data["answer_2_err"] = "Answer 2 can't be empty!";
        }

        if(empty($correct_num)){
            $data["correct_num_err"] = "Correct number can't be empty!";
        }

        if(strlen($question) > 250)
        {
            $data["question_err"] = "Question can't be more than 250 characters!";
        }

        if(strlen($answer_1) > 150)
        {
            $data["answer_1_err"] = "Answer 1 can't be more than 150 characters!";
        }

        if(strlen($answer_2) > 150)
        {
            $data["answer_2_err"] = "Answer 2 can't be more than 150 characters!";
        }

        if(empty($data['question_err']) && empty($data['answer_1_err']) && empty($data['answer_2_err'])) {

        $clean_data = [
            'text' => $question
        ];

        $last_id = $this->insert('questions', $clean_data);

        if($last_id) {

            $correct_1 = 0;
            $correct_2 = 0;

            if($correct_num == 1) {
                $correct_1 = 1;
            }

            if($correct_num == 2) {
                $correct_2 = 1;
            }

            $question_arr = [
                [
                    'text' => $answer_1,
                    'question_id' => $last_id,
                    'is_correct' => $correct_1
                ],
                [
                    'text' => $answer_2,
                    'question_id' => $last_id,
                    'is_correct' => $correct_2
                ]
            ];

            foreach ($question_arr as $quest) {

                $this->insert('answers', $quest);

            }

            return json_encode(
                [
                    'message' => 'Successfully added a new task!',
                    'status' => 200
                ]
            );

        }
    }

    return json_encode($data);
    }
}

$insertTask = new Insert();

echo $result = $insertTask->insertQuestion();