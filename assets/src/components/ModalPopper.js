import Modal from 'react-responsive-modal';

const ModalPopper = ({ openModal, closeModal, title, content }) => {
	return (
		<Modal
			open={openModal}
			onClose={closeModal}
			classNames={{ modal: 'wm-rounded-md wm-w-80 md:wm-w-256' }}
			center
		>
			<h1 className={'wm-text-xl wm-font-semibold'}>{title}</h1>
			<hr className={'wm-mt-4 -wm-mx-4'} />
			<div>{content}</div>
		</Modal>
	);
};

export default ModalPopper;
