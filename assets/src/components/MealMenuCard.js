const MealMenuCard = ({mealMenu, onClick, selected}) => {
	return (
		<>
			<div onClick={onClick} className={`wm-rounded-md wm-border-2 wm-border-slate-100 wm-shadow-sm wm-p-3 wm-mt-4 wm-cursor-pointer wm-transition-eo hover:wm-border-slate-600 ${ selected ? 'wm-bg-indigo-50' : ''}`}>
				<p className={'wm-font-semibold wm-text-lg'}>{mealMenu.name}</p>
				<div className={'wm-text-gray-600 wm-text-sm wm-mt-2'}>{mealMenu.description}</div>
				<p className={'wm-font-semibold wm-text-base wm-mt-6'}>{mealMenu.formatted_price}</p>
			</div>
		</>
	);
};

export default MealMenuCard;
