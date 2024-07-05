'use client';

import React, { useState } from 'react';
import axios from 'axios';

const LoginForm = () => {
    const [response, setResponse] = useState(null);
    const [error, setError] = useState(null);
    const [mbId, setMbId] = useState('');
    const [password, setPassword] = useState('');

    const handlePostRequest = async () => {
        try {
            const result = await axios.post('http://localhost/login_next.php', {
                mb_id: mbId,
                password: password
            }, { withCredentials: true });

            setResponse(result.data);
        } catch (error) {
            setError(error);
        }
    };

    return (
        <div>
            <h1>LOGIN - Request Example</h1>
            <form>
                <div>
                    <label>
                        Username: <input type="text" name="mb_id" value={mbId} onChange={(e) => setMbId(e.target.value)} />
                    </label>
                </div>
                <div>
                    <label>
                        Password: <input type="password" name="password" value={password} onChange={(e) => setPassword(e.target.value)} />
                    </label>
                </div>
            </form>
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
