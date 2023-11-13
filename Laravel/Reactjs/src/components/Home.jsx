import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import Loader from './Loader';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

function Home() {
  const [loading, setLoading] = useState(true);
  const [users, setUsers] = useState([]);

  const getUsers = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/home');
      setUsers(response.data);
    } catch (error) {
      console.error("Error fetching users:", error);
    } finally {
      setLoading(false);
    }
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(`http://127.0.0.1:8000/api/cruds/${id}`);
      toast.success(`User Deleted Successfully! ID: ${id}`);
      getUsers();
    } catch (error) {
      console.error("Error deleting user:", error);
    }
  }

  useEffect(() => {
    getUsers();
  }, []);

  return (
    <div>
      <div className='pb'>
        <div className="table-responsive">
          <table className="table table-striped
            table-hover	
            table-borderless
            table-primary
            align-middle  m-auto">
            <thead className="table-light">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody className="table-group-divider">
              {loading ? <Loader /> : users.map((userData) => (
                <tr className="table-light" key={userData.id}>
                  <td scope="row">{userData.id}</td>
                  <td>{userData.name}</td>
                  <td>{userData.course}</td>
                  <td>{userData.email}</td>
                  <td>
                    <Link to={`/update/${userData.id}/`}>
                      <button type="button" className="btn btn-primary">
                        Edit
                      </button>
                    </Link>
                    &nbsp;
                    <button
                      type="button"
                      className="btn btn-danger"
                      onClick={() => handleDelete(userData.id)}
                    >
                      Remove
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
            <tfoot></tfoot>
          </table>
        </div>
      </div>
      <ToastContainer
        position="top-right"
        autoClose={3000}
      />
    </div>
  );
}

export default Home;
