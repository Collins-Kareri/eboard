import { Dialog, Transition } from "@headlessui/react";
import Icon from "@/Components/Icon";
import { faXmark } from "@fortawesome/free-solid-svg-icons";
import { PropsWithChildren, Fragment } from "react";

interface DialogBoxProps extends PropsWithChildren {
    isOpen: boolean;
    setIsOpen: React.Dispatch<React.SetStateAction<boolean>>;
    title: string;
}

function DialogBox({ isOpen, setIsOpen, children, title }: DialogBoxProps) {
    return (
        <Transition
            show={isOpen}
            enter="transition duration-100 ease-out"
            enterFrom="transform scale-95 opacity-0"
            enterTo="transform scale-100 opacity-100"
            leave="transition duration-75 ease-out"
            leaveFrom="transform scale-100 opacity-100"
            leaveTo="transform scale-95 opacity-0"
            as={Fragment}
        >
            <Dialog open={isOpen} onClose={() => setIsOpen(false)}>
                {/* The backdrop, rendered as a fixed sibling to the panel container */}
                <div
                    className="tw-fixed tw-inset-0 tw-bg-black/30"
                    aria-hidden="true"
                />

                {/* Full-screen container to center the panel */}
                <div className="tw-fixed tw-inset-0 tw-flex tw-items-center tw-justify-center tw-p-4">
                    {/* The actual dialog panel  */}
                    <Dialog.Panel className="tw-mx-auto tw-bg-slate-200 tw-p-6 tw-rounded-lg tw-w-11/12 tw-flex tw-flex-col tw-gap-4">
                        <Dialog.Title
                            className={
                                "tw-flex tw-justify-between tw-items-center tw-w-full tw-relative tw-capitalize"
                            }
                        >
                            <h1 className="tw-text-lg tw-font-bold">{title}</h1>
                            <Icon
                                icon={faXmark}
                                onClick={() => setIsOpen(false)}
                            />
                        </Dialog.Title>
                        {children}
                    </Dialog.Panel>
                </div>
            </Dialog>
        </Transition>
    );
}

export default DialogBox;
