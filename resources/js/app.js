import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';

export default class App extends Component {
    constructor(props) {
        super(props);

        this.state = {
            onStatus: false
        }
    }
    render() {
        return (
            <div class="flex-center position-ref full-height">
                <div class="top-right links">
                    {this.state.onStatus !== false ? (
                        <a href="{{ url('/home') }}">Home</a>
                    ) : (
                            <Fragment>
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            </Fragment>
                        )}


                </div>

                <div class="content">
                    <h1>Laravel & React</h1>
                </div>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
