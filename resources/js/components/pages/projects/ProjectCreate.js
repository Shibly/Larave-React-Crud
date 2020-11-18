import React, {Component} from 'react';
import {Card, Button, Badge, Spinner, Form} from "react-bootstrap";
import Axios from "axios";
import {Link} from "react-router-dom";
import {PUBLIC_URL} from "../../../constants";
import {storeNewProject} from "../../../services/ProjectService";


class ProjectCreate extends Component {
    state = {
        isLoading: false,
        name: 'Test Project',
        description: 'Test Project Description'
    };

    componentDidMount() {
    }


    changeInput = (e) => {
        this.setState({
            [e.target.name]: e.target.value,
            [e.target.description]: e.target.value

        });
    }


    submitForm = async (e) => {
        e.preventDefault();
        const postBody = {
            name: this.state.name,
            description: this.state.description,
            user_id: 1
        };

        const getSubmitData = await storeNewProject(postBody);
        console.log('getSubmittedData', getSubmitData)
    }


    render() {
        return (
            <div>

                <div className="float-right">
                    <Link to={`${PUBLIC_URL}projects`}>All Projects</Link>
                </div>
                <div className="clearfix"></div>

                <Form onSubmit={this.submitForm}>
                    <Form.Group controlId="formBasicEmail">
                        <Form.Label>Project Name</Form.Label>
                        <Form.Control
                            name="name"
                            type="text"
                            placeholder="Enter Project Name"
                            value={this.state.name}
                            onChange={(e) => this.changeInput(e)}
                        />
                    </Form.Group>
                    <Form.Group controlId="formBasicPassword">
                        <Form.Label>Project Description</Form.Label>
                        <Form.Control name="description" type="text" placeholder="Project Description"
                                      as="textarea" rows="5" value={this.state.description}
                                      onChange={(e) => this.changeInput(e)}
                        />
                    </Form.Group>
                    <Button variant="primary" type="submit">
                        Create Project
                    </Button>
                </Form>
            </div>
        );
    }
}


export default ProjectCreate;
