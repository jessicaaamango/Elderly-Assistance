import React from 'react'
import 'bootstrap/dsit/css/bootstrap.min.css';

function Login() {
    return (
        <div>
            <div>
                <form action="">
                    <div>
                        <label htmlFor="email">Email</label>
                        <input type="email" placeholder="Enter Email"></input>
                    </div>
                    <div>
                        <label htmlFor="password">Password</label>
                        <input type="password" placeholder="Enter Password"></input>
                    </div>
                    <button>Login</button>
                </form>
            </div>
        </div>
    )
}

export default Login