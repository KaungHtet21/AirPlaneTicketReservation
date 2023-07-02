import React, {useState} from 'react'
import { useNavigate } from 'react-router-dom';
import "./Signup.css"

export default function Signup() {
    const navigate = useNavigate();
    const [title, setTitle] = useState("Mr");
    const [name, setName] = useState("");
    const [surname, setSurname] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [error, setError] = useState(false);
  
    const regex =
      /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  
    const handleSignupOnClick = (e) => {
      e.preventDefault();
      // navigate(`/home`)
      if (
        name.length == 0 ||
        surname.length == 0 ||
        email.length == 0 ||
        password.length == 0 ||
        confirmPassword.length == 0
      ) {
        setError(true);
      } else {
        signUp();
      }
      console.log(name, surname, email, password, confirmPassword);
    };
  
    async function signUp() {
      let item = { title, name, surname, email, password };
      console.log("Item ", item);
      let result = fetch("http://127.0.0.1:8000/api/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(item),
    })
      .then((response) => response.json())
      .then((data) => {
        // Handle the response from the backend
        console.log("Returning data from backend = ", data);
      })
      .catch((error) => {
        // Handle any errors that occurred during the request
        console.error(error);
      });
    console.log("Result ", result);
      const username = surname + " " + name
      navigate(`/home?username=${username}`)
    }
  
    return (
      <div className="signup" style={{paddingTop: "120px"}}>
        <div className="signup_container">
          <h2>Sign up</h2>
  
          {error ? (
            <span style={{ color: "red", fontSize: "14px" }}>
              *All fields are required.
            </span>
          ) : (
            ""
          )}
  
          <div className="signup_title">
            <span>Title</span>
            <select value={title} onChange={(e) => setTitle(e.target.value)}>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
          </div>
  
          <div className="signup_username">
            <div className="signup_name">
              <span>Name</span>
              <input
                type="text"
                placeholder="John"
                value={name}
                onChange={(e) => setName(e.target.value)}
              />
            </div>
  
            <div className="signup_surname">
              <span>Surname</span>
              <input
                type="text"
                placeholder="Wick"
                value={surname}
                onChange={(e) => setSurname(e.target.value)}
              />
            </div>
          </div>
  
          <div className="signup_email">
            <span>Email</span>
            {error && regex.test(email) == false ? (
              <span style={{ color: "red", fontSize: "14px" }}>
                *Email validation error
              </span>
            ) : (
              ""
            )}
            <input
              type="text"
              placeholder="example@gmail.com"
              style={{ width: "60%" }}
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
  
          <div className="signup_password">
            <span>Password</span>
            {error && password.length < 8 ? (
              <span style={{ color: "red", fontSize: "14px" }}>
                *At least 8 characters are required
              </span>
            ) : (
              ""
            )}
            <input
              type="password"
              style={{ width: "60%" }}
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
  
            <span>Confirm Password</span>
            {error && password != confirmPassword ? (
              <span style={{ color: "red", fontSize: "14px" }}>
                *Password not matched
              </span>
            ) : (
              ""
            )}
            <input
              type="password"
              style={{ width: "60%" }}
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
            />
          </div>
  
          <button onClick={handleSignupOnClick}>Sign up</button>
        </div>
      </div>
    );
}
