import { __ } from '@wordpress/i18n';
import ModalPopper from './ModalPopper';
import { useContext } from '@wordpress/element';
import SetDailyMenu from './SetDailyMenu';
import PrivateComponent from '../auth/PrivateComponent';
import { AuthContext } from '../context/AuthContext';
import { ModalContext } from '../context/ModalContext';

const Header = () => {
	const { isMealManager } = useContext(AuthContext);
	const { openModal, setOpenModal } = useContext(ModalContext);

	const onOpenModal = () => setOpenModal(true);
	const onCloseModal = () => setOpenModal(false);

	return (
		<div
			className={
				'wm-bg-white wm-flex wm-items-center wm-h-16 wm-drop-shadow-sm wm-w-full'
			}
		>
			<div className={'wm-container wm-mx-auto'}>
				<div
					className={
						'wm-flex wm-items-center wm-justify-between md:wm-mx-8 wm-mx-6'
					}
				>
					<h1 className={'wm-text-xl wm-font-medium'}>weMeal</h1>
					<PrivateComponent auth={isMealManager}>
						<button
							onClick={onOpenModal}
							className={`wm-button-outline`}
						>
							{__('Set Daily Menu', 'we-meal')}
						</button>
					</PrivateComponent>
				</div>
			</div>

			<ModalPopper
				openModal={openModal}
				closeModal={onCloseModal}
				title={__('Set Daily Menu', 'we-meal')}
				content={<SetDailyMenu />}
			/>
		</div>
	);
};

export default Header;
