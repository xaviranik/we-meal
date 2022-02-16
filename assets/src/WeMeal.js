import { HashRouter as Router, Routes, Route } from "react-router-dom";
import Dashboard from "./pages/Dashboard";
import Reports from "./pages/Reports";

const WeMeal = () => {
	return (
		<Router>
			<Routes>
				<Route path="/dashboard" element={<Dashboard/>} />
				<Route path="/reports" element={<Reports/>} />
			</Routes>
		</Router>
	);
};

export default WeMeal;
