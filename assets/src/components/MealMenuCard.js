import {__} from "@wordpress/i18n";

const MealMenuCard = ({meal}) => {
	return (
		<>
			<div className={'wm-rounded-md wm-border-2 wm-border-slate-100 wm-shadow-sm wm-p-3 wm-mt-4 wm-cursor-pointer wm-transition-eo hover:wm-border-2 hover:wm-border-slate-600'}>
				<p className={'wm-font-semibold'}>{__( 'Package 1', 'we-meal' )}</p>
				<p className={'wm-text-gray-600 wm-mt-2'}>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, repellendus.</p>
				<p className={'wm-font-semibold wm-text-base wm-mt-6'}>&#2547;300.25</p>
			</div>
		</>
	);
};

export default MealMenuCard;
