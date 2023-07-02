import React, { useState } from "react";
import { PhoneInput } from "react-international-phone";
import "react-international-phone/style.css";

export default function ContactInfo(props) {
  const {
    setContactDisplay,
    setContact,
    setOpenEmailDialog,
    setEmailCode,
    firstNameInput,
    setFirstNameInput,
    lastNameInput,
    setLastNameInput,
    phone,
    setPhone,
    email,
    setEmail,
    address,
    setAddress,
    error,
    setError,
  } = props;

  function handleConfirm() {
    if (
      firstNameInput.length == 0 ||
      lastNameInput.length == 0 ||
      email.length == 0 ||
      phone.length == 0 ||
      address.length == 0
    ) {
      setError(true);
    } else {
      let code = Math.floor(Math.random() * 1000000);
      setEmailCode(code);
      console.log(code);
      setOpenEmailDialog(true);

      const item = { code, email }
      console.log("Item ", item);
    let result = fetch("http://127.0.0.1:8000/api/getEmailCode", {
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
      // const contact = {firstNameInput, lastNameInput, email, phone, address}
      // setContact(contact)
      // setError(false)
      // setContactDisplay(false)
    }
  }

  const validateEmailCode = () => { };

  return (
    <div style={{ width: "80%", marginBottom: "100px" }}>
      <h2>Contact Info</h2>
      <div className="passenger_slide_container">
        <div style={{ display: "flex", gap: "20px" }}>
          <input
            id="first_name_input"
            placeholder="First Name"
            value={firstNameInput}
            onChange={(e) => setFirstNameInput(e.target.value)}
            style={{ width: "200px", padding: "10px" }}
          />
          <input
            id="last_name_input"
            placeholder="Last Name"
            value={lastNameInput}
            onChange={(e) => setLastNameInput(e.target.value)}
            style={{ width: "200px", padding: "10px" }}
          />
        </div>

        <div style={{ display: "flex", gap: "20px" }}>
          <input
            type="email"
            placeholder="example@gmail.com"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            style={{ width: "200px", padding: "10px" }}
          />

          <PhoneInput
            defaultCountry="mm"
            value={phone}
            onChange={(phone) => setPhone(phone)}
          />
        </div>

        <input
          type="text"
          placeholder="Addrees"
          style={{ padding: "10px" }}
          value={address}
          onChange={(e) => setAddress(e.target.value)}
        />
        {error && <div style={{ color: "red" }}>*We need all informations</div>}
        <div style={{ display: "flex" }}>
          <button className="passenger_confirm_btn" onClick={handleConfirm}>
            Confirm
          </button>
        </div>
      </div>
    </div>
  );
}
