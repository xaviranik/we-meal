import { __ } from '@wordpress/i18n';
import MealMenuCard from "./MealMenuCard";
import apiFetch from "@wordpress/api-fetch";
import AsyncSelect from 'react-select/async';
import { useState } from '@wordpress/element';

const SetDailyMenu = () => {
	const [searchedMeal, setSearchedMeal] = useState([]);

	const loadOptions = (inputValue, callback) => {
		if ( inputValue && inputValue.length > 0 ) {
			apiFetch( { path: `/wemeal/v1/meals?search=${inputValue}`, method: 'GET' } )
				.then((response) => {
					setSearchedMeal(response);

					const meals = response.map(d => ({
						"value" : d.id,
						"label" : d.name
					}));

					return callback(meals);
				} );
		}
	};

	return (
		<div className={'wm-mt-4'}>
			<h1 className={'wm-text-gray-600 wm-text-sm wm-font-medium'}>{__( 'Search Meal:', 'we-meal' )}</h1>

			<div className={'wm-mt-2'}>
				<AsyncSelect isMulti defaultOptions loadOptions={loadOptions} />
			</div>

			<MealMenuCard mealMenu={ {name: 'test meal', description: 'test description', formatted_price: '120'} } />

			<button onClick={() => {}} className={`wm-button-primary wm-mt-4`}>{__( 'Set Daily Menu', 'we-meal' )}</button>
		</div>
	);
};

export default SetDailyMenu;
