import {__} from "@wordpress/i18n";

const Dashboard = () => {
	return (
		<>
			<div className={'wm-px-8 wm-py-4'}>
				<h1 className={'wm-text-xl'}>{__( 'Dashboard', 'we-meal' )}</h1>
			</div>
		</>
	);
};

export default Dashboard;
