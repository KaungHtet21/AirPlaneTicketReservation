import React, { useState, useContext, useEffect } from "react";
import { PassengerContext } from "./PassengerContext";
import PlaneFly from "@iconscout/react-unicons/icons/uil-plane-fly";
import MapMarker from "@iconscout/react-unicons/icons/uil-map-marker";

export default function SelectedTicketContainer(props) {
  const {
    isDepartSelected,
    isReturnSelected,
    economySeats,
    businessSeats,
    passengerType,
  } = props;
  const {
    selectedDepartFlight,
    selectedReturnFlight,
    selectedEconomyPrice,
    setSelectedEconomyPrice,
    selectedBusinessPrice,
    setSelectedBusinessPrice,
    selectedReturnEconomyPrice,
    setSelectedReturnEconomyPrice,
    selectedReturnBusinessPrice,
    setSelectedReturnBusinessPrice,
  } = useContext(PassengerContext);
  
  const depart_display = isDepartSelected ? "" : "none";
  const return_display = isReturnSelected ? "" : "none";

  const selectedEcoSeat = economySeats.find(
    (seat) => seat.flight_id === selectedDepartFlight.flight_id
  );
  if (selectedEcoSeat) {
    if (passengerType == "Foreigner") {
      setSelectedEconomyPrice(selectedEcoSeat.price * 2);
    } else {
      setSelectedEconomyPrice(selectedEcoSeat.price);
    }
  }

  const selectedBusinessSeat = businessSeats.find(
    (seat) => seat.flight_id === selectedDepartFlight.flight_id
  );
  if (selectedBusinessSeat) {
    if (passengerType == "Foreigner") {
      setSelectedBusinessPrice(selectedBusinessSeat.price * 2);
    } else {
      setSelectedBusinessPrice(selectedBusinessSeat.price);
    }
  }

  const [depart_hour, depart_min] = selectedDepartFlight.depart_time.split(":");
  const [landing_hour, landing_min] =
    selectedDepartFlight.arrive_time.split(":");
  const hour_different = landing_hour - depart_hour;
  const min_different =
    depart_min > landing_min
      ? depart_min - landing_min
      : landing_min - depart_min;

      let [return_depart_hour, return_depart_min] = ""
      let [return_landing_hour, return_landing_min] =""
      let return_hour_different = ""
      let return_min_different = ""
  if (selectedReturnFlight != undefined) {
    const selectedEcoSeat = economySeats.find(
      (seat) => seat.flight_id === selectedReturnFlight.flight_id
    );
    if (selectedEcoSeat) {
      if (passengerType == "Foreigner") {
        setSelectedReturnEconomyPrice(selectedEcoSeat.price * 2);
      } else {
        setSelectedReturnEconomyPrice(selectedEcoSeat.price);
      }
    }

    const selectedBusinessSeat = businessSeats.find(
      (seat) => seat.flight_id === selectedReturnFlight.flight_id
    );
    if (selectedBusinessSeat) {
      if (passengerType == "Foreigner") {
        setSelectedReturnBusinessPrice(selectedBusinessSeat.price * 2);
      } else {
        setSelectedReturnBusinessPrice(selectedBusinessSeat.price);
      }
    }

    [return_depart_hour, return_depart_min] =
      selectedReturnFlight.depart_time.split(":");
    [return_landing_hour, return_landing_min] =
      selectedReturnFlight.arrive_time.split(":");
    return_hour_different = return_landing_hour - return_depart_hour;
    return_min_different =
      return_depart_min > return_landing_min
        ? return_depart_min - return_landing_min
        : return_landing_min - return_depart_min;
  }
  
  return (
    <div
      style={{
        display: "flex",
        flexDirection: "column",
        width: "100%",
        alignItems: "center",
      }}
    >
      <div
        style={{ display: depart_display }}
        className="available_flights_container"
      >
        <div
          className="available_flights_left_container"
          style={{ justifyContent: "center" }}
        >
          <div className="available_flights_left_upper_container">
            <span style={{ fontSize: "24px", fontWeight: "500" }}>
              Selected<br></br> Ticket
            </span>
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
                <span style={{ fontSize: "14px" }}>
                  {selectedDepartFlight.from}
                </span>
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
                <span style={{ fontSize: "14px" }}>
                  {selectedDepartFlight.to}
                </span>
              </div>
            </div>
            <span style={{ fontSize: "14px" }}>
              {" "}
              {hour_different}hr {min_different}min{" "}
            </span>
          </div>
        </div>
        <div className="available_flights_right_container">
          {selectedEconomyPrice > 0 && (
            <div
              className="price_container"
              style={{ background: "#065a9e" }}
            >
              <span style={{ color: "white" }}>Economy</span>
              <span style={{fontSize: "18px", color: "white"}}>${selectedEconomyPrice} for each.</span>
            </div>
          )}
          {selectedBusinessPrice > 0 && (
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
              <span style={{fontSize: "18px", color: "white"}}>${selectedBusinessPrice} for each.</span>
            </div>
          )}
        </div>
      </div>
      {selectedReturnFlight != undefined && 
      <div
        style={{ display: return_display }}
        className="available_flights_container"
      >
        <div
          className="available_flights_left_container"
          style={{ justifyContent: "center" }}
        >
          <div className="available_flights_left_upper_container">
            <span style={{ fontSize: "24px", fontWeight: "500" }}>
              Selected<br></br> Ticket
            </span>
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
                  {return_depart_hour}:{return_depart_min}
                </span>
                <span style={{ fontSize: "14px" }}>
                  {selectedReturnFlight.from}
                </span>
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
                  {return_landing_hour}:{return_landing_min}
                </span>
                <span style={{ fontSize: "14px" }}>
                  {selectedReturnFlight.to}
                </span>
              </div>
            </div>
            <span style={{ fontSize: "14px" }}>
              {" "}
              {return_hour_different}hr {return_min_different}min{" "}
            </span>
          </div>
        </div>
        <div className="available_flights_right_container">
          {selectedReturnEconomyPrice > 0 && (
            <div
              className="price_container"
              style={{ background: "#065a9e" }}
            >
              <span style={{ color: "white" }}>Economy</span>
              <span style={{fontSize: "18px", color: "white"}}>${selectedReturnEconomyPrice} for each.</span>
            </div>
          )}
          {selectedReturnBusinessPrice > 0 && (
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
              <span style={{fontSize: "18px", color: "white"}}>${selectedReturnBusinessPrice} for each.</span>
            </div>
          )}
        </div>
      </div>
}
    </div>
  );
}
