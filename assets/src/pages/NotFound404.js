import { __ } from '@wordpress/i18n';

const NotFound404 = () => {
	return (
		<div className={'wm-flex wm-items-center wm-justify-center wm-mx-4'}>
			<div
				className={
					'wm-card wm-mt-16 wm-flex-col wm-items-center wm-justify-center wm-text-center wm-p-8'
				}
			>
				<h1 className={'wm-text-6xl'}>
					4<span className={'wm-text-indigo-600'}>0</span>4
				</h1>
				<p className={'wm-text-xl wm-mt-8 wm-text-gray-600'}>
					{__(
						'The page you are looking for does not exists!',
						'we-meal'
					)}
				</p>
			</div>
		</div>
	);
};

export default NotFound404;
