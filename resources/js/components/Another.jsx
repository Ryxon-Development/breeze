import React, { useEffect } from 'react';
// import ReactDOM from 'react-dom';
import ReactDOM from 'react-dom/client';
import Example from "@/components/Example.jsx";

function Another(props) {

    useEffect(() => {
        console.log('Another component mounted');
        return () => {
            console.log('Another component unmounted');
        }
    });

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Another Component</div>
                        <div className="card-body">I'm another REACT component! I will be placed in any div with #another id</div>
                        <div>{props.title}</div>
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
