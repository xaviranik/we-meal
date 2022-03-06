const StatCard = ({title, subtitle, value, icon}) => {
	const Icon = icon;

	const StatCardSkeleton = () => {
		return(
			<div className={'wm-card'}>
				<div className={'wm-flex-col wm-items-center wm-justify-center wm-animate-pulse'}>
					<div className={'wm-h-5 wm-w-32 wm-bg-slate-200 wm-rounded'}/>

					<div className={'wm-mt-2 wm-h-2 wm-w-32 wm-bg-slate-200 wm-rounded'}/>

					<div className={'wm-mt-4 wm-flex wm-items-center wm-justify-between'}>
						<div className={'wm-h-10 wm-w-16 wm-bg-slate-200 wm-rounded'}/>
						<div className={'wm-bg-slate-200 wm-px-5 wm-py-5 wm-rounded-md'}/>
					</div>
				</div>
			</div>
		);
	}

	const content = () => {
		return(
			<div className={'wm-card'}>
				<div className={'wm-flex-col wm-items-center wm-justify-center'}>
					<h1 className={'wm-text-xl wm-font-semibold'}>{title}</h1>

					<span className={'wm-text-gray-600 wm-text-sm wm-font-thin wm-mt-6'}>{subtitle}</span>

					<div className={'wm-mt-4 wm-flex wm-items-center wm-justify-between'}>
						<h1 className={'wm-font-semibold wm-text-4xl'}>{value}</h1>
						<div className={'wm-bg-indigo-100 wm-px-5 wm-py-5 wm-rounded-md'}>
							<Icon />
						</div>
					</div>
				</div>
			</div>
		);
	}

	return value ? content() : StatCardSkeleton();
}

export default StatCard;
