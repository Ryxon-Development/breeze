//LOADED INTO users/index.blade.php

import React, { useEffect } from 'react';
// import ReactDOM from 'react-dom';
import ReactDOM from 'react-dom/client';
import Example from "@/components/Example.jsx";

function Another(props) {

    const [name, setName] = React.useState('John');

    //const message
    const [message, setMessage] = React.useState('Initial message');

    useEffect(() => {
        // console.log('Another component mounted');
        return () => {
            // console.log('Another component unmounted');
        }
    });

    function handleSubmit(e) {
        e.preventDefault();
        console.log(name);

        //post to /test
        fetch('/test', {
            method: 'POST',
        })
            .then(response => {
                if (!response.ok) {
                    // If the response status is not OK (e.g., 404, 500, etc.)
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json(); // Parse the response body as JSON
            })
            .then(data => {
                // Handle success
                // alert(data);
                console.log('Success!');
                console.log(data);
                if (data.message) {
                    setMessage(data.message);
                }
            })
            .catch(error => {
                // Handle error
                console.error('Error!');
                console.error(error);
            });
    }

    function handleChange(e) {
        setName(e.target.value);
    }

    return (
        <div className="container mt-12">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <h1 className='text-4xl'>---REACT integration---</h1>
                        {/*<div className="card-header">Another Component</div>*/}
                        {/*<div className="card-body">I'm another REACT component! I will be placed in any div with #another id</div>*/}
                        {/*<div>{props.title}</div>*/}
                        <hr/>
                        <form onSubmit={handleSubmit} className="m-12">
                            <div className="form-group">
                                <label htmlFor="name">Name</label>
                                <input type="text" name="name" id="name" className="form-control" value={name}
                                       onChange={handleChange}/>
                            </div>
                            <button type="submit"
                                    className="btn btn-primary p-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit
                            </button>
                            <div>
                                {message && (
                                    <div className="alert alert-success" role="alert">
                                        {message}
                                    </div>
                                )}
                            </div>
                        </form>
                        <hr/>
                    </div>

                </div>
            </div>
            <hr/>
            <div>
                <h1>Users</h1>
                <div>
                    <ul>
                        {props.users.map((user) => (
                            <li key={user.id}>{user.name}</li>
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    );
}

export default Another;

const rootElement = document.getElementById('another');

if (rootElement) {
    const props = Object.assign({}, rootElement.dataset);

    props.users = JSON.parse(props.users);

    console.log(props);


    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <React.StrictMode>
        <Another {...props} />
        </React.StrictMode>
    );
}
