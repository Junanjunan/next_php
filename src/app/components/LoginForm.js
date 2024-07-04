'use client';

import React, { useState } from 'react';
import axios from 'axios';

const LoginForm = () => {
    const [response, setResponse] = useState(null);
    const [error, setError] = useState(null);

    const handlePostRequest = async () => {
        try {
            const result = await axios.post('http://localhost/login_next.php', {
                mb_id: 'test',
                password: '123'
            }, { withCredentials: true });

            setResponse(result.data);
        } catch (error) {
            setError(error);
        }
    };

    return (
        <div>
            <h1>LOGIN - Request Example</h1>
            <button onClick={handlePostRequest}>Send POST Request</button>
            {error && <div>Error: {error.message}</div>}
            {response && (
                <div>
                    <p>Message: {response}</p>
                </div>
            )}
        </div>
    );
};

export default LoginForm;
