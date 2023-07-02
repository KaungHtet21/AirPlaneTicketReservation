import React, { forwardRef, useContext, useEffect, useState } from "react";
import ShowBookingDetail from "../components/showBookingDetail/ShowBookingDetail";
import { useLocation, useNavigate } from "react-router-dom";
import PassengerInfo from "../components/passengerInfo/PassengerInfo";
import { PassengerContext } from "../components/displayingflights/PassengerContext";
import ContactInfo from "../components/passengerInfo/ContactInfo";
import Button from "@mui/material/Button";
import Dialog from "@mui/material/Dialog";
import DialogActions from "@mui/material/DialogActions";
import DialogContent from "@mui/material/DialogContent";
import DialogTitle from "@mui/material/DialogTitle";
import Slide from "@mui/material/Slide";
import PlaneFly from "@iconscout/react-unicons/icons/uil-plane-fly";
import PlaneArrival from "@iconscout/react-unicons/icons/uil-plane-arrival";
import "./BookingDialog.css";
import logo from "../assets/logo_transparent_blue.png";
import FooterBtn from "../components/passengerInfo/FooterBtn";
import DialogContentText from "@mui/material/DialogContentText";
import TextField from "@mui/material/TextField";
import Navbar from './../components/navbar/Navbar';

const Transition = forwardRef(function Transition(props, ref) {
  return <Slide direction="up" ref={ref} {...props} />;
});

