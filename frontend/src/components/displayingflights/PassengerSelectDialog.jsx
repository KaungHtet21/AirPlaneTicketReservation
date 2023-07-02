import React, { forwardRef, useContext, useState } from "react";
import Dialog from "@mui/material/Dialog";
import AppBar from "@mui/material/AppBar";
import Toolbar from "@mui/material/Toolbar";
import IconButton from "@mui/material/IconButton";
import Typography from "@mui/material/Typography";
import CloseIcon from "@mui/icons-material/Close";
import { Button } from "@mui/material";
import Slide from "@mui/material/Slide";
import { PassengerContext } from "./PassengerContext";
import { useNavigate } from "react-router-dom";

const Transition = forwardRef(function Transition(props, ref) {
  return <Slide direction="up" ref={ref} {...props} />;
});

export default function PassengerSelectDialog(props) {
  const navigate = useNavigate();
  const {
    economySeats,
    businessSeats,
    returnEconomySeats,
    returnBusinessSeats,
    tripType,
    fromCity,
    toCity,
    departureDate,
    returnDate,
    passengerType,
    username
  } = props;
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
    open,
    setOpen,
  } = useContext(PassengerContext);

  const [economyError, setEconomyError] = useState(false)
  const [businessError, setBusinessError] = useState(false)
  const [infantsError, setInfantsError] = useState(false)

  const spanText = `${numEconomyAdults} Adult${
    numEconomyAdults > 1 ? "s" : ""
  }, ${numEconomyChildren} Child${
    numEconomyChildren > 1 ? "ren" : ""
  }, ${numEconomyInfants} Infant${numEconomyInfants > 1 ? "s" : ""}`;

  const spanText2 = `${numBusinessAdults} Adult${
    numBusinessAdults > 1 ? "s" : ""
  }, ${numBusinessChildren} Child${
    numBusinessChildren > 1 ? "ren" : ""
  }, ${numBusinessInfants} Infant${numBusinessInfants > 1 ? "s" : ""}`;

  // Styling selecting passengers
  const [appbarColor, setAppbarColor] = useState("#1976d2");
  const [containerColor, setContainerColor] = useState("#3181c2");

  const handleContainerHover = (item) => {
    if (item === "Economy") {
      setAppbarColor("#1976d2");
      setContainerColor("#065a9e");
    } else if (item === "Business") {
      setAppbarColor("#1976d2");
      setContainerColor("rgb(91, 163, 240)");
    } else {
      setAppbarColor("#1976d2");
      setContainerColor("#3181c2");
    }
  };

  // Functions
  function handleClose() {
    setOpen(false);
  }

  const handleSave = () => {
    const totalInserted = numEconomyAdults + numEconomyChildren + numBusinessAdults + numBusinessChildren
    if ((numEconomyInfants > numEconomyAdults) || (numBusinessInfants > numBusinessAdults)) {
      setInfantsError(true)
      return
    }else {
      setInfantsError(false)
    }

    if ((numEconomyAdults + numEconomyChildren) > (economySeats + returnEconomySeats)) {
      setEconomyError(true)
      return
    }else {
      setEconomyError(false)
    }

    if ((numBusinessAdults + numBusinessChildren) > (businessSeats + returnBusinessSeats)) {
      setBusinessError(true)
      return
    }else {
      setBusinessError(false)
    }

    if ( totalInserted > 0) {
      handleClose();
      navigate(
        `/passengersform?username=${username}&triptype=${tripType}&from=${fromCity}&to=${toCity}&departure_date=${departureDate}&return_date=${returnDate}&passengertype=${passengerType}`
      );
    }
  };

  function incrementCount(countType, cabin) {
    switch (countType) {
      case "adults":
        if (cabin == "Economy") setNumEconomyAdults(numEconomyAdults + 1);
        else setNumBusinessAdults(numBusinessAdults + 1);
        break;
      case "children":
        if (cabin == "Economy") setNumEconomyChildren(numEconomyChildren + 1);
        else setNumBusinessChildren(numBusinessChildren + 1);
        break;
      case "infants":
        if (cabin == "Economy") setNumEconomyInfants(numEconomyInfants + 1);
        else setNumBusinessInfants(numBusinessInfants + 1);
        break;
      default:
        break;
    }
  }

  function decrementCount(countType, cabin) {
    switch (countType) {
      case "adults":
        if (cabin == "Economy") {
          if (numEconomyAdults > 0) setNumEconomyAdults(numEconomyAdults - 1);
        } else {
          if (numBusinessAdults > 0)
            setNumBusinessAdults(numBusinessAdults - 1);
        }
        break;
      case "children":
        if (cabin == "Economy") {
          if (numEconomyChildren > 0)
            setNumEconomyChildren(numEconomyChildren - 1);
        } else {
          if (numBusinessChildren > 0)
            setNumBusinessChildren(numBusinessChildren - 1);
        }
        break;
      case "infants":
        if (cabin == "Economy") {
          if (numEconomyInfants > 0)
            setNumEconomyInfants(numEconomyInfants - 1);
        } else {
          if (numBusinessInfants > 0)
            setNumBusinessInfants(numBusinessInfants - 1);
        }
        break;
      default:
        break;
    }
  }

  return (
    <Dialog
      fullScreen
      open={open}
      onClose={handleClose}
      TransitionComponent={Transition}
    >
      {console.log("Total economy ", economySeats + returnEconomySeats)}
      {console.log("Total business ", businessSeats + returnBusinessSeats)}
      <AppBar
        sx={{
          position: "relative",
          backgroundColor: appbarColor,
          transition: "background-color 0.3s ease",
        }}
      >
        <Toolbar>
          <IconButton
            edge="start"
            color="inherit"
            onClick={handleClose}
            aria-label="close"
          >
            <CloseIcon />
          </IconButton>
          <Typography sx={{ ml: 2, flex: 1 }} variant="h6" component="div">
            Selecting Passengers
          </Typography>
          <Button autoFocus color="inherit" onClick={handleSave}>
            save
          </Button>
        </Toolbar>
      </AppBar>
      <div
        className="passengers_selected_container"
        style={{
          backgroundColor: containerColor,
          transition: "background-color 0.3s ease",
        }}
      >
        {["Economy", "Business"].map((item) => (
          <div
            className="passenger_count_container"
            onMouseEnter={() => handleContainerHover(item)}
            onMouseLeave={handleContainerHover}
          >
            <h2>{item}</h2>
            <div className="passenger_count">
              <div className="passenger_type">Adults</div>
              <div className="passenger_controls">
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => decrementCount("adults", item)}
                >
                  -
                </button>
                <span>
                    {item == "Economy" ? numEconomyAdults : numBusinessAdults}
                  </span>
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => incrementCount("adults", item)}
                >
                  +
                </button>
              </div>
            </div>

            <div className="passenger_count">
              <div className="passenger_type">Children</div>
              <div className="passenger_controls">
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => decrementCount("children", item)}
                >
                  -
                </button>
                <span>
                    {item == "Economy"
                      ? numEconomyChildren
                      : numBusinessChildren}
                  </span>
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => incrementCount("children", item)}
                >
                  +
                </button>
              </div>
            </div>
            <div className="passenger_count">
              <div className="passenger_type">Infants</div>
              <div className="passenger_controls">
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => decrementCount("infants", item)}
                >
                  -
                </button>
                <span>
                    {item == "Economy" ? numEconomyInfants : numBusinessInfants}
                  </span>
                <button
                  className={
                    item === "Economy"
                      ? "blue_controls_btn"
                      : "red_controls_btn"
                  }
                  onClick={() => incrementCount("infants", item)}
                >
                  +
                </button>
              </div>
            </div>
            <div style={{display: "flex", flexDirection: "column"}}>
              {economyError && item === "Economy" && <span style={{color: "red"}}>*Economy seats are not enough</span>}
              {businessError && item === "Business" && <span style={{color: "red"}}>*Business seats are not enough</span>}
              {infantsError && <span style={{color: "red"}}>*Number of adults must be greater than number of infants</span>}
              <span>{item == "Economy" ? spanText : spanText2}</span>
            </div>
          </div>
        ))}
      </div>
    </Dialog>
  );
}
