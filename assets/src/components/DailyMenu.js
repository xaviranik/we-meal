import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import MealMenuCard from './MealMenuCard';
import { toast } from 'react-toastify';
import Api from '../api';

const DailyMenu = () => {
	const [mealMenus, setMealMenus] = useState(null);
	const [canPlaceOrder, setCanPlaceOrder] = useState(false);
	const [selectedMealMenu, setSelectedMealMenu] = useState(null);

	useEffect(() => {
		Api.get('menus').then((response) => {
			setMealMenus(response);
		});
	}, []);

	useEffect(() => {
		Api.get('orders/can-place').then((response) => {
			setCanPlaceOrder(response);
		});
	}, []);

	const handleMealMenuClick = (mealId) => {
		setSelectedMealMenu(mealId);
	};

	const handlePlaceOrderClick = () => {
		const orderData = {
			meal_id: selectedMealMenu,
		};
		if (selectedMealMenu) {
			Api.post('orders', orderData).then((response) => {
				if (response.success) {
					setSelectedMealMenu(null);
					toast.success(response.message);
				}
			});
		}
	};

	const renderMealMenus = () => {
		return mealMenus.map((mealMenu) => {
			return (
				<MealMenuCard
					key={mealMenu.id}
					mealMenu={mealMenu}
					selected={selectedMealMenu === mealMenu.id}
					onClick={() => handleMealMenuClick(mealMenu.id)}
				/>
			);
		});
	};

	const renderPlaceOrderButton = () => {
		if (canPlaceOrder) {
			return (
				<button
					className={`wm-button-primary ${
						selectedMealMenu ? '' : 'wm-disabled'
					}`}
					onClick={handlePlaceOrderClick}
				>
					{__('Place Order', 'we-meal')}
				</button>
			);
		}
		return (
			<button className="wm-button-primary wm-disabled">
				{__('Order Placed', 'we-meal')}
			</button>
		);
	};

	const mealMenuCardSkeleton = () => {
		return (
			<>
				<div className={'wm-card'}>
					<div
						className={'wm-flex wm-items-center wm-justify-between'}
					>
						<div
							className={
								'wm-h-5 wm-w-32 wm-bg-slate-200 wm-rounded'
							}
						/>
						<div
							className={
								'wm-h-8 wm-w-24 wm-bg-slate-200 wm-rounded'
							}
						/>
					</div>

					<div
						className={
							'wm-animate-pulse wm-border-2 wm-rounded-md wm-p-4 wm-mt-4 wm-border-slate-100'
						}
					>
						<div
							className={
								'wm-h-5 wm-w-32 wm-bg-slate-200 wm-rounded'
							}
						/>
						<div
							className={
								'wm-mt-2 wm-h-2 wm-w-32 wm-bg-slate-200 wm-rounded'
							}
						/>
						<div
							className={
								'wm-mt-6 wm-h-2 wm-w-32 wm-bg-slate-200 wm-rounded'
							}
						/>
					</div>
				</div>
			</>
		);
	};

	return (
		<>
			{mealMenus ? (
				<div className={'wm-card'}>
					<div
						className={'wm-flex wm-items-center wm-justify-between'}
					>
						<h1 className={'wm-text-xl wm-font-semibold'}>
							{__("Today's Menu", 'we-meal')}
						</h1>
						{renderPlaceOrderButton()}
					</div>

					{renderMealMenus()}
				</div>
			) : (
				mealMenuCardSkeleton()
			)}
		</>
	);
};

export default DailyMenu;
