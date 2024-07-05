'use client';

import React, { useState } from 'react';
import axios from 'axios';

const PostRequestExample = () => {
    const [response, setResponse] = useState(null);
    const [error, setError] = useState(null);

    const handlePostRequest = async () => {
        try {
            const result = await axios.post('http://localhost/post_example.php', {
                param1: 'test1',
                param2: 'test2'
            }, { withCredentials: true });

            setResponse(result.data);
        } catch (error) {
            setError(error);
        }
    };

    return (
        <div>
            <h1>POST Request Example</h1>
            <button onClick={handlePostRequest}>Send POST Request</button>
            {error && <div>Error: {error.message}</div>}
            {response && (
                <div>
                    <p>Message: {response.message}</p>
                    <p>Param1: {response.data.param1}</p>
                    <p>Param2: {response.data.param2}</p>
                </div>
            )}
        </div>
    );
};

export default PostRequestExample;
