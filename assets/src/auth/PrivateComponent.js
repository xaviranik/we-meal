const PrivateRoute = ({ children, auth }) => {
	return auth ? children : null;
};

export default PrivateRoute;
