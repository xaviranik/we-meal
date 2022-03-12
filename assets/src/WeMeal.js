import { HashRouter as Router, Routes, Route } from 'react-router-dom';
import Dashboard from './pages/Dashboard';
import Reports from './pages/Reports';
import Orders from './pages/Orders';
import Header from './components/Header';
import PrivateRoute from './auth/PrivateRoute';
import NotFound404 from './pages/NotFound404';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import './style/main.scss';
import Api from './api';
import { useEffect, useState } from '@wordpress/element';

const WeMeal = () => {
	const [isMealManager, setIsMealManager] = useState(false);
	const [isLoading, setIsLoading] = useState(true);

	const checkCapability = () => {
		if (isLoading) {
			Api.get('capability').then((response) => {
				setIsMealManager(response.can_manage_meal);
				setIsLoading(false);
			});
		}
	};

	useEffect(() => {
		checkCapability();
		return () => {
			setIsLoading(false);
		};
	}, []);

	return (
		<>
			<Header auth={isMealManager} />
			<Router>
				<ToastContainer
					position="bottom-right"
					autoClose={4000}
					hideProgressBar={false}
					newestOnTop={false}
					closeOnClick
					rtl={false}
					pauseOnFocusLoss
					draggable
					pauseOnHover
				/>
				<Routes>
					<Route path="/dashboard" element={<Dashboard />} />
					<Route
						path="/reports"
						element={
							<PrivateRoute
								auth={isMealManager}
								isLoading={isLoading}
							>
								<Reports />
							</PrivateRoute>
						}
					/>
					<Route
						path="/orders"
						element={
							<PrivateRoute
								auth={isMealManager}
								isLoading={isLoading}
							>
								<Orders />
							</PrivateRoute>
						}
					/>
					<Route path="/404" element={<NotFound404 />} />
				</Routes>
			</Router>
		</>
	);
};

export default WeMeal;
