import Icon from "@/Components/Icon";
import { faBell, faXmark } from "@fortawesome/free-solid-svg-icons";
import { Dialog, Transition } from "@headlessui/react";
import { useState, Fragment } from "react";

function Notification() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <>
            <Icon icon={faBell} size="lg" onClick={() => setIsOpen(true)} />
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
                <Dialog
                    open={isOpen}
                    onClose={() => setIsOpen(false)}
                    className={
                        "tw-fixed tw-w-full tw-h-screen tw-bg-slate-50 tw-top-0 tw-left-0"
                    }
                >
                    <Dialog.Panel
                        className={
                            "tw-relative tw-w-11/12 tw-mx-auto tw-container tw-flex tw-flex-col tw-justify-center tw-items-center tw-py-4 tw-gap-4"
                        }
                    >
                        <div className="tw-w-full tw-flex tw-justify-end">
                            <Icon
                                icon={faXmark}
                                size="xl"
                                onClick={() => setIsOpen(false)}
                            />
                        </div>
                        <Dialog.Title className={"tw-text-xl"}>
                            Notifications
                        </Dialog.Title>
                    </Dialog.Panel>
                </Dialog>
            </Transition>
        </>
    );
}

export default Notification;
