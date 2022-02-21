import {__} from "@wordpress/i18n";
import MealMenuCard from "./MealMenuCard";
import {useState, useEffect} from "@wordpress/element";

const DailyMenu = () => {
	const [mealMenus, setMealMenus] = useState([]);

	useEffect(() => {

	}, []);

	return (
		<>
			<div className={'wm-card'}>
				<div className={'wm-flex wm-items-center wm-justify-between'}>
					<h1 className={'wm-text-base wm-font-semibold'}>{__( "Today's Menu", 'we-meal' )}</h1>
					<button className={'wm-button-primary'}>{__( 'Place Order', 'we-meal' )}</button>
				</div>

				<MealMenuCard />
			</div>
		</>
	);
};

export default DailyMenu;

