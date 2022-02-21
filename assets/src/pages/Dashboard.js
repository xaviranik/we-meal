import DailyMenu from '../components/DailyMenu';
import MealCalendar from '../components/MealCalendar';

const Dashboard = () => {
	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-3'}>
				<div className={'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'}>
					<div className={'wm-col-span-1'}>
						<DailyMenu />
					</div>
					<div className={'wm-col-span-1'}>
						<MealCalendar />
					</div>
				</div>
			</div>
		</>
	);
};

export default Dashboard;
