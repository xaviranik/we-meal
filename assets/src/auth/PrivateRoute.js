import { Navigate } from "react-router-dom";

const PrivateRoute = ({ children, auth }) => {
	return auth ? children : <Navigate to="/404" />;
}

export default PrivateRoute;
