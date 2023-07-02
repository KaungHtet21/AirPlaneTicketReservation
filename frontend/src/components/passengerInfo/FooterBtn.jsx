import React from "react";

export default function FooterBtn(props) {
  const { handleConfirm, passengers } = props;
  const totalPrice = passengers.reduce(
    (acc, passenger) => Number(acc) + Number(passenger.price),
    0
  );

  return (
    <div
      style={{
        display: "flex",
        justifyContent: "space-between",
        alignItems: "center",
        background: "#1E3D69",
        width: "100%",
        position: "fixed",
        zIndex: "9999",
        bottom: "0",
      }}
    >
      <div style={{ display: "flex", gap: "20px", padding: "30px" }}>
        <span style={{ fontSize: "18px", fontWeight: "500", color: "white" }}>
          Total :{" "}
        </span>
        <span style={{ fontSize: "18px", fontWeight: "500", color: "white" }}>
          {totalPrice}$
        </span>
      </div>
      <button
        style={{
          padding: "20px",
          background: "white",
          color: "black",
          border: "1px black solid",
          borderRadius: "10px",
          marginRight: "50px",
        }}
        onClick={handleConfirm}
      >
        Confirm
      </button>
    </div>
  );
}
