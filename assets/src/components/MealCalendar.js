import {__} from "@wordpress/i18n";

const MealCalendar = () => {
	return (
		<div className={'wm-card'}>
			<h1 className={'wm-text-base wm-font-semibold'}>{__( 'Meal Calendar', 'we-meal' )}</h1>
		</div>
	);
};

export default MealCalendar;
