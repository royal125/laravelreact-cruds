import React, { useState, useEffect } from "react";
import axios from "axios";
import './create.css';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import Loader from './Loader';
import { useParams, useNavigate } from "react-router-dom";

function Update() {
  const [inputs, setInputs] = useState([]);
  const [loading, setLoading] = useState(true);
 
  const navigate = useNavigate();
  const { id } = useParams();
  const handleChange = (e) => {
    setInputs({
      ...inputs,
      [e.target.name]: e.target.value
    });
  }
const handleSubmit = async (e) => {
  e.preventDefault();

  const data = {
    name: inputs.name,
    course: inputs.course,
    email: inputs.email,
   
  }
  try {
    const response = await axios.put(`https://benstud.sa.com/api/project/upgrade/${id}`, data);
    console.log(response);

    if (response.data.success === 200) {
      console.log(response.data.success);
      
                setInputs(response.data.data)
    } else {
      
      toast.success("User updated successfully.");
      setTimeout(() => {
        navigate('/');
      }, 3500);
    }
  } catch (error) {
    console.error("An error occurred while updating the user:", error);
    toast.error("An error occurred while updating the user.");
  }
};
  useEffect(() => {
    GetCrud();
  }, []);

  const GetCrud = async () => {
    const response = await axios.get(`https://benstud.sa.com/api/project/find/${id}`);
    setInputs(response.data);
  };

  setTimeout(() => {
    setLoading(false);
  }, 2000);

  return (
    <div>
      <div className="container frm">
        {loading ? <Loader /> :
          <div className="row">
            <div className="col-xs-6 col-xs-offset-3">
              <div className="well">
                <form onSubmit={handleSubmit}>
                  <h2>User Form</h2>

                  <div className="form-group">
                    <label htmlFor="text"> Name</label>
                    <input onChange={handleChange} type="text" id="name" placeholder="Enter your name"
                      value={inputs.name} name="name" className="form-control" />
                  </div>

                  <div className="form-group">
                    <label htmlFor="text">Course</label>
                    <input onChange={handleChange} type="text" id="course" placeholder="Enter Course"
                      value={inputs.course} name="course" className="form-control" />
                  </div>

                  <div className="form-group">
                    <label htmlFor="email">Email</label>
                    <input onChange={handleChange}  value={inputs.email} name="email" placeholder="Enter your email"
                      className="form-control" /> 
                  </div>

                  <button type="submit" className="btn btn-default">Submit</button>

                </form>
              </div>
            </div>
          </div>
        }
      </div>

      <div>
        <p className=""></p>
        <ToastContainer
          autoClose={3000}
        />
      </div>

    </div>
  );
}

export default Update;
