import React from 'react'
import master_card from "../../assets/master_card.png";
import visa_card from "../../assets/visa_card.jfif"

export default function AcceptedPayment() {
  return (
    <div style={{padding: "0 30px", marginBottom: "10px"}}>
        <h2 style={{marginBottom: "20px"}}>Accepted Payments</h2>
        <div style={{display: "flex", gap:  "10px"}}>
            <img style={{width: "80px", height: "40px"}} src={master_card} alt="" />
            <img style={{width: "80px", height: "40px"}} src={visa_card} alt="" />
        </div>
    </div>
  )
}
