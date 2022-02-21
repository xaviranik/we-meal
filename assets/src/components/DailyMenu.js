import {__} from "@wordpress/i18n";
import apiFetch from "@wordpress/api-fetch";
import {useState, useEffect} from "@wordpress/element";
import MealMenuCard from "./MealMenuCard";

const DailyMenu = () => {
	const [mealMenus, setMealMenus] = useState([]);

	useEffect(() => {
		apiFetch( { path: '/wemeal/v1/menu' } )
			.then( ( response ) => {
				setMealMenus( response );
			} );
	}, []);

	return (
		<>
			<div className={'wm-card'}>
				<div className={'wm-flex wm-items-center wm-justify-between'}>
					<h1 className={'wm-text-base wm-font-semibold'}>{__( "Today's Menu", 'we-meal' )}</h1>
					<button className={'wm-button-primary'}>{__( 'Place Order', 'we-meal' )}</button>
				</div>

				{
					mealMenus && mealMenus.map( ( mealMenu ) => {
						return (
							<MealMenuCard
								key={mealMenu.id}
								mealMenu={mealMenu}
							/>
						);
					} )
				}
			</div>
		</>
	);
};

export default DailyMenu;

