import React, { useEffect, useState } from "react";
import Navbar from "../components/navbar/Navbar";
import silver from "../assets/member_silver.png";
import gold from "../assets/member_gold.png";
import diamond from "../assets/member_diamond.png";
import Tilt from "react-parallax-tilt";
import { useLocation } from "react-router-dom";

export default function ProgramScreen() {
  let location = useLocation();
    const [username, setUsername] = useState("");

    useEffect(() => {
        const searchParams = new URLSearchParams(location.search);
        setUsername(searchParams.get("username"))
    })
  return (
    <div>
      <Navbar username={username} />
      <div
        style={{ display: "flex", flexDirection: "column", padding: "10px" }}
      >
        <h3 style={{ fontStyle: "italic", marginTop: "100px" }}>
          AIR HORIZON PROGRAM
        </h3>
        <div
          style={{
            display: "flex",
            gap: "20px",
            justifyContent: "space-around",
          }}
        >
          {[silver, gold, diamond].map((item) => (
            <Tilt
              tiltMaxAngleX={20}
              tiltMaxAngleY={20}
              style={{
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
              }}
            >
              <img src={item} style={{ width: "400px", height: "250px" }} />
            </Tilt>
          ))}
        </div>
        <ul
          style={{
            paddingLeft: "100px",
            letterSpacing: "1px",
            paddingRight: "100px",
            paddingBottom: "20px",
          }}
        >
          <li>
            Membership Program: Frequent Flyer A flight membership program is a
            loyalty program offered by KAE airlines to reward frequent flyers.
            Members of these programs are offered special benefits, such as
            access to airport lounges, priority check-in, free baggage
            allowances, and the ability to earn and redeem points or miles for
            free flights or upgrades.
          </li>
          <li>
            One of the benefits that some flight membership programs offer is
            the ability to purchase a certain number of tickets in advance at a
            discounted price. For example, an airline may offer a membership
            program that allows members to purchase 10 tickets at a discounted
            rate, which can be used for future travel. As a member, you'll have
            access to exclusive benefits and rewards to enhance your travel
            experience. One of the key benefits of our program is the ability to
            purchase a specific number of tickets in advance at a discounted
            rate.
          </li>
          <li>
            Members can earn flight credits by booking flights through the
            online flight system. Every flight booked earns one flight credit,
            and once a member reaches the required number of flight credits,
            they are automatically upgraded to the next membership level.
            Membership is free; to keep the membership active, newly registered
            members need to fly at least once within the first six (6) months –
            if this no activity is recorded, then membership shall be
            automatically terminated.
          </li>
          <li>Membership Levels:</li>
          <li>
            Silver: Achieved after 10 flights, includes all benefits listed
            above
          </li>
          <li>
            Gold: Achieved after 25 flights, includes all benefits listed above
            plus an additional free flight ticket per year
          </li>
          <li>
            Platinum: Achieved after 50 flights, includes all benefits listed
            above plus an additional free flight ticket per year and access to
            airport lounges
          </li>
          <li>Silver Membership Benefits:</li>
          <li>
            Access to exclusive deals and discounts on flights, hotels, and car
            rentals Priority check-in at the airport Free seat selection and
            extra baggage allowance Early boarding privileges 24/7 customer
            support
          </li>
          <li>Gold Membership Benefits:</li>
          <li>
            All the benefits of silver membership, plus: Lounge access at select
            airports Priority baggage handling Complimentary upgrades to premium
            seats, when available Faster security checks at select airports
            Higher rewards points for each booking
          </li>
          <li>Platinum Membership Benefits :</li>
          <li>
            All the benefits of gold membership, plus: Guaranteed availability
            of seats, even during peak travel season Concierge service for
            personalized travel assistance Complimentary chauffeur service to
            and from the airport Personalized travel itineraries Exclusive
            access to private airport lounges
          </li>
        </ul>
      </div>
    </div>
  );
}
