import React, { useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useState } from "react";
import "./Login.css";
import paper_plane from "../../assets/paper_plane.gif";
import logo from "../../assets/logo_transparent_blue.png";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState(false);
  const [validateError, setValidateError] = useState(false);
  const navigate = useNavigate();

  // Get users from backend
  const [users, setUsers] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getUsers")
      .then((response) => response.json())
      .then((data) => setUsers(data));
  }, []);

  const handleLoginOnClick = (e) => {
    e.preventDefault();
    if (email.length == 0 || password.length == 0) {
      setError(true);
    } else {
      setError(false);
      const isUser = users.find(
        (user) => user.email == email && user.password == password
      );

      if (!isUser) {
        setValidateError(true);
      } else {
        setValidateError(false);
        const username = isUser.surname + " " + isUser.name;
        navigate(`/home?username=${username}`);
      }
    }
  };

  return (
    <div className="login" style={{ paddingTop: "100px" }}>
      <div className="login_container">
        <img className="login_image" src={paper_plane} alt="" />
        <form className="auth_info_wrapper" onSubmit={handleLoginOnClick}>
          <div
            style={{
              display: "flex",
              alignItems: "center",
              width: "100%",
              gap: "20px",
            }}
          >
            <img
              src={logo}
              alt=""
              style={{ width: "95px", height: "95px", marginLeft: "20px" }}
            />
            <h2 style={{ marginLeft: "30px" }}>Login</h2>
          </div>
          {error && (
            <span style={{ color: "red" }}>*We need all information</span>
          )}
          {validateError && (
            <span style={{ color: "red" }}>
              *Email or password is wrong. Please check again.
            </span>
          )}
          <div className="auth_input_field">
            <span>Email</span>
            <input
              style={{ color: "black" }}
              type="text"
              className="input"
              value={email}
              placeholder="Enter your email address"
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div className="auth_input_field">
            <span>Password</span>
            <input
              style={{ color: "black" }}
              type="password"
              className="input"
              placeholder="Enter your password"
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>
          <button type="submit">Login</button>
          <div style={{ fontSize: "12px", marginTop: "10px" }}>
            <Link style={{ textDecoration: "none" }} to="/signup">
              <span>Sign up</span>
            </Link>
            <span> | </span>
            <span style={{ color: "#065a9e" }}>Forgot Password</span>
          </div>
        </form>
      </div>
    </div>
  );
}
