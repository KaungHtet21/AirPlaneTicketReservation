import React, { useContext, useEffect, useState } from "react";
import SwiperCore, { Navigation, Pagination, Autoplay } from "swiper";
import "swiper/css";
import { Swiper, SwiperSlide } from "swiper/react";
import { PassengerContext } from "../displayingflights/PassengerContext";
import "./PassengerInfo.css";
import Input from "@mui/joy/Input";
import Radio from "@mui/joy/Radio";
import RadioGroup from "@mui/joy/RadioGroup";
import { CountryDropdown } from "react-country-region-selector";
import { datas } from "./NRCData";
import { ThemeProvider, createTheme } from "@mui/material/styles";

const theme = createTheme({
  palette: {
    background: {
      paper: '#fff',
    }
  }
})

SwiperCore.use([Navigation, Pagination, Autoplay]);

export default function PassengerInfoSlide(props) {
  const {
    tripType,
    title,
    showAlertMsg,
    setShowAlertMsg,
    setPassengers,
    passengers,
    ecoPrice,
    busiPrice,
    ecoReturnPrice,
    busiReturnPrice,
  } = props;

  const {
    numEconomyAdults,
    numEconomyChildren,
    numEconomyInfants,
    numBusinessAdults,
    numBusinessChildren,
    numBusinessInfants,
  } = useContext(PassengerContext);

  const [gender, setGender] = useState("Male");
  const [country, setCountry] = useState("Myanmar");
  const [documentType, setDocumentType] = useState("passport");
  const [cabin, setCabin] = useState("Economy");
  const [firstNameInput, setfirstNameInput] = useState("");
  const [lastNameInput, setLastNameInput] = useState("");
  const [dob, setDob] = useState("");
  const [documentData, setDocumentData] = useState("");
  const [member_code, setMember_code] = useState("");

  const [departEcoAdult, setDepartEcoAdult] = useState(0);
  const [departBusinessAdult, setDepartBusinessAdult] = useState(0);
  const [departEcoChildren, setDepartEcoChildren] = useState(0);
  const [departBusinessChildren, setDepartBusinessChildren] = useState(0);
  const [departEcoInfants, setDepartEcoInfants] = useState(0);
  const [departBusinessInfants, setDepartBusinessInfants] = useState(0);
  const [total, setTotal] = useState(0);

  const [error, setError] = useState(false);
  const [cabinError, setCabinError] = useState(false);
  const [nrcError, setNrcError] = useState(false);
  const [passportError, setPassportError] = useState(false);
  const [dobError, setDobError] = useState(false);
  const [nrcAlreadyExit, setNrcAlreadyExit] = useState(false);
  const [memberError, setMemberError] = useState(false);

  // Get members from backend
  const [members, setMembers] = useState([]);
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/getMembers")
      .then((response) => response.json())
      .then((data) => setMembers(data));
  }, []);

  useEffect(() => {
    setDepartEcoAdult(numEconomyAdults);
    setDepartBusinessAdult(numBusinessAdults);
    setDepartEcoChildren(numEconomyChildren);
    setDepartBusinessChildren(numBusinessChildren);
    setDepartEcoInfants(numEconomyInfants);
    setDepartBusinessInfants(numBusinessInfants);
  }, [
    setDepartEcoAdult,
    setDepartBusinessAdult,
    setDepartEcoChildren,
    setDepartBusinessChildren,
    setDepartEcoInfants,
    setDepartBusinessInfants,
  ]);

  useEffect(() => {
    if (showAlertMsg) {
      const timeout = setTimeout(() => {
        setShowAlertMsg(false);
      }, 3000);

      return () => clearTimeout(timeout);
    }
  }, [showAlertMsg]);

  useEffect(() => {
    switch (title) {
      case "Adults":
        setTotal(departEcoAdult + departBusinessAdult);
        break;
      case "Children":
        setTotal(departEcoChildren + departBusinessChildren);
        break;
      case "Infants":
        setTotal(departEcoInfants + departBusinessInfants);
        break;
    }
  });

  function handleConfirm() {
    if (
      firstNameInput.length == 0 ||
      lastNameInput.length == 0 ||
      dob.length == 0 
    ) {
      if (title != "Infants" && documentData.length == 0 ) {
        setError(true);
      }
    } else {
      const isValid = validateInput(documentData);
      if (!isValid && title != "Infants") {
        if (documentType == "passport") {
          setPassportError(true);
          setNrcError(false);
        } else {
          setNrcError(true);
          setPassportError(false);
        }
      } else {
        setNrcError(false);
        setPassportError(false);
        setError(false);
        setNrcAlreadyExit(false);
        let isMember;
        if (member_code.length > 0) {
          const fullname = firstNameInput + " " + lastNameInput
          isMember = members.find(
            (member) =>
              (member.nrc == documentData || member.passport == documentData) &&
              member.member_code == member_code && member.passenger_name == fullname
          );

          if (!isMember) {
            setMemberError(true);
            return;
          } else {
            setMemberError(false);
          }
        }

        if (title == "Adults") {
          if (cabin == "Economy") {
            if (departEcoAdult > 0) {
              let price;
              if (tripType == "oneway") {
                if (isMember) {
                  let discount_rate;
                  switch (isMember.membership_tier) {
                    case "silver":
                      discount_rate = 0.05;
                      break;
                    case "gold":
                      discount_rate = 0.1;
                      break;
                    case "diamond":
                      discount_rate = 0.2;
                      break;
                  }
                  price = (
                    (ecoPrice / numEconomyAdults).toFixed(2) -
                    (ecoPrice / numEconomyAdults).toFixed(2) * discount_rate
                  ).toFixed(2);
                } else {
                  price = (ecoPrice / numEconomyAdults).toFixed(2);
                }
              } else {
                if (isMember) {
                  let discount_rate;
                  switch (isMember.membership_tier) {
                    case "silver":
                      discount_rate = 0.05;
                      break;
                    case "gold":
                      discount_rate = 0.1;
                      break;
                    case "diamond":
                      discount_rate = 0.2;
                      break;
                  }
                  price =
                    (
                      Number(ecoPrice / numEconomyAdults) +
                      Number(ecoReturnPrice / numEconomyAdults)
                    ).toFixed(2) -
                    (
                      Number(ecoPrice / numEconomyAdults) +
                      Number(ecoReturnPrice / numEconomyAdults)
                    ).toFixed(2) *
                      discount_rate;
                } else {
                  price = (
                    Number(ecoPrice / numEconomyAdults) +
                    Number(ecoReturnPrice / numEconomyAdults)
                  ).toFixed(2);
                }
              }
              insertPassengerObj(price);
              setDepartEcoAdult(departEcoAdult - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          } else {
            if (departBusinessAdult > 0) {
              let price;
              if (tripType == "oneway") {
                if (isMember) {
                  let discount_rate;
                  switch (isMember.membership_tier) {
                    case "silver":
                      discount_rate = 0.05;
                      break;
                    case "gold":
                      discount_rate = 0.1;
                      break;
                    case "diamond":
                      discount_rate = 0.2;
                      break;
                  }
                  price =
                    (busiPrice / numBusinessAdults).toFixed(2) -
                    (busiPrice / numBusinessAdults).toFixed(2) * discount_rate;
                } else {
                  price = (busiPrice / numBusinessAdults).toFixed(2);
                }
              } else {
                if (isMember) {
                  let discount_rate;
                  switch (isMember.membership_tier) {
                    case "silver":
                      discount_rate = 0.05;
                      break;
                    case "gold":
                      discount_rate = 0.1;
                      break;
                    case "diamond":
                      discount_rate = 0.2;
                      break;
                  }
                  price =
                    (
                      Number(busiPrice / numBusinessAdults) +
                      Number(busiReturnPrice / numBusinessAdults)
                    ).toFixed(2) -
                    (
                      Number(busiPrice / numBusinessAdults) +
                      Number(busiReturnPrice / numBusinessAdults)
                    ).toFixed(2) *
                      discount_rate;
                } else {
                  price = (
                    Number(busiPrice / numBusinessAdults) +
                    Number(busiReturnPrice / numBusinessAdults)
                  ).toFixed(2);
                }
              }
              insertPassengerObj(price);
              setDepartBusinessAdult(departBusinessAdult - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          }
        } else if (title == "Children") {
          if (cabin == "Economy") {
            if (departEcoChildren > 0) {
              let price;
              if (tripType == "oneway") {
                price = ecoPrice;
              } else {
                price = Number(ecoPrice) + Number(ecoReturnPrice);
              }
              insertPassengerObj(price);
              setDepartEcoChildren(departEcoChildren - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          } else {
            if (departBusinessChildren > 0) {
              let price;
              if (tripType == "oneway") {
                price = busiPrice;
              } else {
                price = Number(busiPrice) + Number(busiReturnPrice);
              }
              insertPassengerObj(price);
              setDepartBusinessChildren(departBusinessChildren - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          }
        } else if (title == "Infants") {
          if (cabin == "Economy") {
            if (departEcoInfants > 0) {
              insertPassengerObj(0);
              setDepartEcoInfants(departEcoInfants - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          } else {
            if (departBusinessInfants > 0) {
              insertPassengerObj(0);
              setDepartBusinessInfants(departBusinessInfants - 1);
              setCabinError(false);
              resetForm();
              setShowAlertMsg(true);
            } else {
              setCabinError(true);
            }
          }
        }
      }
    }
  }

  const validateInput = (input) => {
    if (documentType == "passport") {
      const passportRegex = /^[A-Z]{2}\d{6,7}$/;
      if (passportRegex.test(input)) {
        return true;
      }else{
        return false;
      }
    } else {
      //Define the validation criteria and regex pattern
      const regex = /^(\d+)\/([A-Za-z]+)\(N\)(\d{6})$/;

      // Validate the input against the regex pattern
      const match = input.match(regex);

      if (match) {
        const [, nrcCode, nameEn, sixDigits] = match;

        const isNrcPresent = passengers.some(
          (passenger) =>
            passenger.documentType !== "passport" &&
            passenger.documentData === input
        );

        if (isNrcPresent) {
          setNrcAlreadyExit(true);
          return !isNrcPresent;
        } else {
          setNrcAlreadyExit(false);
        }
        // Check if the input matches the data in the nrc datas
        const isValid = datas[0].data.some(
          (obj) =>
            obj.nrc_code === nrcCode &&
            obj.name_en.toUpperCase() === nameEn.toUpperCase()
        );

        return isValid;
      }
      return false;
    }
  };

  function resetForm() {
    setGender("Male");
    setCountry("Myanmar");
    setDocumentType("passport");
    setCabin("Economy");
    setfirstNameInput("");
    setLastNameInput("");
    setDob("");
    setDocumentData("");
  }

  function insertPassengerObj(price) {
    setPassengers((prev) => [
      ...prev,
      {
        firstName: firstNameInput,
        lastName: lastNameInput,
        dob,
        gender,
        country,
        documentType,
        documentData,
        cabin,
        price,
        memberCode: member_code,
      },
    ]);
  }

  const handleDob = (e) => {
    if (title == "Adults") {
      const selectedDate = new Date(e.target.value);
      const currentDate = new Date();
      const maxDate = new Date();
      maxDate.setFullYear(currentDate.getFullYear() - 12);
      if (selectedDate > maxDate) {
        setDobError(true);
        setDob("");
        return;
      } else {
        setDobError(false);
        setDob(e.target.value);
      }
    } else if (title == "Children") {
      const selectedDate = new Date(e.target.value);
      const currentDate = new Date();
      const maxDate = new Date();
      const minDate = new Date();
      maxDate.setFullYear(currentDate.getFullYear() - 12);
      minDate.setFullYear(currentDate.getFullYear() - 3);
      if (selectedDate < maxDate || selectedDate > minDate) {
        // Handle invalid date (over 12 years for children)
        setDobError(true);
        setDob("");
        // You can show an error message or take appropriate action here
        console.log("Max date for children ", maxDate);
        console.log("Min date for children ", minDate);
        console.log("Invalid children age");
        return;
      } else {
        setDobError(false);
        setDob(e.target.value);
        console.log("Valid children age");
      }
    } else if (title == "Infants") {
      const selectedDate = new Date(e.target.value);
      const currentDate = new Date();
      const maxDate = new Date();
      maxDate.setFullYear(currentDate.getFullYear() - 3);
      if (selectedDate < maxDate) {
        // Handle invalid date
        setDobError(true);
        setDob("");
        console.log("Max date for infants ", maxDate);
        console.log("Invalid infants age");
        return;
      } else {
        setDobError(false);
        setDob(e.target.value);
        console.log("Valid infants age");
      }
    }
  };

  return (
    <div className="passenger_swiper_container">
      <Swiper
        modules={[Pagination]}
        navigation
        pagination={{ clickable: true }}
      >
        {Array.from({ length: total }, (_, index) => (
          <SwiperSlide key={index}>
            <div className="passenger_slide_container">
              <h3>{title}</h3>
              <div style={{ display: "flex", gap: "20px" }}>
                <input
                  id="first_name_input"
                  placeholder="First Name"
                  value={firstNameInput}
                  onChange={(e) => setfirstNameInput(e.target.value)}
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

              <span style={{ fontSize: "18px", fontWeight: "400" }}>
                Date of birth
              </span>
              <div style={{ display: "flex", gap: "20px" }}>
                <Input
                  type="date"
                  slotProps={{
                    input: {
                      min: "2018-06-07T00:00",
                      max: "2018-06-14T00:00",
                    },
                  }}
                  width="200px"
                  value={dob}
                  onChange={handleDob}
                />
                <RadioGroup
                  orientation="horizontal"
                  value={gender}
                  onChange={(event) => setGender(event.target.value)}
                  sx={{
                    minHeight: 48,
                    padding: "4px",
                    borderRadius: "md",
                    bgcolor: "#0d49bf",
                    "--RadioGroup-gap": "4px",
                    "--Radio-actionRadius": "8px",
                  }}
                >
                  {["Male", "Female"].map((item) => (
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
                        color: gender === item ? "black" : "white",
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

                <CountryDropdown
                  value={country}
                  onChange={(val) => setCountry(val)}
                />
              </div>
              <div style={{ display: "flex", gap: "20px" }}>
                {title != "Infants" && 
                <select
                  value={documentType}
                  onChange={(e) => {
                    setDocumentType(e.target.value);
                  }}
                  style={{ padding: "10px", fontSize: "16px", width: "150px" }}
                >
                  <option value="passport">Passport</option>
                  {/* <option value="nrc">National ID</option> */}
                  {country === "Myanmar" ? (
                    <option value="nrc">National ID</option>
                  ) : null}
                </select>}

                {title != "Infants" && 
                <input
                  value={documentData}
                  onChange={(e) => setDocumentData(e.target.value)}
                  placeholder={
                    documentType == "passport"
                      ? "Passport No."
                      : "1/AHGAYA(N)123456"
                  }
                />}
                <RadioGroup
                  orientation="horizontal"
                  value={cabin}
                  onChange={(event) => setCabin(event.target.value)}
                  sx={{
                    minHeight: 48,
                    padding: "4px",
                    borderRadius: "md",
                    bgcolor: "#0d49bf",
                    "--RadioGroup-gap": "4px",
                    "--Radio-actionRadius": "8px",
                  }}
                >
                  {["Economy", "Business"].map((item) => (
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
                        color: cabin === item ? "black" : "white",
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
              </div>
              {title == "Adults" && (
                <input
                  type="text"
                  value={member_code}
                  onChange={(e) => setMember_code(e.target.value)}
                  style={{ width: "200px", padding: "10px" }}
                  placeholder="Member code(optional)"
                />
              )}
              {error && !nrcError && !passportError && (
                <div style={{ color: "red" }}>*We need all informations</div>
              )}
              {nrcError && !nrcAlreadyExit && (
                <div style={{ color: "red" }}>*Nrc format is wrong.</div>
              )}
              {passportError && (
                <div style={{ color: "red" }}>*Passport format is wrong.</div>
              )}
              {nrcAlreadyExit && (
                <div style={{ color: "red" }}>*This nrc is already filled.</div>
              )}
              {cabinError && <div style={{ color: "red" }}>*Class error</div>}
              {dobError && title === "Adults" && (
                <div style={{ color: "red" }}>
                  *Adults must be over 12 years old.
                </div>
              )}
              {dobError && title === "Children" && (
                <div style={{ color: "red" }}>
                  *Children must be under 12 years old.
                </div>
              )}
              {dobError && title === "Infants" && (
                <div style={{ color: "red" }}>
                  *Infants must be under 3 years old.
                </div>
              )}
              {memberError && (
                <div style={{ color: "red" }}>*Wrong member code</div>
              )}
              <div style={{ display: "flex" }}>
                <button
                  className="passenger_confirm_btn"
                  onClick={handleConfirm}
                >
                  Confirm
                </button>
              </div>
            </div>
          </SwiperSlide>
        ))}
      </Swiper>
    </div>
  );
}
