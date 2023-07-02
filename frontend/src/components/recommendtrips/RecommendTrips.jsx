import React from "react";
import { Recommendation } from "./Recommendation";
import "./RecommendTrips.css";

function RecommendTrips() {
  return (
    <div style={{ display: "flex", flexDirection: "column", padding: "10px"}}>
      <span
        style={{
          fontSize: "24px",
          fontWeight: "bold",
          fontStyle: "italic",
          marginLeft: "15px",
          marginBottom: "10px"
        }}
      >
        Recommended Places
      </span>
      <ul className="recommend_trips_grid">
        {Recommendation.map((trip, index) => {
          return (
            <div className="recommend_trips_card_container">
              <li key={index} style={{ height: "100%", width: "100%" }}>
                <img
                  src={trip.img_path}
                  alt=""
                  className="recommend_trips_card_img"
                />
                <div className="recommend_trips_card_img_overlay">
                  <span style={{fontSize: "18px"}}>{trip.from} &rArr;</span>
                  <span style={{fontSize: "28px", fontStyle: "italic"}}>{trip.to}</span>
                  <hr style={{width: "100%"}} />
                  <span style={{fontSize: "18px"}}>From ${trip.price}</span>
                </div>
              </li>
            </div>
          );
        })}
      </ul>
    </div>
  );
}

export default RecommendTrips;
