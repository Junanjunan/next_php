'use client';

import React, { useEffect, useState } from 'react';
import axios from 'axios';

const GetRequestExample = () => {
    const [response, setResponse] = useState(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const result = await axios.get('http://localhost/get_example.php', {
                    params: {
                        param1: 'test1',
                        param2: 'test2'
                    },
                    withCredentials: true
                });
                setResponse(result.data);
            } catch (error) {
                setError(error);
            }
        };

        fetchData();
    }, []);

    if (error) {
        return <div>Error: {error.message}</div>;
    }

    if (!response) {
        return <div>Loading...</div>;
    }

    console.log(response);

    return (
        <div>
            <h1>GET Request Example</h1>
            <p>Message: {response.message}</p>
            <p>Param1: {response.data.param1}</p>
            <p>Param2: {response.data.param2}</p>
        </div>
    );
};

export default GetRequestExample;
