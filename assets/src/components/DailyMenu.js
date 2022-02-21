import { __ } from "@wordpress/i18n";
import apiFetch from "@wordpress/api-fetch";
import { useState, useEffect } from "@wordpress/element";
import MealMenuCard from "./MealMenuCard";

const DailyMenu = () => {
	const [mealMenus, setMealMenus] = useState([]);
	const [selectedMealMenu, setSelectedMealMenu] = useState(null);

	useEffect(() => {
		apiFetch( { path: '/wemeal/v1/menu' } )
			.then((response) => {
				setMealMenus(response);
			} );
	}, []);

	const handleMealMenuClick = (mealId) => {
		setSelectedMealMenu(mealId);
	};

	const handlePlaceOrderClick = () => {
		if (selectedMealMenu) {
			console.log('Place order clicked');
		}
	};

	const renderMealMenus = () => {
		return mealMenus.map( ( mealMenu ) => {
			return (
				<MealMenuCard
					key={mealMenu.id}
					mealMenu={mealMenu}
					selected={selectedMealMenu === mealMenu.id}
					onClick={() => handleMealMenuClick(mealMenu.id)}
				/>
			);
		} );
	};

	return (
		<>
			<div className={'wm-card'}>
				<div className={'wm-flex wm-items-center wm-justify-between'}>
					<h1 className={'wm-text-base wm-font-semibold'}>{__( "Today's Menu", 'we-meal' )}</h1>
					<button onClick={handlePlaceOrderClick} className={`wm-button-primary ${selectedMealMenu ? '' : 'wm-disabled'}`}>{__( 'Place Order', 'we-meal' )}</button>
				</div>

				{mealMenus && renderMealMenus()}
			</div>
		</>
	);
};

export default DailyMenu;

