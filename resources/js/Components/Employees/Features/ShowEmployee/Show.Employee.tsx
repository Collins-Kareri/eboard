import { useState, Fragment } from "react";
import { EmployeesProps } from "../../EmployeesList";
import Icon from "@/Components/Icon";
import {
    faAngleLeft,
    faAngleRight,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";
import { Dialog, Transition } from "@headlessui/react";
import EditEmployee from "@/Components/Employees/Features/Edit.Employee";
import BodyContent from "@/Components/Employees/Features/ShowEmployee/BodyContent";

function ShowEmployee({ employee }: { employee: EmployeesProps }) {
    const [isOpen, setIsOpen] = useState(false),
        [data, setData] = useState({}),
        [featureState, setFeatureState] = useState<"show" | "edit">("show");

    return (
        <>
            <Icon icon={faAngleRight} onClick={() => setIsOpen(true)} />
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
                        className="tw-fixed tw-inset-0 tw-bg-black/70 tw-z-20"
                        aria-hidden="true"
                    />

                    {/* Full-screen container to center the panel */}
                    <div className="tw-fixed tw-flex tw-z-30 tw-right-0 tw-top-0 lg:tw-w-1/2 tw-w-full tw-h-screen">
                        {/* The actual dialog panel  */}
                        <Dialog.Panel className="tw-mx-auto tw-bg-slate-200 tw-p-6 tw-rounded-lg tw-w-full tw-flex tw-flex-col tw-gap-4">
                            <Dialog.Title
                                className={`tw-flex ${
                                    featureState === "edit"
                                        ? "tw-justify-start tw-gap-2"
                                        : "tw-justify-between"
                                } tw-items-center tw-w-full tw-relative tw-capitalize`}
                            >
                                {featureState === "edit" ? (
                                    <Icon
                                        icon={faAngleLeft}
                                        onClick={() => setFeatureState("show")}
                                        className="tw-bg-slate-400"
                                    />
                                ) : (
                                    <></>
                                )}
                                <h1 className="tw-text-lg tw-font-bold">
                                    {featureState === "show"
                                        ? "employee details"
                                        : "edit employee"}
                                </h1>
                                {featureState === "show" ? (
                                    <Icon
                                        icon={faXmark}
                                        onClick={() => setIsOpen(false)}
                                    />
                                ) : (
                                    <></>
                                )}
                            </Dialog.Title>

                            {featureState === "show" ? (
                                <BodyContent
                                    employee={employee}
                                    setFeatureState={setFeatureState}
                                />
                            ) : (
                                <EditEmployee employee={employee} />
                            )}
                        </Dialog.Panel>
                    </div>
                </Dialog>
            </Transition>
        </>
    );
}

export default ShowEmployee;
