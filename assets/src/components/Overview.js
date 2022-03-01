import {__} from "@wordpress/i18n";

const Overview = () => {
	return(
		<div className={'wm-grid wm-grid-cols-1 md:wm-grid-cols-2 wm-gap-4'}>
			<div className={'wm-card'}>
				<div className={'wm-flex-col wm-items-center wm-justify-center'}>
					<h1 className={'wm-text-xl wm-font-semibold'}>{__('Total Meal Order', 'we-meal')}</h1>

					<span className={'wm-text-gray-600 wm-text-sm wm-font-thin wm-mt-6'}>{__('this month', 'we-meals')}</span>

					<div className={'wm-mt-4 wm-flex wm-items-center wm-justify-between'}>
						<h1 className={'wm-font-semibold wm-text-4xl'}>18</h1>
						<div className={'wm-bg-indigo-100 wm-px-5 wm-py-5 wm-rounded-md'}>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								className="wm-h-7 wm-w-7 wm-text-indigo-400"
								data-name="Layer 1"
								viewBox="0 0 24 24"
								stroke="currentColor"
								fill="currentColor"
								strokeWidth="1"
							>
								<path d="M1.333 7.238C.484 5.522-1.2 1.269 1.2.15a1.949 1.949 0 012.129.423l4.96 5.3A1 1 0 116.887 7.3L2 2.08c.119 3.777 2.343 6.6 4.841 9.439a1 1 0 01-1.39 1.446 24.522 24.522 0 01-4.118-5.727zM18.005 16.2a1.259 1.259 0 00-1.09-.4 8.055 8.055 0 01-3.458-.29.985.985 0 00-.981.254c-1.494 2.256 3.274 2.113 4.312 2.08l5.483 5.839a1 1 0 001.458-1.371zM15 14a4.99 4.99 0 003.536-1.462l5.171-5.172a1 1 0 10-1.414-1.416l-5.171 5.172a3 3 0 01-3.406.576l6.991-6.991a1 1 0 10-1.414-1.414L12.3 10.284a3 3 0 01.576-3.406l5.174-5.171A1 1 0 0016.636.293l-5.172 5.171a5.01 5.01 0 00-.635 6.293L.293 22.293a1 1 0 001.414 1.414l10.536-10.536A5 5 0 0015 14z"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
			<div className={'wm-card'}>
				<div className={'wm-flex-col wm-items-center wm-justify-center'}>
					<h1 className={'wm-text-xl wm-font-semibold'}>{__('Total Due', 'we-meal')}</h1>

					<span className={'wm-text-gray-600 wm-text-sm wm-font-thin wm-mt-6'}>{__('this month', 'we-meals')}</span>

					<div className={'wm-mt-4 wm-flex wm-items-center wm-justify-between'}>
						<h1 className={'wm-font-semibold wm-text-4xl'}>৳250</h1>
						<div className={'wm-bg-indigo-100 wm-px-5 wm-py-5 wm-rounded-md'}>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								className="wm-h-7 wm-w-7 wm-text-indigo-400"
								data-name="Layer 1"
								viewBox="0 0 24 24"
								stroke="currentColor"
								fill="currentColor"
								strokeWidth="1"
							>
								<path d="M24 23a1 1 0 01-1 1H1a1 1 0 010-2h22a1 1 0 011 1zM.291 8.552a2.443 2.443 0 01.153-2.566 4.716 4.716 0 011.668-1.5L9.613.582a5.174 5.174 0 014.774 0l7.5 3.907a4.716 4.716 0 011.668 1.5 2.443 2.443 0 01.153 2.566A2.713 2.713 0 0121.292 10H21v8h1a1 1 0 010 2H2a1 1 0 010-2h1v-8h-.292A2.713 2.713 0 01.291 8.552zM5 18h3v-8H5zm5-8v8h4v-8zm9 0h-3v8h3zM2.063 7.625A.717.717 0 002.708 8h18.584a.717.717 0 00.645-.375.452.452 0 00-.024-.5 2.7 2.7 0 00-.949-.864l-7.5-3.907a3.176 3.176 0 00-2.926 0l-7.5 3.907a2.712 2.712 0 00-.949.865.452.452 0 00-.026.499z"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}

export default Overview;
