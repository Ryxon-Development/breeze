import React from 'react';
import ReactDOM from 'react-dom/client';

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example REACT component! i will be placed in any div with #example id</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}

//Using CSS classes instead of ID
const elements = document.getElementsByClassName("example");
for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    const Index = ReactDOM.createRoot(element);

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}

