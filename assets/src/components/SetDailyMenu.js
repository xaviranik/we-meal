import { __ } from '@wordpress/i18n';
import MealMenuCard from "./MealMenuCard";
import apiFetch from "@wordpress/api-fetch";
import AsyncSelect from 'react-select/async';
import { useState } from '@wordpress/element';

const SetDailyMenu = () => {
	const [ selectedMeals, setSelectedMeals ] = useState([]);

	const loadOptions = (inputValue, callback) => {
		if ( inputValue && inputValue.length > 0 ) {
			apiFetch( { path: `/wemeal/v1/meals?search=${inputValue}`, method: 'GET' } )
				.then((response) => {
					const meals = response.map(d => ({
						'value' : d.id,
						'label' : d.name,
						'formatted_price' : d.formatted_price,
						'description' : d.description,
					}));

					return callback(meals);
				} );
		}
	};

	const handleChange = (selectedOptions) => {
		setSelectedMeals(selectedOptions);
	}

	const handleSetDailyMealMenu = () => {
		const meals = selectedMeals.map(d => d.value);

		if ( meals.length > 0 ) {
			apiFetch( { path: `/wemeal/v1/menus`, method: 'POST', data: { meal_id: meals } } )
				.then((response) => {
					console.log(response);
				} );
		}
	}

	const renderMealMenus = () => {
		return selectedMeals.map( ( mealMenu ) => {
			return (
				<MealMenuCard
					key={mealMenu.value}
					mealMenu={{
						id: mealMenu.value,
						name: mealMenu.label,
						formatted_price: mealMenu.formatted_price,
						description: mealMenu.description,
					}}
				/>
			);
		} );
	};

	const renderNoMealSelectedContent = () => {
		return (
			<div className={'wm-card wm-bg-gray-100 wm-mt-4 wm-h-32 wm-flex wm-items-center wm-justify-center'}>
				<div className={'wm-flex wm-items-center'}>
					<svg xmlns="http://www.w3.org/2000/svg" className="wm-h-6 wm-w-6 wm-text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
					</svg>
					<p className={'wm-text-sm wm-text-gray-600 wm-ml-1'}>{__('Select meals to set daily menu.', 'we-meal')}</p>
				</div>
			</div>
		);
	}

	return (
		<div className={'wm-mt-4'}>
			<h1 className={'wm-text-gray-600 wm-text-sm wm-font-medium'}>{__( 'Search Meal:', 'we-meal' )}</h1>

			<div className={'wm-mt-2'}>
				<AsyncSelect onChange={handleChange}
							 closeMenuOnSelect={false}
							 autoFocus={true}
							 placeholder={__('Search meal')}
							 cacheOptions isMulti defaultOptions
							 loadOptions={loadOptions} />
			</div>

			{selectedMeals.length > 0 ? renderMealMenus() : renderNoMealSelectedContent()}

			<button onClick={handleSetDailyMealMenu} className={`wm-button-primary wm-mt-4 ${selectedMeals.length > 0 ? '' : 'wm-disabled'}`}>{__( 'Set Daily Menu', 'we-meal' )}</button>
		</div>
	);
};

export default SetDailyMenu;
