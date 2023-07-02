import React, { useContext, useEffect, useState } from "react";
import "./ShowBookingDetail.css";
import PlaneFly from "@iconscout/react-unicons/icons/uil-plane-fly";
import PlaneArrival from "@iconscout/react-unicons/icons/uil-plane-arrival";
import AngleUp from "@iconscout/react-unicons/icons/uil-angle-up";
import { PassengerContext } from "../displayingflights/PassengerContext";

export default function ShowBookingDetail(props) {
  
  const {
    tripType,
    departureDate,
    returnDate,
    setOpen
  } = props;

  const {
    selectedDepartFlight,
    selectedReturnFlight
  } = useContext(PassengerContext);

  const handleOpen = () => {
    setOpen(true);
  };
  return (
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
        <hr style={{ width: "100%", marginTop: "20px" }} />
        <div className="showing_detail_btn" onClick={handleOpen} >
          <span style={{ fontSize: "18px", color: "red", marginBottom: "4px" }}>
            Showing Details{" "}
          </span>
          <AngleUp size={"1.5rem"} color={"red"} />
        </div>
      </div>
    </div>
  );
}
