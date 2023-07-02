import React, { useEffect, useState } from "react";
import "./RechooseTrip.css";
import { Autocomplete, Stack, TextField } from "@mui/material";
import { DatePicker, LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterMoment } from "@mui/x-date-pickers/AdapterMoment";
import moment from "moment";
import Search from "@iconscout/react-unicons/icons/uil-search-alt";
import { useNavigate } from "react-router-dom";

export default function RechooseTrip(props) {
  const navigate = useNavigate();
  const {
    tripType,
    fromCity,
    toCity,
    departureDate,
    returnDate,
    passengerType,
    setLoading,
    username
  } = props;

  const [triptype, setTriptype] = useState("");
  const [from, setFrom] = useState("");
  const [to, setTo] = useState("");
  const [departure_date, setDeparture_date] = useState("");
  const [return_date, setReturn_date] = useState();

  const [flightsData, setFlightsData] = useState([]);

  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getFlights")
      .then((response) => response.json())
      .then((data) => setFlightsData(data));
  }, []);
  const from_cities = [
    ...new Set(flightsData.map((flightData) => flightData.from)),
  ];
  const to_cities = [
    ...new Set(
      flightsData
        .filter((flightData) => flightData.from === fromCity)
        .map((flightData) => flightData.to)
    ),
  ];

  const [error, setError] = useState(false);

  useEffect(() => {
    if (tripType) {
      setTriptype(tripType);
    }
    if (fromCity) {
      setFrom(fromCity);
    }
    if (toCity) {
      setTo(toCity);
    }
    if (departureDate) {
      const depart_moment = moment(departureDate);
      setDeparture_date(depart_moment);
    }

    if (tripType == "roundtrip") {
      if (returnDate) {
        const return_moment = moment(returnDate);
        setReturn_date(return_moment);
      }
    }
  }, [tripType, fromCity, toCity, departureDate, returnDate]);

  function handleSearch() {
    if (triptype == "oneway") {
      if (from == "" || to == "" || departure_date == "") {
        setError(true);
      } else {
        setError(false);
        setLoading(true);
        setTimeout(() => {
          navigate(
            `/ticketselect?username=${username}&triptype=oneway&from=${from}&to=${to}&departure_date=${moment(
              departure_date
            ).format(
              "DD MMM,YYYY"
            )}&return_date=${undefined}&passengertype=${passengerType}`
          );
          setLoading(false);
        }, 4000);
      }
    }

    if (triptype == "roundtrip") {
      if (
        from == "" ||
        to == "" ||
        departure_date == "" ||
        return_date == undefined
      ) {
        setError(true);
      } else {
        setError(false);
        setLoading(true);
        setTimeout(() => {
          navigate(
            `/ticketselect?username=${username}&triptype=roundtrip&from=${from}&to=${to}&departure_date=${moment(
              departure_date
            ).format("DD MMM,YYYY")}&return_date=${moment(return_date).format(
              "DD MMM,YYYY"
            )}&passengertype=${passengerType}`
          );
          setLoading(false);
        }, 2000);
      }
    }
  }

  return (
    <div className="rechoosetrip_container">
      <div style={{ display: "flex", justifyContent: "space-between" }}>
        <select
          name=""
          id=""
          style={{
            width: "120px",
            padding: "10px",
            fontSize: "14px",
            fontWeight: "bold",
            borderWidth: "2px",
            marginLeft: "10px",
          }}
          value={triptype}
          onChange={(e) => setTriptype(e.target.value)}
        >
          <option value="oneway">One Way</option>
          <option value="roundtrip">Round Trip</option>
        </select>
        <span style={{ color: "red" }} className={error ? "" : "error_display"}>
          *We need all information.
        </span>
      </div>
      <div
        style={{
          display: "flex",
          justifyContent: "space-evenly",
          width: "100%",
        }}
      >
        <Stack spacing={2} style={{ width: "250px" }}>
          <Autocomplete
            options={from_cities}
            onChange={(event, newValue) => setFrom(newValue)}
            value={from}
            renderInput={(params) => <TextField {...params} label="From" />}
          />
        </Stack>
        <Stack spacing={2} style={{ width: "250px" }}>
          <Autocomplete
            options={to_cities}
            onChange={(event, newValue) => setTo(newValue)}
            value={to}
            renderInput={(params) => <TextField {...params} label="To" />}
          />
        </Stack>

        <LocalizationProvider dateAdapter={AdapterMoment}>
          <DatePicker
            label="Departure Date"
            value={departure_date}
            onChange={(date) => setDeparture_date(date)}
            renderInput={(params) => <TextField {...params} />}
            minDate={moment(new Date(), "ddd, D MMM YYYY")}
          />
        </LocalizationProvider>

        {triptype === "roundtrip" && (
          <LocalizationProvider dateAdapter={AdapterMoment}>
            <DatePicker
              label="Return Date"
              value={return_date}
              onChange={(date) => setReturn_date(date)}
              renderInput={(params) => <TextField {...params} />}
              minDate={moment(departure_date, "ddd, D MMM YYYY").add(1, "day")}
            />
          </LocalizationProvider>
        )}

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
    </div>
  );
}
