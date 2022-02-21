import {__} from "@wordpress/i18n";

const Header = () => {
	return (
		<div className={'wm-bg-white wm-flex wm-items-center wm-h-16 wm-drop-shadow-sm wm-w-full'}>
			<div className={'wm-container wm-mx-auto'}>
				<div className={'wm-flex wm-items-center wm-justify-between md:wm-mx-8 wm-mx-6'}>
					<h1 className={'wm-text-xl wm-font-medium'}>weMeal</h1>
					<button onClick={() => {}} className={`wm-button-outline`}>{__( 'Set Daily Menu', 'we-meal' )}</button>
				</div>
			</div>
		</div>
	);
};

export default Header;
