import React, { useEffect, useState } from "react";
import Navbar from "../components/navbar/Navbar";
import Advertise from "../components/advertise/Advertise";
import FlightOrder from "../components/flightorder/FlightOrder";
import RecommendTrips from "../components/recommendtrips/RecommendTrips";
import AcceptedPayment from "../components/aceptedPayment/AcceptedPayment";
import Footer from "../components/footer/Footer";
import SplashScreen from "../components/SplashScreen/SplashScreen";
import { useLocation } from "react-router-dom";

function HomeScreen() {
  const [isLoading, setIsLoading] = useState(true);
  
  useEffect(() => {
    // Simulate an asynchronous operation (e.g., fetching data) that takes some time
    setTimeout(() => {
      setIsLoading(false);
    }, 3200); // Set the duration of your splash screen here
  }, []);

  let location = useLocation();
  const [username, setUsername] = useState("")

  useEffect(() => {
    const searchParams = new URLSearchParams(location.search)
    setUsername(searchParams.get("username"))
  })

  return (
    <div>
      {isLoading ? <SplashScreen/> :  
      <div style={{ width: "100%" }}>
        <Navbar username={username} />
        <div style={{ display: "flex", marginTop: "120px" }}>
          <Advertise />
          <FlightOrder username={username} />
        </div>
        <RecommendTrips />
        <hr style={{ marginLeft: "20px", marginRight: "20px" }} />
        <AcceptedPayment />
        <Footer />
      </div>}
    </div>
  );
}

export default HomeScreen;
