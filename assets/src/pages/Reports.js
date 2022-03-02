import { __ } from '@wordpress/i18n';

const Reports = () => {
	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-3'}>
				<div className={'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'}>
					<div className={'wm-card'}>
						<div className={'wm-flex-col wm-items-center wm-justify-center'}>
							<h1 className={'wm-text-xl wm-font-semibold'}>{__('Daily Overview', 'we-meal')}</h1>

							<span className={'wm-text-lg wm-mt-10'}>{__('Total Orders: ')}10</span>
						</div>
					</div>
				</div>
			</div>
		</>
	);
};

export default Reports;
