import { HashRouter as Router, Routes, Route } from 'react-router-dom';
import Dashboard from './pages/Dashboard';
import Reports from './pages/Reports';
import Orders from './pages/Orders';
import Header from './components/Header';
import './style/main.scss';

const WeMeal = () => {
	return (
		<>
			<Header />
			<Router>
				<Routes>
					<Route path="/dashboard" element={<Dashboard />} />
					<Route path="/reports" element={<Reports />} />
					<Route path="/orders" element={<Orders />} />
				</Routes>
			</Router>
		</>
	);
};

export default WeMeal;
