const MealMenuCard = ({mealMenu}) => {
	return (
		<>
			<div className={'wm-rounded-md wm-border-2 wm-border-slate-100 wm-shadow-sm wm-p-3 wm-mt-4 wm-cursor-pointer wm-transition-eo hover:wm-border-2 hover:wm-border-slate-600'}>
				<p className={'wm-font-semibold'}>{mealMenu.name}</p>
				{/*We are using dangerouslySetInnerHTML here as we are ensuring escaped data from API*/}
				<div className={'wm-text-gray-600 wm-mt-2'} dangerouslySetInnerHTML={{__html: mealMenu.description}} />
				<p className={'wm-font-semibold wm-text-base wm-mt-6'}>{mealMenu.formatted_price}</p>
			</div>
		</>
	);
};

export default MealMenuCard;
