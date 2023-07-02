import React, { useContext, useEffect, useState } from "react";
import SortIcon from "@iconscout/react-unicons/icons/uil-sort-amount-down";
import "./DisplayFlights.css";
import moment from "moment";
import EachFlightContainer from "./EachFlightContainer";
import PassengerSelectDialog from "./PassengerSelectDialog";
import { PassengerContext, PassengerProvider } from "./PassengerContext";
import SelectedTicketContainer from "./SelectedTicketContainer";

export default function DisplayFlights(props) {
  // Required Props
  const { setOpen } = useContext(PassengerContext);
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

  const [isDepartSelected, setIsDepartSelected] = useState(false);
  const [isReturnSelected, setIsReturnSelected] = useState(false);

  const formattedDepartureDate = moment(departureDate, "DD MMM,YYYY").format(
    "YYYY-MM-DD"
  );
  const formattedReturnDate = moment(returnDate, "DD MMM,YYYY").format(
    "YYYY-MM-DD"
  );

  const [returnDisplay, setReturnDisplay] = useState("none");

  // Sorting
  const [sort, setSort] = useState("Time");
  const [dropdownVisible, setDropdownVisible] = useState(false);

  // ***************** Manage Flights *****************//

  // Fetch flights from backend
  const [flightsData, setFlightsData] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getFlights")
      .then((response) => response.json())
      .then((data) => setFlightsData(data));
  }, []);
  // Filter FlightsData
  const filteredFlightsData = flightsData.filter((flight, index) => {
    return (
      flight.from == fromCity &&
      flight.to == toCity &&
      flight.depart_date == formattedDepartureDate
    );
  });

  const filteredReturnFlightsData = flightsData.filter((flight, index) => {
    return (
      flight.from == toCity &&
      flight.to == fromCity &&
      flight.depart_date == formattedReturnDate
    );
  });

  // ***************** Manage Flights *****************//

  // ***************** Manage Seats *****************//

  const [seatsData, setSeatsData] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getSeats")
      .then((response) => response.json())
      .then((data) => setSeatsData(data));
  }, []);

  const economySeats = seatsData.filter((seat, index) => {
    return filteredFlightsData.some((flight, index) => {
      return (
        flight.flight_id == seat.flight_id &&
        seat.available == 1 &&
        seat.class == "economy"
      );
    });
  });

  const returnEconomySeats = seatsData.filter((seat, index) => {
    return filteredReturnFlightsData.some((flight, index) => {
      return (
        flight.flight_id == seat.flight_id &&
        seat.available == 1 &&
        seat.class == "economy"
      );
    });
  });

  let alreadyTaken = new Set();
  let economySeatsSet = [];

  for (let i = 0; i < economySeats.length; i++) {
    const seat = economySeats[i];
    if (alreadyTaken.has(seat.flight_id)) {
      continue;
    }

    economySeatsSet.push(seat);
    alreadyTaken.add(seat.flight_id);
  }

  let alreadyTaken3 = new Set();
  let returnEconomySeatsSet = [];

  for (let i = 0; i < returnEconomySeats.length; i++) {
    const seat = returnEconomySeats[i];
    if (alreadyTaken3.has(seat.flight_id)) {
      continue;
    }

    returnEconomySeatsSet.push(seat);
    alreadyTaken3.add(seat.flight_id);
  }

  const businessSeats = seatsData.filter((seat) => {
    return filteredFlightsData.some((flight) => {
      return (
        flight.flight_id == seat.flight_id &&
        seat.available == 1 &&
        seat.class == "business"
      );
    });
  });

  const returnBusinessSeats = seatsData.filter((seat) => {
    return filteredReturnFlightsData.some((flight) => {
      return (
        flight.flight_id == seat.flight_id &&
        seat.available == 1 &&
        seat.class == "business"
      );
    });
  });

  let alreadyTaken2 = new Set();
  let businessSeatsSet = [];

  for (let i = 0; i < businessSeats.length; i++) {
    const seat = businessSeats[i];
    if (alreadyTaken2.has(seat.flight_id)) {
      continue;
    }

    businessSeatsSet.push(seat);
    alreadyTaken2.add(seat.flight_id);
  }

  let alreadyTaken4 = new Set();
  let returnBusinessSeatsSet = [];

  for (let i = 0; i < returnBusinessSeats.length; i++) {
    const seat = returnBusinessSeats[i];
    if (alreadyTaken4.has(seat.flight_id)) {
      continue;
    }

    returnBusinessSeatsSet.push(seat);
    alreadyTaken4.add(seat.flight_id);
  }

  // ***************** Manage Seats *****************//

  const handleSortClick = (sortOption) => {
    setSort(sortOption);
    setDropdownVisible(false);
  };

  function handleConfirm() {
    // navigate(
    //   `/passengersform?tripetype=${tripType}&from=${fromCity}&to=${toCity}&departure_date=${departureDate}&return_date=${returnDate}&passengertype=${passengerType}`
    // );
    setOpen(true);
  }

  return (
    <div
      style={{
        flex: "70%",
        display: "flex",
        flexDirection: "column",
        gap: "20px",
      }}
    >
      {/* <div
        style={{ borderColor: `${dropdownVisible ? "black" : "gray"}` }}
        className="sort_flight_btn"
        onClick={() => setDropdownVisible(!dropdownVisible)}
      >
        <SortIcon />
        <span>Sort by : {sort}</span>
      </div>
      {dropdownVisible && (
        <div style={{ position: "absolute", zIndex: "9999" }}>
          <ul className="dropdown_list">
            <li
              style={{ padding: "5px", borderRadius: "10px" }}
              className={sort === "Price" ? "active" : ""}
              onClick={() => handleSortClick("Price")}
            >
              Price
            </li>
            <li
              style={{ padding: "5px", borderRadius: "10px" }}
              className={sort === "Time" ? "active" : ""}
              onClick={() => handleSortClick("Time")}
            >
              Time
            </li>
          </ul>
        </div>
      )} */}

      {tripType == "oneway" ? (
        <div>
          <span style={{ fontSize: "24px", fontWeight: "500" }}>
            Departing flights
          </span>
          {filteredFlightsData.length === 0 ? (
            <div className="not_available_flight_txt">
              <span style={{ fontSize: "24px", fontWeight: "300" }}>
                There is no flight for that day.
              </span>
            </div>
          ) : (
            <div>
              {!isDepartSelected && (
                <div>
                  {filteredFlightsData
                    .slice() // Create a copy of the array to avoid mutating the original
                    .sort((a, b) => {
                      if (sort === "Time") {
                        return a.depart_time.localeCompare(b.depart_time);
                      }
                      // Add additional sorting conditions if needed
                      return 0;
                    })
                    .map((flight, index) => (
                      <EachFlightContainer
                        flight={flight}
                        economySeats={economySeatsSet}
                        businessSeats={businessSeatsSet}
                        passengerType={passengerType}
                        isDepartSelected={isDepartSelected}
                        setIsDepartSelected={setIsDepartSelected}
                        isReturnSelected={isReturnSelected}
                        setIsReturnSelected={setIsReturnSelected}
                        setReturnDisplay={setReturnDisplay}
                        setLoading={setLoading}
                      />
                    ))}
                </div>
              )}
              {isDepartSelected && (
                <div style={{ display: "flex", justifyContent: "center" }}>
                  <SelectedTicketContainer
                    isDepartSelected={isDepartSelected}
                    isReturnSelected={false}
                    economySeats={economySeatsSet}
                    businessSeats={businessSeatsSet}
                    passengerType={passengerType}
                  />
                </div>
              )}
            </div>
          )}
        </div>
      ) : (
        <div>
          <div>
            <span style={{ fontSize: "24px", fontWeight: "500" }}>
              Departing flights
            </span>
            {filteredFlightsData.length === 0 ? (
              <div className="not_available_flight_txt">
                <span style={{ fontSize: "24px", fontWeight: "300" }}>
                  There is no flight for that day.
                </span>
              </div>
            ) : (
              <div>
                {!isDepartSelected && (
                  <div>
                    {filteredFlightsData
                      .slice() // Create a copy of the array to avoid mutating the original
                      .sort((a, b) => {
                        if (sort === "Time") {
                          return a.depart_time.localeCompare(b.depart_time);
                        }
                        // Add additional sorting conditions if needed
                        return 0;
                      })
                      .map((flight, index) => (
                        <EachFlightContainer
                          flight={flight}
                          economySeats={economySeatsSet}
                          businessSeats={businessSeatsSet}
                          passengerType={passengerType}
                          isDepartSelected={isDepartSelected}
                          setIsDepartSelected={setIsDepartSelected}
                          isReturnSelected={isReturnSelected}
                          setIsReturnSelected={setIsReturnSelected}
                          setReturnDisplay={setReturnDisplay}
                          setLoading={setLoading}
                        />
                      ))}
                  </div>
                )}
                {isDepartSelected && (
                  <div style={{ display: "flex", justifyContent: "center" }}>
                    <SelectedTicketContainer
                      isDepartSelected={isDepartSelected}
                      isReturnSelected={false}
                      economySeats={economySeatsSet}
                      businessSeats={businessSeatsSet}
                      passengerType={passengerType}
                    />
                  </div>
                )}
              </div>
            )}
          </div>
          <div style={{ display: `${returnDisplay}` }}>
            <span style={{ fontSize: "24px", fontWeight: "500" }}>
              Returning flights
            </span>
            {filteredReturnFlightsData.length === 0 ? (
              <div className="not_available_flight_txt">
                <span style={{ fontSize: "24px", fontWeight: "300" }}>
                  There is no flight for that day.
                </span>
              </div>
            ) : (
              <div>
                {!isReturnSelected && (
                  <div>
                    {filteredReturnFlightsData
                      .slice() // Create a copy of the array to avoid mutating the original
                      .sort((a, b) => {
                        if (sort === "Time") {
                          return a.depart_time.localeCompare(b.depart_time);
                        }
                        // Add additional sorting conditions if needed
                        return 0;
                      })
                      .map((flight, index) => (
                        <EachFlightContainer
                          flight={flight}
                          economySeats={returnEconomySeatsSet}
                          businessSeats={returnBusinessSeatsSet}
                          passengerType={passengerType}
                          isDepartSelected={isDepartSelected}
                          setIsDepartSelected={setIsDepartSelected}
                          isReturnSelected={isReturnSelected}
                          setIsReturnSelected={setIsReturnSelected}
                          setReturnDisplay={setReturnDisplay}
                        />
                      ))}
                  </div>
                )}
                {isReturnSelected && (
                  <div style={{ display: "flex", justifyContent: "center" }}>
                    <SelectedTicketContainer
                      isDepartSelected={false}
                      isReturnSelected={isReturnSelected}
                      economySeats={returnEconomySeatsSet}
                      businessSeats={returnBusinessSeatsSet}
                      passengerType={passengerType}
                    />
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      )}
      <PassengerSelectDialog
        economySeats={economySeatsSet.length}
        businessSeats={businessSeatsSet.length}
        returnEconomySeats={returnEconomySeatsSet.length}
        returnBusinessSeats={returnBusinessSeatsSet.length}
        tripType={tripType}
        fromCity={fromCity}
        toCity={toCity}
        departureDate={departureDate}
        returnDate={returnDate}
        passengerType={passengerType}
        username={username}
      />
      {tripType === "oneway" && isDepartSelected && (
        <button
          style={{
            fontSize: "18px",
            width: "200px",
            alignSelf: "flex-end",
            fontWeight: "bold",
            marginRight: "80px",
            color: "white",
          }}
          className="search_trip_btn"
          onClick={handleConfirm}
        >
          Confirm
        </button>
      )}

      {tripType === "roundtrip" && isDepartSelected && isReturnSelected && (
        <button
          style={{
            fontSize: "18px",
            width: "200px",
            alignSelf: "flex-end",
            fontWeight: "bold",
            marginRight: "80px",
            color: "white",
          }}
          className="search_trip_btn"
          onClick={handleConfirm}
        >
          Confirm
        </button>
      )}
    </div>
  );
}
