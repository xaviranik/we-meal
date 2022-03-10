import { __ } from '@wordpress/i18n';
import { useEffect, useState } from '@wordpress/element';
import Api from '../api';
import StatCard from '../components/StatCard';

const Reports = () => {
	const [overview, setOverview] = useState({});

	useEffect(() => {
		Api.get('reports/order/overview').then((response) => {
			setOverview(response);
		});
	}, []);

	const totalOrderIcon = () => {
		return (
			<svg
				xmlns="http://www.w3.org/2000/svg"
				className="wm-h-7 wm-w-7 wm-text-indigo-400"
				data-name="Layer 1"
				viewBox="0 0 24 24"
				stroke="currentColor"
				fill="currentColor"
				strokeWidth="1"
			>
				<circle cx="7" cy="22" r="2" />
				<circle cx="17" cy="22" r="2" />
				<path d="M23.685 1.336a1 1 0 00-1.414 0L17.112 6.5l-1.551-1.619a1 1 0 00-1.442 1.386l1.614 1.679a1.872 1.872 0 001.345.6h.033a1.873 1.873 0 001.335-.553l5.239-5.243a1 1 0 000-1.414z" />
				<path d="M21.9 9.016a1 1 0 00-1.162.807l-.128.709A3 3 0 0117.657 13H5.418l-.94-8H11a1 1 0 000-2H4.242L4.2 2.648A3 3 0 001.222 0H1a1 1 0 000 2h.222a1 1 0 01.993.883l1.376 11.7A5 5 0 008.557 19H19a1 1 0 000-2H8.557a3 3 0 01-2.829-2h11.929a5 5 0 004.921-4.113l.128-.71a1 1 0 00-.806-1.161z" />
			</svg>
		);
	};

	const mealOrderedTodayIcon = () => {
		return (
			<svg
				xmlns="http://www.w3.org/2000/svg"
				className="wm-h-7 wm-w-7 wm-text-indigo-400"
				data-name="Layer 1"
				viewBox="0 0 24 24"
				stroke="currentColor"
				fill="currentColor"
				strokeWidth="1"
			>
				<path d="M1.333 7.238C.484 5.522-1.2 1.269 1.2.15a1.949 1.949 0 012.129.423l4.96 5.3A1 1 0 116.887 7.3L2 2.08c.119 3.777 2.343 6.6 4.841 9.439a1 1 0 01-1.39 1.446 24.522 24.522 0 01-4.118-5.727zM18.005 16.2a1.259 1.259 0 00-1.09-.4 8.055 8.055 0 01-3.458-.29.985.985 0 00-.981.254c-1.494 2.256 3.274 2.113 4.312 2.08l5.483 5.839a1 1 0 001.458-1.371zM15 14a4.99 4.99 0 003.536-1.462l5.171-5.172a1 1 0 10-1.414-1.416l-5.171 5.172a3 3 0 01-3.406.576l6.991-6.991a1 1 0 10-1.414-1.414L12.3 10.284a3 3 0 01.576-3.406l5.174-5.171A1 1 0 0016.636.293l-5.172 5.171a5.01 5.01 0 00-.635 6.293L.293 22.293a1 1 0 001.414 1.414l10.536-10.536A5 5 0 0015 14z" />
			</svg>
		);
	};

	return (
		<>
			<div className={'wm-container wm-mx-auto wm-px-6 wm-py-4'}>
				<div
					className={
						'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'
					}
				>
					<div
						className={
							'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'
						}
					>
						<StatCard
							title={__('Total Orders Today', 'we-meal')}
							subtitle={__('current day', 'we-meals')}
							value={
								overview?.total_order_count &&
								overview.total_order_count
							}
							icon={totalOrderIcon}
						/>

						<StatCard
							title={__('Most Ordered Today', 'we-meal')}
							subtitle={__('current day', 'we-meals')}
							value={'1'}
							icon={mealOrderedTodayIcon}
						/>
					</div>

					<div className={'wm-card'}>
						<h1 className={'wm-text-xl wm-font-semibold'}>
							{__('User Report', 'we-meal')}
						</h1>
					</div>

					<div className={'wm-card'}>
						<div
							className={
								'wm-flex-col wm-items-center wm-justify-center'
							}
						>
							<h1 className={'wm-text-xl wm-font-semibold'}>
								{__('Order Overview Today', 'we-meal')}
							</h1>

							<span
								className={
									'wm-text-gray-600 wm-text-md wm-font-thin wm-mt-6'
								}
							>
								{__('current day', 'we-meals')}
							</span>

							<div className={'wm-mt-4'}>
								<div className="wm-flex wm-flex-col">
									<div className="wm-overflow-x-auto -wm-mx-4">
										<div className="min-w-full">
											<div className="overflow-hidden sm:wm-rounded-lg">
												<table className="wm-w-full">
													<thead className="wm-bg-indigo-50 wm-rounded-md">
														<tr>
															<th
																scope="col"
																className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900"
															>
																{__(
																	'Meal',
																	'we-meal'
																)}
															</th>
															<th
																scope="col"
																className="wm-py-3 wm-px-6 wm-text-md wm-font-medium wm-tracking-wider wm-text-left wm-text-gray-900"
															>
																{__(
																	'Count',
																	'we-meal'
																)}
															</th>
														</tr>
													</thead>
													<tbody>
														{overview?.details &&
															overview.details.map(
																({
																	meal_id,
																	meal_name,
																	order_count,
																}) => {
																	return (
																		<tr
																			key={
																				meal_id
																			}
																			className="wm-bg-white wm-border-b"
																		>
																			<td className="wm-py-4 wm-px-6 wm-text-md wm-font-medium wm-text-gray-900 wm-whitespace-nowrap">
																				{
																					meal_name
																				}
																			</td>
																			<td className="wm-py-4 wm-px-6 wm-text-md wm-text-gray-900 wm-whitespace-nowrap">
																				{
																					order_count
																				}
																			</td>
																		</tr>
																	);
																}
															)}
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
			</div>
		</>
	);
};

export default Reports;
