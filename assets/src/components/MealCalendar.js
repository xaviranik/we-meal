import { __ } from '@wordpress/i18n';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';

const MealCalendar = () => {
	return (
		<div className={'wm-card'}>
			<h1 className={'wm-text-base wm-font-semibold'}>{__( 'Meal Calendar', 'we-meal' )}</h1>

			<div className={'wm-mt-4'}>
				<FullCalendar
					plugins={[ dayGridPlugin ]}
					initialView="dayGridMonth"
					events={[
						{ title: 'Rice Chicken', date: '2022-02-11' },
						{ title: 'Rice Beef', date: '2022-02-14' }
					]}
				/>
			</div>
		</div>
	);
};

export default MealCalendar;
