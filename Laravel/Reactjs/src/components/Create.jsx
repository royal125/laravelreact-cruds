import React, { useState } from "react";
import axios from "axios";
import './create.css'
import $ from 'jquery'
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import Loader from './Loader';
function Create({data}) {
  const [user, setUser] = useState ({
    name: "",
    course: "",
    email: "",
  });
  const [responseData, setResponseData] = useState();
  const [loading, setLoading] = useState(true);


  const handleChange = (e) => {
   setUser({
    ...user,
    [e.target.name] : e.target.value
   })
  }

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post("http://127.0.0.1:8000/api/store", user, {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
      });

      console.log("Response:", response); // Debug: Log the response

      if (response.status === 200) {
        const data = response.data;
        
        setResponseData(data);
        console.log("User Created Successfully!");
       toast.success("User Created Successfully!");
      } else if (response.status === 500 && response.data.message.includes("User Already Exists")) {
        console.log("User Already Exists!");
        alert("User Already Exists!");
      } else {
        console.log("Error creating user");
        alert("Error creating user");
      }
    } catch (error) {
      console.error("Error:", error);
      toast("An error occurred while creating the user.");
    }
  
  
  
  }

  setTimeout(() => {
    setLoading(false);
  }, 2000)

  return (
    <div>
      <div class="container frm">
        {loading ? <Loader/> : 
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="well">
				<form method="post" onSubmit={handleSubmit}>
					<h2>User Form</h2>
					
					<div class="form-group">
						<label for="text"> Name</label>
						<input type="text" id="name" value={user.name}  placeholder="Enter your name" 
							name="name" onChange={handleChange} class="form-control"  />
					</div>
					
					<div class="form-group">
						<label for="text">Course</label>
						<input type="text" id="course" value={user.course}  placeholder="Enter your course" 
							name="course" onChange={handleChange}  class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" id="email" value={user.email}  placeholder="Enter your email" 
							 name="email" onChange={handleChange}  class="form-control" />
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
					
				</form>
			</div>
		</div>
	</div>
}
</div>
      {responseData && (
        <div>
          <p className=""></p>
          <ToastContainer
          autoClose={3000}
          />
        </div>
      )}
    </div>
  );
}

export default Create;
