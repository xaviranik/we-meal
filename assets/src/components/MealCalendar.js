import { __ } from '@wordpress/i18n';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';

const fetchEvents = (info, successCallback, failureCallback) => {
	successCallback(Array.prototype.slice.call([
		{
			title: 'event1',
			date: '2022-02-01',
		},
		{
			title: 'event2',
			date: '2022-02-02',
		},
		{
			title: 'event3',
			date: '2022-02-03',
		},
		{
			title: 'event4',
			date: '2022-02-04',
		},
		{
			title: 'event5',
			date: '2022-02-05',
		},
		{
			title: 'event8',
			date: '2022-02-08',
		},
		{
			title: 'event9',
			date: '2022-02-09',
		},
		{
			title: 'event10',
			date: '2022-02-10',
		},
		{
			title: 'event11',
			date: '2022-02-11',
		},
		{
			title: 'event12',
			date: '2022-02-12',
		},
		{
			title: 'event15',
			date: '2022-02-15',
		},
		{
			title: 'event16',
			date: '2022-02-16',
		},
		{
			title: 'event17',
			date: '2022-02-17'
		}
	] ));
}

const MealCalendar = () => {
	return (
		<div className={'wm-card'}>
			<h1 className={'wm-text-base wm-font-semibold'}>{__( 'Meal Calendar', 'we-meal' )}</h1>

			<div className={'wm-mt-4'}>
				<FullCalendar
					plugins={[ dayGridPlugin ]}
					initialView="dayGridMonth"
					events={fetchEvents}
				/>
			</div>
		</div>
	);
};

export default MealCalendar;
