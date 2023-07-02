import React, { createContext, useState } from "react";

const PassengerContext = createContext();

const PassengerProvider = ({ children }) => {
  const [numEconomyAdults, setNumEconomyAdults] = useState(0);
  const [numEconomyChildren, setNumEconomyChildren] = useState(0);
  const [numEconomyInfants, setNumEconomyInfants] = useState(0);
  const [numBusinessAdults, setNumBusinessAdults] = useState(0);
  const [numBusinessChildren, setNumBusinessChildren] = useState(0);
  const [numBusinessInfants, setNumBusinessInfants] = useState(0);

  const [open, setOpen] = useState(false);

  const [selectedEconomyPrice, setSelectedEconomyPrice] = useState(0)
  const [selectedBusinessPrice, setSelectedBusinessPrice] = useState(0)

  const [selectedReturnEconomyPrice, setSelectedReturnEconomyPrice] = useState(0)
  const [selectedReturnBusinessPrice, setSelectedReturnBusinessPrice] = useState(0)

  const [selectedDepartFlight, setSelectedDepartFlight] = useState()
  const [selectedReturnFlight, setSelectedReturnFlight] = useState()
  
  return (
    <PassengerContext.Provider
      value={{
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
        selectedDepartFlight,
        setSelectedDepartFlight,
        selectedReturnFlight,
        setSelectedReturnFlight,
        selectedEconomyPrice,
        setSelectedEconomyPrice,
        selectedBusinessPrice,
        setSelectedBusinessPrice,
        selectedReturnEconomyPrice,
        setSelectedReturnEconomyPrice,
        selectedReturnBusinessPrice,
        setSelectedReturnBusinessPrice,
      }}
    >
      {children}
    </PassengerContext.Provider>
  );
};

export { PassengerContext, PassengerProvider };
