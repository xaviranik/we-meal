import {__} from "@wordpress/i18n";
import ModalPopper from "./ModalPopper";
import { useState } from '@wordpress/element';
import SetDailyMenu from "./SetDailyMenu";

const Header = () => {
	const [open, setOpen] = useState(false);

	const onOpenModal = () => setOpen(true);
	const onCloseModal = () => setOpen(false);

	return (
		<div className={'wm-bg-white wm-flex wm-items-center wm-h-16 wm-drop-shadow-sm wm-w-full'}>
			<div className={'wm-container wm-mx-auto'}>
				<div className={'wm-flex wm-items-center wm-justify-between md:wm-mx-8 wm-mx-6'}>
					<h1 className={'wm-text-xl wm-font-medium'}>weMeal</h1>
					<button onClick={onOpenModal} className={`wm-button-outline`}>{__( 'Set Daily Menu', 'we-meal' )}</button>
				</div>
			</div>

			<ModalPopper openModal={open} closeModal={onCloseModal} title={__( 'Set Daily Menu', 'we-meal' )} content={<SetDailyMenu />} />

		</div>
	);
};

export default Header;
