import { __ } from '@wordpress/i18n';
import DailyMenu from '../components/DailyMenu';
import MealCalendar from '../components/MealCalendar';
import Stat from '../components/Stat';

const Dashboard = () => {
	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-4'}>
				<div
					className={
						'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'
					}
				>
					<div className={'wm-col-span-1'}>
						<Stat />
						<div className={'wm-mt-4'}>
							<DailyMenu />
						</div>
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
