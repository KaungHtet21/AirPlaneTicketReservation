import React, { useContext, useEffect, useState } from "react";
import "./PaymentContainer.css";
import { PassengerContext } from "../displayingflights/PassengerContext";
import { useNavigate } from 'react-router-dom';

export default function PaymentContainer(props) {
  const navigate = useNavigate()
  const { passengers, contact, totalPrice, username } = props;
  const { selectedDepartFlight, selectedReturnFlight } =
    useContext(PassengerContext);
  const [cardNumber, setCardNumber] = useState("");
  const [cardPassword, setCardPassword] = useState("");
  const [headOffice, setHeadOffice] = useState("Yangon");
  const [payerName, setPayerName] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");

  const [cardError, setCardError] = useState(false)
  const [amountError, setAmountError] = useState(false)

  const [visas, setVisas ] = useState([])
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getVisas").then((response) => response.json()).then((data) => {setVisas(data)})
  }, [])

  const [masters, setMasters ] = useState([])
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getMasters").then((response) => response.json()).then((data) => {setMasters(data)})
  }, [])

  function handleConfirm(status) {
    if (status == "purchased") {
      const formattedCardNumber = cardNumber.replace(/\s/g, "");
      if (!(cardNumber.startsWith("3") || cardNumber.startsWith("4"))) {
        setCardError(true)
        setCardNumber("")
        setCardPassword("")
        return
      }else {
        // Master
        if (cardNumber.startsWith("3")) {
          const matchingCard = masters.find(
            (card) => card.card_number === formattedCardNumber && card.password === cardPassword
          )
          if (matchingCard) {
            if (matchingCard.balance < parseInt(totalPrice)) {
              setAmountError(true)
              setCardError(false)
              return
            }
          }else {
            setCardError(true)
            setCardNumber("")
            setCardPassword("")
            return
          }
        }
        // Visa
        if (cardNumber.startsWith("4")) {
          const matchingCard = visas.find(
            (card) => card.card_number === formattedCardNumber && card.password === cardPassword
          )
          if (matchingCard) {
            if (matchingCard.balance < parseInt(totalPrice)) {
              setAmountError(true)
              setCardError(false)
              return
            }
          }else {
            setCardError(true)
            setCardNumber("")
            setCardPassword("")
            return
          }
        }
      }
    }

    setAmountError(false)
    setCardError(false)
    const item = {
      selectedDepartFlight,
      selectedReturnFlight:
        selectedReturnFlight !== undefined ? selectedReturnFlight : null,
      passengers,
      contact,
      status,
      totalPrice,
      cardNumber,
      cardPassword,
      headOffice: status === "purchased" ? "" : headOffice,
      payerName,
      phoneNumber,
    };
    console.log("Item ", item);
    let result = fetch("http://127.0.0.1:8000/api/postPassengersInfo", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(item),
    })
      .then((response) => response.json())
      .then((data) => {
        // Handle the response from the backend
        console.log("Returning data from backend = ", data);
      })
      .catch((error) => {
        // Handle any errors that occurred during the request
        console.error(error);
      });
    console.log("Result ", result);
    navigate(`/thankyou?username=${username}`)
  }

  function formatCardNumber(cardNumber) {
    // Remove any non-numeric characters from the input
    const strippedNumber = cardNumber.replace(/\D/g, "");

    // Insert a space after every 4th character
    const formattedNumber = strippedNumber.replace(/(.{4})/g, "$1 ");

    // Return the formatted number
    return formattedNumber.trim();
  }

  function handleCardNumber(e) {
    const formattedValue = formatCardNumber(e.target.value);
    setCardNumber(formattedValue);
  }

  return (
    <div
      style={{
        display: "flex",
        justifyContent: "space-around",
        marginBottom: "30px",
      }}
    >
      <div className="payment_container">
        <div style={{ display: "flex", flexDirection: "column" }}>
          <span
            style={{
              fontSize: "20px",
              fontWeight: "500",
              marginBottom: "30px",
            }}
          >
            Credit Payment System
          </span>
          <span>You can use you master card or visa card.</span>
        </div>
        <div
          style={{
            display: "flex",
            flexDirection: "column",
            padding: "15px",
            gap: "20px",
          }}
        >
          <span style={{ fontSize: "20px", fontWeight: "bold" }}>
            Card Information
          </span>
          <input
            type="text"
            placeholder="0000-0000-0000-0000"
            value={cardNumber}
            onChange={handleCardNumber}
          />
          <input
            type="password"
            placeholder="password"
            value={cardPassword}
            onChange={(e) => setCardPassword(e.target.value)}
          />
          {cardError && <span style={{ color: "red" }}>*Invalid card number</span>}
          {amountError && <span style={{ color: "red" }}>*Insufficient amount</span>}
          <button
            onClick={(e) => handleConfirm("purchased")}
            style={{ padding: "10px", background: "#1E3D69", color: "white" }}
            disabled={cardNumber == "" || cardPassword == ""}
          >
            Confirm
          </button>
        </div>
      </div>
      <div className="payment_container">
        <div style={{ display: "flex", flexDirection: "column" }}>
          <span
            style={{
              fontSize: "20px",
              fontWeight: "500",
              marginBottom: "30px",
            }}
          >
            Over the counter
          </span>
          <span>
            You can choose your desired destination to make a payment.
          </span>
        </div>
        <div
          style={{
            display: "flex",
            flexDirection: "column",
            padding: "15px",
            gap: "20px",
          }}
        >
          <span style={{ fontSize: "20px", fontWeight: "bold" }}>
            Fill the form
          </span>
          <select
            style={{ width: "200px" }}
            value={headOffice}
            onChange={(e) => setHeadOffice(e.target.value)}
          >
            <option value="Yangon">Yangon Head Office</option>
            <option value="Mandalay">Mandalay Head Office</option>
            <option value="NyaungU">Nyaung U Head Office</option>
            <option value="Myitkyina">
              MyitKyiNa Head Office
            </option>
            <option value="Lashio">Lashio Head Office</option>
            <option value="Tachileik">Tachileik Head Office</option>
           
            <option value="Taunggyi">Taunggyi Head Office</option>
            <option value="Naypyitaw">Nay Pyi Taw Head Office</option>
            <option value="Loikaw">Loikaw Head Office</option>
          </select>
          <input
            type="text"
            placeholder="Payer Name"
            value={payerName}
            onChange={(e) => setPayerName(e.target.value)}
          />
          <input
            type="text"
            placeholder="Phone Number"
            value={phoneNumber}
            onChange={(e) => setPhoneNumber(e.target.value)}
          />
          <button
            onClick={(e) => handleConfirm("pending")}
            style={{ padding: "10px", background: "#1E3D69", color: "white" }}
            disabled={payerName == "" || phoneNumber == ""}
          >
            Confirm
          </button>
        </div>
      </div>
    </div>
  );
}