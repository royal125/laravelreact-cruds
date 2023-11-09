import React, { useState } from "react";
import { Link } from "react-router-dom";
import './style.css'
function Nav() {
  const [isNavbarOpen, setNavbarOpen] = useState(false);

  const toggleNavbar = () => {
    setNavbarOpen(!isNavbarOpen);
  };

  const closeNavbar = () => {
    setNavbarOpen(false);
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container">
      <Link className="navbar-brand" to="/">
          <img
            src="https://mdbootstrap.com/img/Photos/new-templates/animal-shelter/logo.png"
            height="70"
            alt=""
            loading="lazy"
          />
        </Link>
        <button
          className={`navbar-toggler ${isNavbarOpen ? "" : "collapsed"}`}
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded={isNavbarOpen ? "true" : "false"}
          aria-label="Toggle navigation"
          onClick={toggleNavbar}
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className={`collapse navbar-collapse ${isNavbarOpen ? "show" : ""}`}>
          <ul className="navbar-nav m-auto">
            <li className="nav-item">
              <Link className="nav-link" to="/" onClick={closeNavbar}>
                Home
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/create" onClick={closeNavbar}>
                Create
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/update/:id" onClick={closeNavbar}>
                Update
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Nav;
