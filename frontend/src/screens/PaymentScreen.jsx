import React, { useState, useEffect, useContext } from "react";
import { useLocation } from "react-router-dom";
import PlaneFly from "@iconscout/react-unicons/icons/uil-plane-fly";
import PlaneArrival from "@iconscout/react-unicons/icons/uil-plane-arrival";
import { PassengerContext } from "../components/displayingflights/PassengerContext";
import PaymentContainer from "../components/payment/PaymentContainer";
import Navbar from './../components/navbar/Navbar';

export default function PaymentScreen() {
  const { selectedDepartFlight, selectedReturnFlight } =
    useContext(PassengerContext);

  let location = useLocation();
  const [username, setUsername] = useState("");
  const [tripType, setTripType] = useState("");
  const [fromCity, setFromCity] = useState("");
  const [toCity, setToCity] = useState("");
  const [departureDate, setDepartureDate] = useState("");
  const [returnDate, setReturnDate] = useState("");
  const [passengerType, setPassengerType] = useState("");
  const [passengers, setPassengers] = useState([]);
  const [contact, setContact] = useState(null);
  const totalPrice = passengers.reduce(
    (acc, passenger) => Number(acc) + Number(passenger.price),
    0
  );

  useEffect(() => {
    const searchParams = new URLSearchParams(location.search);
    setTripType(searchParams.get("triptype"));
    setFromCity(searchParams.get("from"));
    setToCity(searchParams.get("to"));
    setDepartureDate(searchParams.get("departure_date"));
    setReturnDate(searchParams.get("return_date"));
    setPassengerType(searchParams.get("passengertype"));
    setPassengers(JSON.parse(searchParams.get("passengers")));
    setContact(JSON.parse(searchParams.get("contact")));
    setUsername(searchParams.get("username"))
  }, []);

  return (
    <div
      style={{
        display: "flex",
        flexDirection: "column",
        width: "100%",
        justifyContent: "center",
        alignItems: "center",
        gap: "20px"
      }}
    >
      <Navbar username={username}/>
      <div className="booking_toplv_container">
        <span style={{ fontSize: "24px", fontWeight: "500" }}>
          Booking Details
        </span>
        <div className="booking_container">
          <div style={{ display: "flex", gap: "50px" }}>
            {(tripType == "roundtrip" ? ["Depart", "Return"] : ["Depart"]).map(
              (item, index) => (
                <div style={{ display: "flex", flexDirection: "column" }}>
                  <div style={{ display: "flex", marginBottom: "15px" }}>
                    {item === "Depart" ? (
                      <PlaneFly size={"2rem"} />
                    ) : (
                      <PlaneArrival size={"2rem"} />
                    )}
                    <div
                      style={{
                        display: "flex",
                        flexDirection: "column",
                        marginLeft: "10px",
                      }}
                    >
                      <span style={{ fontSize: "18px", fontWeight: "350" }}>
                        {item === "Depart" ? "Depart Date" : "Return Date"}
                      </span>
                      <span style={{ fontSize: "18px", fontWeight: "500" }}>
                        {item === "Depart" ? departureDate : returnDate}
                      </span>
                    </div>
                  </div>
                  <span style={{ fontSize: "20px" }}>
                    {item === "Depart"
                      ? `${selectedDepartFlight.from} ${"\u2192"} ${
                          selectedDepartFlight.to
                        }`
                      : `${selectedReturnFlight.from} ${"\u2192"} ${
                          selectedReturnFlight.to
                        }`}
                  </span>
                  <span style={{ fontSize: "18px", color: "gray" }}>
                    {item === "Depart"
                      ? `${selectedDepartFlight.flight_number} | ${selectedDepartFlight.depart_time} - ${selectedDepartFlight.arrive_time}`
                      : `${selectedReturnFlight.flight_number} | ${selectedReturnFlight.depart_time} - ${selectedReturnFlight.arrive_time}`}
                  </span>
                </div>
              )
            )}
          </div>
          <div style={{display: "flex", flexDirection: "column", gap: "10px", marginTop: "30px"}}>
            {passengers.map((passenger) => (
              <div style={{display: "flex", gap: "30px"}}>
                <span>{passenger.firstName}{" "} {passenger.lastName}</span>
                <span>{passenger.documentData}</span>
                <span>{passenger.price}$</span>
                {passenger.memberCode != "" && <span>Discount with member card</span> }
              </div>
            ))}
            <span>Total : {totalPrice}$ </span>
          </div>
        </div>
      </div>

      <PaymentContainer passengers={passengers} contact={contact} totalPrice={totalPrice} username={username} />
    </div>
  );
}
