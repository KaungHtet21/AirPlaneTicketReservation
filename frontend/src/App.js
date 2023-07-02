import { Route, Routes } from "react-router-dom";
import "./App.css";
import HomeScreen from "./screens/HomeScreen";
import TicketSelectingScreen from "./screens/TicketSelectingScreen";
import PassengersFormSelectionScreen from "./screens/PassengersFormSelectionScreen";
import { PassengerProvider } from "./components/displayingflights/PassengerContext";
import PaymentScreen from "./screens/PaymentScreen";
import LoginScreen from "./screens/LoginScreen";
import Signup from "./components/signup/Signup";
import ProgramScreen from "./screens/ProgramScreen";
import ThankYouScreen from "./screens/ThankYouScreen";

function App() {
  return (
    <div className="App">
      <PassengerProvider>
        <Routes>
          <Route path="/" element={<LoginScreen/>} />
          <Route path="/signup" element={<Signup/>}/> 
          <Route path="/home" element={<HomeScreen />} />
          <Route path="/program" element={<ProgramScreen/>}/>
          <Route path="/ticketselect" element={<TicketSelectingScreen />} />
          <Route path="/passengersform" element={<PassengersFormSelectionScreen />} />
          <Route path="/paymentform" element={<PaymentScreen/> } />
          <Route path="/thankyou" element={<ThankYouScreen/> } />
        </Routes>
      </PassengerProvider>
    </div>
  );
}

export default App;
