import React, { useContext, useState } from "react";
import logo from "../../assets/logo_transparent_blue.png";
import PlaneFly from "@iconscout/react-unicons/icons/uil-plane-fly";
import MapMarker from "@iconscout/react-unicons/icons/uil-map-marker";
import Bag from "@iconscout/react-unicons/icons/uil-bag";
import { PassengerContext } from "./PassengerContext";

export default function EachFlightContainer(props) {
  const { setOpen, setSelectedDepartFlight, setSelectedReturnFlight } =
    useContext(PassengerContext);
  const {
    flight,
    economySeats,
    businessSeats,
    passengerType,
    isDepartSelected,
    setIsDepartSelected,
    isReturnSelected,
    setIsReturnSelected,
    setReturnDisplay,
    setLoading
  } = props;

  const [depart_hour, depart_min] = flight.depart_time.split(":");
  const [landing_hour, landing_min] = flight.arrive_time.split(":");
  const hour_different = landing_hour - depart_hour;
  const min_different =
    depart_min > landing_min
      ? depart_min - landing_min
      : landing_min - depart_min;

  function handleClickOpen(flight) { 
    if (!isDepartSelected) {
      setSelectedDepartFlight(flight);
      setIsDepartSelected(true);
      setReturnDisplay("");
    } else {
      setSelectedReturnFlight(flight);
      setIsReturnSelected(true);
    }  
  //   setLoading(true)
  //   setTimeout(() => {
  //     setLoading(false)
  //   }, 4000);
  }

  return (
    <div className="available_flights_list">
      <div
        className="available_flights_container"
        onClick={() => handleClickOpen(flight)}
      >
        <div className="available_flights_left_container">
          <div className="available_flights_left_upper_container">
            <img src={logo} className="logo_container" />
            <div style={{ display: "flex" }}>
              <div
                style={{
                  display: "flex",
                  flexDirection: "column",
                  marginRight: "20px",
                }}
              >
                <span
                  style={{
                    fontWeight: "350",
                    fontSize: "20px",
                  }}
                >
                  {depart_hour}:{depart_min}
                </span>
                <span style={{ fontSize: "14px" }}>{flight.from}</span>
              </div>
              <PlaneFly className="flight_icon" />
              <span style={{ color: "white" }}>
                .......................................................
              </span>
              <MapMarker className="marker_icon" />
              <div
                style={{
                  display: "flex",
                  flexDirection: "column",
                  marginLeft: "20px",
                }}
              >
                <span
                  style={{
                    fontWeight: "350",
                    fontSize: "20px",
                  }}
                >
                  {landing_hour}:{landing_min}
                </span>
                <span style={{ fontSize: "14px" }}>{flight.to}</span>
              </div>
            </div>
            <span style={{ fontSize: "14px" }}>
              {" "}
              {hour_different}hr {min_different}min{" "}
            </span>
          </div>
          <hr style={{ width: "80%" }} />
          <div className="baggage_text_container">
            <Bag />
            <span style={{ fontWeight: "350", fontSize: "14px" }}>
              7 kg per guest
            </span>
          </div>
        </div>
        <div className="available_flights_right_container">
          <div
            className="price_container"
            style={{ background: "#065a9e" }}
          >
            <span style={{ color: "white" }}>Economy</span>
            <span style={{ fontSize: "18px", color: "white" }}>
              {economySeats
                .filter((seat) => seat.flight_id == flight.flight_id)
                .map((seat, index) => {
                  if (passengerType == "Foreigner") {
                    return seat.price * 2;
                  } else {
                    return seat.price;
                  }
                })}
              $ for one guest
            </span>
          </div>
          <div
            className="price_container"
            style={{
              background: "rgb(65, 138, 240)",
            }}
          >
            <span
              style={{
                color: "white",
              }}
            >
              Business
            </span>
            <span style={{ fontSize: "18px", color: "white" }}>
              {businessSeats
                .filter((seat) => seat.flight_id == flight.flight_id)
                .map((seat, index) => {
                  if (passengerType == "Foreigner") {
                    return seat.price * 2;
                  } else {
                    return seat.price;
                  }
                })}
              $ for one guest
            </span>
          </div>
        </div>
      </div>
    </div>
  );
}
