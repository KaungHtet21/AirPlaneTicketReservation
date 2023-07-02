import React, { useState } from "react";
import logo from "../../assets/logo_transparent_white.png";
import "./Navbar.css";
import Profile from "@iconscout/react-unicons/icons/uil-user-circle";
import { useNavigate } from "react-router-dom";

function Navbar(props) {
  const [currency, setCurrency] = useState("USD");
  const { username } = props;
  const navigate = useNavigate();

  function handleProgram() {
    navigate(`/program?username=${username}`);
  }

  function handleHome() {
    navigate(`/home?username=${username}`)
  }

  return (
    <nav className="nav_items_container">
      <div
        style={{ display: "flex", gap: "30px", alignItems: "center" }}
        onClick={handleHome}
      >
        <img style={{ width: "135px", height: "135px" }} src={logo} />
        <span className="nav_heading">AIR HORIZON</span>
      </div>

      <div style={{ display: "flex", gap: "50px", paddingRight: "150px" }}>
        <span
          className="nav_kae_program"
          style={{
            fontSize: "24px",
            color: "white",
            fontStyle: "italic",
            fontWeight: "bold",
            marginTop: "10px",
          }}
          onClick={handleProgram}
        >
          HORIZON Program
        </span>
        {/* <select
          value={currency}
          onChange={e => setCurrency(e.target.value)}
          style={{
            width: "80px",
            padding: "5px",
            fontSize: "16px",
            backgroundColor: "transparent",
            borderWidth: "0 0 1px 0",
            borderColor: "white",
          }}
        >
          <option value="USD">USD</option>
          <option value="MMK">MMK</option>
        </select> */}
        <div className="login_btn">
          <Profile className="login_icon" />
          <button
            style={{
              backgroundColor: "transparent",
              borderWidth: "0 0 0 0",
              color: "white",
            }}
          >
            {username}
          </button>
        </div>
      </div>
    </nav>
  );
}

export default Navbar;
