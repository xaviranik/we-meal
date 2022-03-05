import { __ } from '@wordpress/i18n';
import { useEffect, useState } from "@wordpress/element";
import Api from "../api";

const Orders = () => {
	const [orders, setOrders] = useState(null);

	useEffect(() => {
		Api.get('orders').then(response => {
			setOrders(response);
		});
	}, []);


	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-4'}>
				<div className={'wm-grid wm-grid-cols-1'}>
					<div className={'wm-card'}>
						<div className={'wm-flex-col wm-items-center wm-justify-center'}>
							<div className={'wm-flex wm-items-center wm-justify-between'}>
								<h1 className={'wm-text-xl wm-font-semibold'}>{__("Today's Orders", 'we-meal')}</h1>
							</div>

							{orders &&
								<div className={'wm-mt-3'}>
									<div className="wm-overflow-x-auto -wm-mx-4">
										<div className="wm-py-2 min-w-full">
											<div className="overflow-hidden sm:wm-rounded-lg">
												<table className="wm-w-full">
													<thead className="wm-bg-indigo-50 wm-rounded-md">
													<tr className={'wm-uppercase'}>
														<th scope="col"
															className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
															#ID
														</th>
														<th scope="col"
															className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
															{__('Ordered by', 'we-meal')}
														</th>
														<th scope="col"
															className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
															{__('Meal', 'we-meal')}
														</th>
														<th scope="col"
															className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
															{__('Price', 'we-meal')}
														</th>
														<th scope="col"
															className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900">
															{__('Date', 'we-meal')}
														</th>
													</tr>
													</thead>
													<tbody>
													{orders.map(order => {
														return (
															<tr key="1" className="wm-bg-white wm-border-b">
																<td className="wm-py-4 wm-px-6 wm-text-md wm-font-medium wm-text-gray-900 wm-whitespace-nowrap">
																	{order.id}
																</td>
																<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
																	{order.user_name}
																</td>
																<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
																	{order.meal_name}
																</td>
																<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
																	{order.formatted_price}
																</td>
																<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
																	{order.created_at}
																</td>
															</tr>
														);
													})}
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							}
						</div>
					</div>
				</div>
			</div>
		</>
	);
};

export default Orders;