export default function PassengersFormSelection() {
  const navigate = useNavigate();
  const {
    numEconomyAdults,
    numEconomyChildren,
    numEconomyInfants,
    numBusinessAdults,
    numBusinessChildren,
    numBusinessInfants,
    setNumEconomyAdults,
    setNumEconomyChildren,
    setNumEconomyInfants,
    setNumBusinessAdults,
    setNumBusinessChildren,
    setNumBusinessInfants,
    selectedDepartFlight,
    selectedReturnFlight,
    selectedEconomyPrice,
    selectedBusinessPrice,
    selectedReturnEconomyPrice,
    selectedReturnBusinessPrice,
  } = useContext(PassengerContext);

  let location = useLocation();
  const [username, setUsername] = useState("");
  const [tripType, setTripType] = useState("");
  const [fromCity, setFromCity] = useState("");
  const [toCity, setToCity] = useState("");
  const [departureDate, setDepartureDate] = useState("");
  const [returnDate, setReturnDate] = useState("");
  const [passengerType, setPassengerType] = useState("");
  const [emailCode, setEmailCode] = useState("");
  const [filledCode, setFilledCode] = useState("");
  const [open, setOpen] = useState(false);
  const [openEmailDialog, setOpenEmailDialog] = useState(false);
  const [emailCodeError, setEmailCodeError] = useState(false);

  const [firstNameInput, setFirstNameInput] = useState("");
  const [lastNameInput, setLastNameInput] = useState("");
  const [phone, setPhone] = useState("");
  const [email, setEmail] = useState("");
  const [address, setAddress] = useState("");
  const [error, setError] = useState(false);

  // Price details
  const [ecoAdult, setEcoAdult] = useState(0);
  const [ecoChildren, setEcoChildren] = useState(0);
  const [busiAdult, setBusiAdult] = useState(0);
  const [busiChildren, setBusiChildren] = useState(0);
  const [ecoReturnAdult, setEcoReturnAdult] = useState(0);
  const [ecoReturnChildren, setEcoReturnChildren] = useState(0);
  const [busiReturnAdult, setBusiReturnAdult] = useState(0);
  const [busiReturnChildren, setBusiReturnChildren] = useState(0);
  const [totalPrice, setTotalPrice] = useState(0);

  useEffect(() => {
    const searchParams = new URLSearchParams(location.search);
    setTripType(searchParams.get("triptype"));
    setFromCity(searchParams.get("from"));
    setToCity(searchParams.get("to"));
    setDepartureDate(searchParams.get("departure_date"));
    setReturnDate(searchParams.get("return_date"));
    setPassengerType(searchParams.get("passengertype"));
    setUsername(searchParams.get("username"));

    // Depart price
    setEcoAdult(numEconomyAdults * selectedEconomyPrice);
    setEcoChildren(
      (
        numEconomyChildren * selectedEconomyPrice -
        numEconomyChildren * selectedEconomyPrice * 0.05
      ).toFixed(2)
    ); // Apply 5% discount to each child
    setBusiAdult(numBusinessAdults * selectedBusinessPrice);
    setBusiChildren(
      (
        numBusinessChildren * selectedBusinessPrice -
        numBusinessChildren * selectedBusinessPrice * 0.05
      ).toFixed(2)
    ); // Apply 5% discount to each child

    // Return price
    setEcoReturnAdult(numEconomyAdults * selectedReturnEconomyPrice);
    setEcoReturnChildren(
      (
        numEconomyChildren * selectedReturnEconomyPrice -
        numEconomyChildren * selectedReturnEconomyPrice * 0.05
      ).toFixed(2)
    ); // Apply 5% discount to each child
    setBusiReturnAdult(numBusinessAdults * selectedReturnBusinessPrice);
    setBusiReturnChildren(
      (
        numBusinessChildren * selectedReturnBusinessPrice -
        numBusinessChildren * selectedReturnBusinessPrice * 0.05
      ).toFixed(2)
    ); // Apply 5% discount to each child

    setTotalPrice(
      Number(ecoAdult) +
        Number(ecoChildren) +
        Number(busiAdult) +
        Number(busiChildren) +
        Number(ecoReturnAdult) +
        Number(ecoReturnChildren) +
        Number(busiReturnAdult) +
        Number(busiReturnChildren)
    );
  });

  const [passengers, setPassengers] = useState([]);
  const [contact, setContact] = useState();
  const [contactDisplay, setContactDisplay] = useState(true);

  function handleConfirm() {
    if (
      passengers.length ==
        numEconomyAdults +
          numEconomyChildren +
          numEconomyInfants +
          numBusinessAdults +
          numBusinessChildren +
          numBusinessInfants &&
      !contactDisplay
    ) {
      const item = {
        selectedDepartFlight,
        selectedReturnFlight,
        passengers,
        contact,
      };
      navigate(
        `/paymentform?username=${username}&triptype=${tripType}&from=${fromCity}&to=${toCity}&departure_date=${departureDate}&return_date=${returnDate}&passengertype=${passengerType}&passengers=${JSON.stringify(
          passengers
        )}&contact=${JSON.stringify(contact)}&totalPrice=${totalPrice}`
      );
    }
  }

  function handleClose() {
    setOpen(false);
  }

  function handleCloseDialog() {
    if (emailCode == filledCode) {
      const contact = { firstNameInput, lastNameInput, email, phone, address };
      setContact(contact);
      setError(false);
      setContactDisplay(false);
      setOpenEmailDialog(false);
      setEmailCodeError(false);
    } else {
      setEmailCodeError(true);
    }
  }

  function handleEdit() {
    setNumEconomyAdults(0);
    setNumEconomyChildren(0);
    setNumEconomyInfants(0);
    setNumBusinessAdults(0);
    setNumBusinessChildren(0);
    setNumBusinessInfants(0);
    navigate(
      `/ticketselect?username=${username}&triptype=${tripType}&from=${fromCity}&to=${toCity}&departure_date=${departureDate}&return_date=${returnDate}&passengertype=${passengerType}`
    );
  }

  return (
    <div
      style={{
        display: "flex",
        flexDirection: "column",
        justifyContent: "center",
        alignItems: "center",
      }}
    >
      <Navbar username={username}/>
      <ShowBookingDetail
        tripType={tripType}
        fromCity={fromCity}
        toCity={toCity}
        departureDate={departureDate}
        returnDate={returnDate}
        passengerType={passengerType}
        setOpen={setOpen}
      />
      <PassengerInfo
        tripType={tripType}
        passengers={passengers}
        setPassengers={setPassengers}
        ecoAdultPrice={ecoAdult}
        ecoChildrenPrice={ecoChildren}
        busiAdultPrice={busiAdult}
        busiChildrenPrice={busiChildren}
        ecoReturnAdultPrice={ecoReturnAdult}
        ecoReturnChildrenPrice={ecoReturnChildren}
        busiReturnAdultPrice={busiReturnAdult}
        busiReturnChildrenPrice={busiReturnChildren}
      />

      {contactDisplay && (
        <ContactInfo
          setContactDisplay={setContactDisplay}
          setContact={setContact}
          setOpenEmailDialog={setOpenEmailDialog}
          setEmailCode={setEmailCode}
          firstNameInput={firstNameInput}
          setFirstNameInput={setFirstNameInput}
          lastNameInput={lastNameInput}
          setLastNameInput={setLastNameInput}
          phone={phone}
          setPhone={setPhone}
          email={email}
          setEmail={setEmail}
          address={address}
          setAddress={setAddress}
          error={error}
          setError={setError}
        />
      )}
      {!contactDisplay && (
        <FooterBtn handleConfirm={handleConfirm} passengers={passengers} />
      )}
      <Dialog
        open={open}
        TransitionComponent={Transition}
        keepMounted
        onClose={handleClose}
        className="booking_dialog_container"
      >
        <DialogTitle>{"Booking Details"}</DialogTitle>
        <DialogContent className="booking_dialog_content">
          <div className="dialog_flight_details">
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
                  <br />
                </div>
              )
            )}
          </div>
          <div className="dialog_passengers_details">
            <div style={{ display: "flex", flexDirection: "column" }}>
              <div style={{ display: "flex", gap: "10px" }}>
                <span
                  style={{
                    fontSize: "18px",
                    fontWeight: "bold",
                    fontStyle: "italic",
                  }}
                >
                  Note
                </span>
                <span style={{ fontSize: "16px" }}>
                  Each adult must pay according to the price set. We give 5%
                  discount for each child. Infants don't need to pay at all.
                  Thanks for supporting us.
                </span>
              </div>
              <img
                style={{ width: "75px", height: "75px" }}
                src={logo}
                alt=""
              />
            </div>

            <div
              style={{
                display: "flex",
                justifyContent: "space-evenly",
                gap: "20px",
              }}
            >
              <div style={{ display: "flex", flexDirection: "column" }}>
                <br />
                {numEconomyAdults > 0 && (
                  <span>Economy Adults &times; {numEconomyAdults}</span>
                )}
                {numEconomyChildren > 0 && (
                  <span>Economy Children &times; {numEconomyChildren}</span>
                )}
                {numBusinessAdults > 0 && (
                  <span>Business Adults &times; {numBusinessAdults}</span>
                )}
                {numBusinessChildren > 0 && (
                  <span>Business Children &times; {numBusinessChildren}</span>
                )}
              </div>
              <div style={{ display: "flex", flexDirection: "column" }}>
                <span style={{ fontSize: "16px", fontWeight: "500" }}>
                  Depart
                </span>
                {numEconomyAdults > 0 && <span>{ecoAdult}$</span>}
                {numEconomyChildren > 0 && <span>{ecoChildren}$</span>}
                {numBusinessAdults > 0 && <span>{busiAdult}$</span>}
                {numBusinessChildren > 0 && <span>{busiChildren}$</span>}
              </div>
              {tripType == "roundtrip" && (
                <div style={{ display: "flex", flexDirection: "column" }}>
                  <span style={{ fontSize: "16px", fontWeight: "500" }}>
                    Return
                  </span>
                  {numEconomyAdults > 0 && <span>{ecoReturnAdult}$</span>}
                  {numEconomyChildren > 0 && <span>{ecoReturnChildren}$</span>}
                  {numBusinessAdults > 0 && <span>{busiReturnAdult}$</span>}
                  {numBusinessChildren > 0 && (
                    <span>{busiReturnChildren}$</span>
                  )}
                </div>
              )}
            </div>
            <hr style={{ width: "100%" }} />
            <span>
              Total Price = <span>{totalPrice.toFixed(2)}$</span>{" "}
            </span>
          </div>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleEdit}>Edit</Button>
          <Button onClick={handleClose}>Agree</Button>
        </DialogActions>
      </Dialog>

      <Dialog open={openEmailDialog} onClose={handleCloseDialog}>
        <DialogTitle>Confirm you email</DialogTitle>
        <DialogContent>
          <DialogContentText>
            To confirm your email, please enter the code. We have already sent a
            six-digit code to your email.
          </DialogContentText>
          {emailCodeError && (
            <span style={{ color: "red" }}>
              *You filled the wrong code. Please try again.
            </span>
          )}
          <TextField
            autoFocus
            margin="dense"
            label="Email Code"
            fullWidth
            variant="standard"
            value={filledCode}
            onChange={(e) => setFilledCode(e.target.value)}
          />
        </DialogContent>
        <DialogActions>
          <Button onClick={handleCloseDialog}>Confirm</Button>
        </DialogActions>
      </Dialog>
    </div>
  );
}
