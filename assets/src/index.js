import { render } from '@wordpress/element';
import WeMeal from './WeMeal';
import menuFix from './utils/menu-fix';

render(<WeMeal />, document.getElementById('we-meal-app'));

menuFix('we-meal');
