import { __ } from '@wordpress/i18n';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import Api from '../api';

const fetchEvents = (info, successCallback) => {
	Api.get(
		`reports/user/meal-calendar?start_date=${info.startStr.substring(
			0,
			10
		)}&end_date=${info.endStr.substring(0, 10)}`
	).then((response) => {
		successCallback(Array.prototype.slice.call(response));
	});
};

const MealCalendar = () => {
	return (
		<div className={'wm-card'}>
			<h1 className={'wm-text-xl wm-font-semibold'}>
				{__('Meal Calendar', 'we-meal')}
			</h1>

			<div className={'wm-mt-4'}>
				<FullCalendar
					plugins={[dayGridPlugin]}
					initialView="dayGridMonth"
					events={fetchEvents}
				/>
			</div>
		</div>
	);
};

export default MealCalendar;
