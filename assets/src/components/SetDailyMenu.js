import { __ } from '@wordpress/i18n';

const SetDailyMenu = () => {
	return (
		<div className={'wm-mt-4'}>
			<h1 className={'wm-text-gray-600 wm-text-base wm-font-semibold'}>{__( 'Search Meal:', 'we-meal' )}</h1>
		</div>
	);
};

export default SetDailyMenu;
