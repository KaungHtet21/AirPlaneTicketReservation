import React, { useState } from "react";
import SwiperCore, { Navigation, Pagination, Autoplay } from "swiper";
import "swiper/css";
import "./PassengerInfo.css";
import PassengerInfoSlide from "./PassengerInfoSlide";

SwiperCore.use([Navigation, Pagination, Autoplay]);

export default function PassengerInfo(props) {
  const {
    tripType,
    passengers,
    setPassengers,
    ecoAdultPrice,
    ecoChildrenPrice,
    busiAdultPrice,
    busiChildrenPrice,
    ecoReturnAdultPrice,
    ecoReturnChildrenPrice,
    busiReturnAdultPrice,
    busiReturnChildrenPrice,
  } = props;
  const [showAlertMsg, setShowAlertMsg] = useState(false);

  return (
    <div style={{ width: "80%" }}>
      <h2>Passengers Info</h2>
      <div className={`alert_msg ${showAlertMsg ? "slide_in" : "slide_out"}`}>
        Passenger info is filled successfully.
      </div>
      {/* // Depart Adults */}
      <PassengerInfoSlide
        tripType={tripType}
        title="Adults"
        showAlertMsg={showAlertMsg}
        setShowAlertMsg={setShowAlertMsg}
        setPassengers={setPassengers}
        passengers={passengers}
        ecoPrice={ecoAdultPrice}
        busiPrice={busiAdultPrice}
        ecoReturnPrice={ecoReturnAdultPrice}
        busiReturnPrice={busiReturnAdultPrice}
      />
      {/* // Depart Children */}
      <PassengerInfoSlide
        tripType={tripType}
        title="Children"
        showAlertMsg={showAlertMsg}
        setShowAlertMsg={setShowAlertMsg}
        setPassengers={setPassengers}
        passengers={passengers}
        ecoPrice={ecoChildrenPrice}
        busiPrice={busiChildrenPrice}
        ecoReturnPrice={ecoReturnChildrenPrice}
        busiReturnPrice={busiReturnChildrenPrice}
      />
      {/* // Depart Infants */}
      <PassengerInfoSlide
        tripType={tripType}
        title="Infants"
        showAlertMsg={showAlertMsg}
        setShowAlertMsg={setShowAlertMsg}
        setPassengers={setPassengers}
        passengers={passengers}
      />
    </div>
  );
}
