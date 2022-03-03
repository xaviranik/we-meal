import { __ } from '@wordpress/i18n';

const Orders = () => {
	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-3'}>
				<div className={'wm-grid wm-grid-cols-1'}>
					<div className={'wm-card'}>
						<div className={'wm-flex-col wm-items-center wm-justify-center'}>
							<h1 className={'wm-text-xl wm-font-semibold'}>{__("Orders", 'we-meal')}</h1>

							<div className={'wm-mt-3'}>
								<div className="wm-overflow-x-auto -wm-mx-4">
									<div className="wm-py-2 min-w-full">
										<div className="overflow-hidden sm:wm-rounded-lg">
											<table className="wm-w-full">
												<thead className="wm-bg-indigo-50 wm-rounded-md">
												<tr className={'wm-uppercase'}>
													<th scope="col" className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
														#ID
													</th>
													<th scope="col" className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
														{__('Ordered by', 'we-meal')}
													</th>
													<th scope="col" className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
														{__('Meal', 'we-meal')}
													</th>
													<th scope="col" className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
														{__('Price', 'we-meal')}
													</th>
													<th scope="col" className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
														{__('Date', 'we-meal')}
													</th>
												</tr>
												</thead>
												<tbody>

												<tr key="1" className="wm-bg-white wm-border-b">
													<td className="wm-py-4 wm-px-6 wm-text-md wm-font-medium wm-text-gray-900 wm-whitespace-nowrap">
														1
													</td>
													<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
														Jon Snow
													</td>
													<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
														Beef Rice
													</td>
													<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
														$250
													</td>
													<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
														24-12-2019
													</td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</>
	);
};

export default Orders;
