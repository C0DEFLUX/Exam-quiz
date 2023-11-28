import React, {useState} from 'react';

const Insert = () => {

    const [question, setQuestion] = useState('')
    const [answer1, setAnswer1] = useState('')
    const [answer2, setAnswer2] = useState('')
    const [correctNum, setCorrectNum] = useState('')


    //Change to your URL
    const url = 'http://localhost:8888/exam-quiz/Exam-quiz/insert.php'
    const InsertData = async () => {

        let cleanData = {question, answer1, answer2, correctNum}

        let response = await fetch(url, {

            method: 'POST',
            body: JSON.stringify(cleanData),
            headers: {
                "Content-Type": 'application/json',
                "Accept": 'application/json'
            }

        })
        response = await response.json()

    }

    return (
        <div className="App">
            <h1>Ievietot jautajumu</h1>
            <div className="input-box">
                <input
                    placeholder="Jautājums"
                    type="text"
                    value={question}
                    onChange={(e) => setQuestion(e.target.value)}
                />
                <input
                    placeholder="Atbilde 1"
                    type="text"
                    value={answer1}
                    onChange={(e) => setAnswer1(e.target.value)}
                />
                <input
                    placeholder="Atbilde 2"
                    type="text"
                    value={answer2}
                    onChange={(e) => setAnswer2(e.target.value)}
                />
                <input
                    placeholder="Pareizā atbilde"
                    type="number"
                    max="2"
                    min="1"
                    value={correctNum}
                    onChange={(e) => setCorrectNum(e.target.value)}
                />
                <button onClick={InsertData}>Pievienot</button>
            </div>

        </div>
    );
};

export default Insert;