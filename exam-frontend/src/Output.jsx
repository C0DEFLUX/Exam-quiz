import React, {useEffect, useState} from 'react';

const Output = () => {
    const [data, setData] = useState('')

    const fetchData = () => {
        fetch('http://localhost:8888/exam-quiz/Exam-quiz/select.php')
            .then((response) => response.json())
            .then((data) => {
                setData(data)
                console.log(data)

            })
            .catch((error) => {
                    console.log('Error fetching data:', error)
                }
            )
    }

    useEffect(() => {
        fetchData()
    }, [])

    return (
        <div>
            {/*{data.map((item) => (*/}
            {/*))}*/}
        </div>
    );
};

export default Output;