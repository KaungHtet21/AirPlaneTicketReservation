import React, { useEffect, useState } from "react";
import { Stack, Autocomplete, TextField } from "@mui/material";
import "./FlightOrder.css";
import { DatePicker, LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterMoment } from "@mui/x-date-pickers/AdapterMoment";
import moment from "moment";
import Search from "@iconscout/react-unicons/icons/uil-search-alt";
import { useNavigate } from "react-router-dom";
import Radio from "@mui/joy/Radio";
import RadioGroup from "@mui/joy/RadioGroup";
import { ThemeProvider, createTheme } from "@mui/material/styles";
import { useLocation } from "react-router-dom";

const theme = createTheme({
  palette: {
    background: {
      paper: '#fff',
    }
  }
})

function FlightOrder() {
  const navigate = useNavigate();

  const [tripType, setTripType] = useState("oneway");
  const [departureDate, setDepartureDate] = useState();
  const [returnDate, setReturnDate] = useState();
  const [passengerType, setPassengerType] = useState("Myanmar");

  const [error, setError] = useState(false);

  const [flightsData, setFlightsData] = useState([]);

  let location = useLocation();
  const [username, setUsername] = useState("")

  useEffect(() => {
    const searchParams = new URLSearchParams(location.search)
    setUsername(searchParams.get("username"))
  })

  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getFlights")
      .then((response) => response.json())
      .then((data) => setFlightsData(data));
  }, []);

  const [fromCity, setFromCity] = useState("");
  const from_cities = [
    ...new Set(flightsData.map((flightData) => flightData.from)),
  ];
  const [toCity, setToCity] = useState("");
  const to_cities = [
    ...new Set(
      flightsData
        .filter((flightData) => flightData.from === fromCity)
        .map((flightData) => flightData.to)
    ),
  ];

  function handleSearch() {
    if (tripType == "oneway") {
      if (fromCity == "" || toCity == "" || departureDate == "") {
        setError(true);
      } else {
        setError(false);
        navigate(
          `/ticketselect?username=${username}&triptype=oneway&from=${fromCity}&to=${toCity}&departure_date=${moment(
            departureDate
          ).format(
            "DD MMM,YYYY"
          )}&return_date=${undefined}&passengertype=${passengerType}`
        );
      }
    }

    if (tripType == "roundtrip") {
      if (
        fromCity == "" ||
        toCity == "" ||
        departureDate == "" ||
        returnDate == ""
      ) {
        setError(true);
      } else {
        setError(false);
        navigate(
          `/ticketselect?username=${username}&triptype=roundtrip&from=${fromCity}&to=${toCity}&departure_date=${moment(
            departureDate
          ).format("DD MMM,YYYY")}&return_date=${moment(returnDate).format(
            "DD MMM,YYYY"
          )}&passengertype=${passengerType}`
        );
      }
    }
  }

  return (
    <div className="order_form">
      <select
        name=""
        id=""
        style={{
          width: "120px",
          padding: "10px",
          fontSize: "14px",
          fontWeight: "bold",
          borderWidth: "2px",
          borderColor: 'black'
        }}
        value={tripType}
        onChange={(e) => setTripType(e.target.value)}
      >
        <option value="oneway">One Way</option>
        <option value="roundtrip">Round Trip</option>
      </select>
      <div
        style={{
          gap: "10px",
          display: "flex",
          flexDirection: "column",
          width: "100%",
        }}
      >
        <Stack spacing={2}>
          <Autocomplete
            options={from_cities}
            onChange={(event, newValue) => setFromCity(newValue)}
            renderInput={(params) => <TextField {...params} label="From" />}
            color="white"
          />
        </Stack>
        <Stack spacing={2}>
          <Autocomplete
            options={to_cities}
            onChange={(event, newValue) => setToCity(newValue)}
            renderInput={(params) => <TextField {...params} label="To" />}
          />
        </Stack>
      </div>
      <div style={{ display: "flex", gap: "10px" }}>
        <LocalizationProvider dateAdapter={AdapterMoment}>
          <DatePicker
            className="departure_date_picker"
            label="Departure Date"
            value={departureDate}
            onChange={(date) => setDepartureDate(date)}
            renderInput={(params) => (
              <TextField
                {...params}
                format="ddd, D MM YYYY"
                value={departureDate.format("ddd, D MMM YYYY")}
              />
            )}
            minDate={moment(new Date(), "ddd, D MMM YYYY")}
          />
        </LocalizationProvider>
        {tripType === "roundtrip" && (
          <LocalizationProvider dateAdapter={AdapterMoment}>
            <DatePicker
              className="return_date_picker"
              label="Return Date"
              value={returnDate}
              onChange={(date) => setReturnDate(date)}
              renderInput={(params) => <TextField {...params} />}
              minDate={moment(departureDate, "ddd, D MMM YYYY").add(1, "day")}
            />
          </LocalizationProvider>
        )}
      </div>
      <div style={{ display: "flex", gap: "10px" }}>
        <RadioGroup
          orientation="horizontal"
          value={passengerType}
          onChange={(event) => setPassengerType(event.target.value)}
          sx={{
            minHeight: 48,
            padding: "4px",
            borderRadius: "md",
            bgcolor: "#0d49bf",
            "--RadioGroup-gap": "4px",
            "--Radio-actionRadius": "8px",
          }}
        >
          {["Myanmar", "Foreigner"].map((item) => (
            <Radio
              key={item}
              color="#24265D"
              value={item}
              disableIcon
              label={item}
              sx={{
                px: 2,
                alignItems: "center",
                // color: "black",
                color: passengerType === item ? "black" : "white",
                '& input[type="radio"]' : {
                  "&:checked + span" : {
                    bgcolor: theme.palette.background.paper,
                  },
                }
              }}
              slotProps={{
                action: ({ checked }) => ({
                  // sx: {
                  //   ...(checked && {
                  //     bgcolor: "#fff",
                  //   }),
                  // },
                  sx: {
                    bgcolor: checked ? "#fff" : undefined
                  }
                }),
              }}
            />
          ))}
        </RadioGroup>

        <div className="search_trip_btn" onClick={handleSearch}>
          <Search className="search_trip_icon" />
          <span
            style={{
              fontSize: "18px",
              marginLeft: "3px",
              fontWeight: "bold",
              color: "white",
            }}
          >
            Search
          </span>
        </div>
      </div>
      <span style={{ color: "red" }} className={error ? "" : "error_display"}>
        *We need all information.
      </span>
    </div>
  );
}

export default FlightOrder;
