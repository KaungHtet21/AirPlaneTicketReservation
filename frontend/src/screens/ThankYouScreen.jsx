import React, { useEffect, useState } from "react";
import "./ThankYouScreen.css"
import { useLocation, useNavigate } from "react-router-dom";

export default function ThankYouScreen() {

    let location = useLocation();
    const [username, setUsername] = useState("");

    useEffect(() => {
        const searchParams = new URLSearchParams(location.search);
        setUsername(searchParams.get("username"))
    })

    const navigate = useNavigate()
    function handleGoHome() {
        navigate(`/home?username=${username}`)
    }
    return(
        <div className="thankyou_container">
            <button onClick={handleGoHome} className="go_home_btn">GO HOME</button>
        </div>
    )
}