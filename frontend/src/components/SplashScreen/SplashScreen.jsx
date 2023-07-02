import React, {useEffect} from "react";
import './SplashScreen.css'
import logo from "../../assets/logo_transparent_white.png"

export default function SplashSceen() {
  useEffect(() => {
    const wordSpans = document.querySelectorAll(".splash-screen h1 span");

    wordSpans.forEach((span, index) => {
      span.style.animationDelay = `${index * 0.5}s`;
      span.classList.add("pop-up");
    });
  }, []);
  
  return (
    <div className="splash-screen">
      <h1>
        <img src={logo} alt="" />
        <span>WELCOME</span>
        <span>TO</span>
        <span>AIR</span>
        <span>HORIZON</span>
      </h1>
    </div>
  );
}
