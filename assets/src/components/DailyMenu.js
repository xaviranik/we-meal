import { __ } from "@wordpress/i18n";
import { useState, useEffect } from "@wordpress/element";
import MealMenuCard from "./MealMenuCard";
import Api from "../api";

const DailyMenu = () => {
	const [mealMenus, setMealMenus] = useState([]);
	const [canPlaceOrder, setCanPlaceOrder] = useState(false);
	const [selectedMealMenu, setSelectedMealMenu] = useState(null);

	useEffect(() => {
		Api.get( 'menus' )
			.then( ( response ) => {
				setMealMenus(response);
			} );
	}, []);

	useEffect(() => {
		Api.get( 'orders/can-place' )
			.then( ( response ) => {
				setCanPlaceOrder(response);
			} );
	}, []);

	const handleMealMenuClick = (mealId) => {
		setSelectedMealMenu(mealId);
	};

	const handlePlaceOrderClick = () => {
		const orderData = {
			meal_id: selectedMealMenu,
		};
		if (selectedMealMenu) {
			Api.post( 'orders', orderData )
				.then( ( response ) => {
					if (response.success) {
						setSelectedMealMenu(null);
					} else {
						console.log(response.message);
					}
			} );
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

	const renderPlaceOrderButton = () => {
		if (canPlaceOrder) {
			return (
				<button
					className={`wm-button-primary ${selectedMealMenu ? '' : 'wm-disabled'}`}
					onClick={handlePlaceOrderClick}
				>
					{__('Place Order', 'we-meal')}
				</button>
			);
		} else {
			return (
				<button
					className="wm-button-primary wm-disabled"
				>
					{__('Order Placed', 'we-meal')}
				</button>
			);
		}
	};

	return (
		<>
			<div className={'wm-card'}>
				<div className={'wm-flex wm-items-center wm-justify-between'}>
					<h1 className={'wm-text-base wm-font-semibold'}>{__( "Today's Menu", 'we-meal' )}</h1>
					{renderPlaceOrderButton()}
				</div>

				{mealMenus && renderMealMenus()}
			</div>
		</>
	);
};

export default DailyMenu;

