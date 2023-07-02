import React, { useContext, useEffect, useState } from "react";
import RechooseTrip from "../components/rechoosingtrip/RechooseTrip";
import { useLocation } from "react-router-dom";
import HashLoader from "react-spinners/HashLoader";
import DisplayFlights from "../components/displayingflights/DisplayFlights";
import Navbar from "../components/navbar/Navbar";
import { PassengerContext } from "../components/displayingflights/PassengerContext";

export default function TicketSelectingScreen() {
  const {open} = useContext(PassengerContext)

  let location = useLocation();
  const [tripType, setTripType] = useState("");
  const [fromCity, setFromCity] = useState("");
  const [toCity, setToCity] = useState("");
  const [departureDate, setDepartureDate] = useState("");
  const [returnDate, setReturnDate] = useState("");
  const [passengerType, setPassengerType] = useState("");
  const [username, setUsername] = useState("");

  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const searchParams = new URLSearchParams(location.search);
    setTripType(searchParams.get("triptype"));
    setFromCity(searchParams.get("from"));
    setToCity(searchParams.get("to"));
    setDepartureDate(searchParams.get("departure_date"));
    setReturnDate(searchParams.get("return_date"));
    setPassengerType(searchParams.get("passengertype"));
    setUsername(searchParams.get("username"))
  });

  return (
    <div>
      {loading ? (
        <div
          style={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            width: "100%",
            height: "100vh",
            // background: "#282c34",
            background: "#FFFFF0"
          }}
        >
          <HashLoader color={"#073591"} loading={loading} size={150} />
        </div>
      ) : (
        <div
          style={{
            display: "flex",
            flexDirection: "column",
            justifyContent: "center",
            alignItems: "center",
          }}
        >
          {!open && <Navbar username={username}/>}
          <RechooseTrip
            tripType={tripType}
            fromCity={fromCity}
            toCity={toCity}
            departureDate={departureDate}
            returnDate={returnDate}
            passengerType={passengerType}
            setLoading={setLoading}
            username={username}
          />
          <div
            style={{
              width: "95%",
              display: "flex",
              padding: "30px",
              gap: "20px",
            }}
          >
            <DisplayFlights
                tripType={tripType}
                fromCity={fromCity}
                toCity={toCity}
                departureDate={departureDate}
                returnDate={returnDate}
                passengerType={passengerType}
                setLoading={setLoading}
                username={username}
              />
          </div>
        </div>
      )}
    </div>
  );
}
