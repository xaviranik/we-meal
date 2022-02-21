import { __ } from '@wordpress/i18n';

const Orders = () => {
	return (
		<>
			<div className={'wm-px-8 wm-py-4'}>
				<h1 className={'wm-text-xl'}>{__('Orders', 'we-meal')}</h1>
			</div>
		</>
	);
};

export default Orders;
