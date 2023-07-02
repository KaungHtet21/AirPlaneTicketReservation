import React from "react";
import google_play from "../../assets/google_play.svg";
import play_store from "../../assets/app_store.svg";
import Facebook from "@iconscout/react-unicons/icons/uil-facebook";
import Twitter from "@iconscout/react-unicons/icons/uil-twitter";
import Instagram from "@iconscout/react-unicons/icons/uil-instagram";
import LinkedIn from "@iconscout/react-unicons/icons/uil-linkedin";
import Youtube from "@iconscout/react-unicons/icons/uil-youtube";
import "./Footer.css";

export default function Footer() {
  return (
    <div style={{ padding: "30px", display: "flex", flexDirection: "column" }}>
      <hr style={{width: "100%"}} />
      <div style={{ display: "flex", justifyContent: "space-between" }}>
        <div style={{ display: "flex", flexDirection: "column" }}>
          <h2>Check our mobile apps</h2>
          <div style={{ display: "flex", gap: "15px" }}>
            <img
              style={{ width: "120px", height: "35px" }}
              src={google_play}
              alt=""
            />
            <img
              style={{ width: "120px", height: "35px" }}
              src={play_store}
              alt=""
            />
          </div>
        </div>
        <div style={{ display: "flex", flexDirection: "column" }}>
          <h2>Contact us with</h2>
          <div style={{ display: "flex", gap: "10px" }}>
            <Facebook className="footer_social_icon" />
            <Twitter className="footer_social_icon" />
            <Instagram className="footer_social_icon" />
            <LinkedIn className="footer_social_icon" />
            <Youtube className="footer_social_icon" />
          </div>
        </div>
      </div>
      <hr style={{width: "100%", marginTop: "30px"}}/>
      <div style={{display: "flex", gap: "100px"}}>
        <div style={{display: "flex", flexDirection: "column"}}>
            <h3 style={{ marginBottom: "15px"}}>Air KAE Experience</h3>
            <ul style={{listStyle: "none", fontSize: "18px"}}>
                <li>Home</li>
                <li>About us</li>
                <li>Promo</li>
                <li>Charter Services</li>
                <li>Offices</li>
            </ul>
        </div>
        <div style={{display: "flex", flexDirection: "column"}}>
            <h3 style={{marginBottom: "15px"}}>Plan Your Journey</h3>
            <ul style={{listStyle: "none", fontSize: "18px"}}>
                <li>FLight Schedules</li>
                <li>Terms and Conditions</li>
                <li>Travel Policy</li>
                <li>Excess Baggage Rate</li>
            </ul>
        </div>
      </div>
    </div>
  );
}
