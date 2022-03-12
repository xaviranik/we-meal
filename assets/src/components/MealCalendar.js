import { __ } from '@wordpress/i18n';
import FullCalendar from '@fullcalendar/react';
import dayGridPlugin from '@fullcalendar/daygrid';
import Api from '../api';
import { useState } from '@wordpress/element';

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
	const [hasLoading, setHasLoading] = useState(true);

	const loading = (isLoading) => {
		setHasLoading(isLoading);
	};

	const loadingContent = () => {
		return (
			<div>
				<div
					className={
						'wm-flex-col wm-items-center wm-justify-center wm-animate-pulse'
					}
				>
					<div
						className={'wm-h-5 wm-w-32 wm-bg-slate-200 wm-rounded'}
					/>
				</div>
			</div>
		);
	};

	return (
		<div className={'wm-card'}>
			{hasLoading ? (
				loadingContent()
			) : (
				<h1 className={'wm-text-xl wm-font-semibold'}>
					{__('Meal Calendar', 'we-meal')}
				</h1>
			)}

			<div className={'wm-mt-4'}>
				<FullCalendar
					plugins={[dayGridPlugin]}
					initialView="dayGridMonth"
					events={fetchEvents}
					loading={loading}
				/>
			</div>
		</div>
	);
};

export default MealCalendar;
