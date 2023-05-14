import Avatar, { AvatarComponentProps } from "@/Components/Avatar";
import { PageProps } from "@/types";
import { faAngleDown } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Popover, Transition } from "@headlessui/react";
import { Link, usePage } from "@inertiajs/react";
import myLinks from "../../Links";
import LinkDropDown from "./Link.DropDown";

function DropDown() {
    const { url, props } = usePage<PageProps>(),
        { full_name, current_department, role } = props.auth.user;

    return (
        <>
            <Popover>
                {({ open }) => (
                    <>
                        <Popover.Button
                            className={`${
                                open ? "tw-bg-slate-400" : ""
                            } hover:tw-bg-slate-400 tw-p-2 tw-rounded-md tw-border-none tw-outline-none`}
                        >
                            <div
                                className={`tw-flex tw-justify-between tw-items-center tw-w-fit tw-h-fit tw-gap-1`}
                            >
                                <Avatar size={"md"} />
                                <FontAwesomeIcon
                                    className="tw-cursor-pointer"
                                    icon={faAngleDown}
                                />
                            </div>
                        </Popover.Button>

                        <Transition
                            show={open}
                            enter="transition duration-100 ease-out"
                            enterFrom="transform scale-95 opacity-0"
                            enterTo="transform scale-100 opacity-100"
                            leave="transition duration-75 ease-out"
                            leaveFrom="transform scale-100 opacity-100"
                            leaveTo="transform scale-95 opacity-0"
                        >
                            <Popover.Panel
                                className={
                                    "tw-absolute tw-top-[81px] tw-left-0 md:tw-left-1/2 tw-w-full md:tw-w-1/2 tw-flex tw-justify-end tw-bg-slate-200 tw-p-4 tw-shadow-md tw-shadow-slate-100 tw-flex-col tw-gap-2 md:tw-rounded-l-md tw-z-10"
                                }
                            >
                                <div className="tw-border-b tw-border-slate-100 tw-rounded-md tw-w-full tw-text-right tw-flex tw-h-fit tw-flex-col tw-pb-3 tw-gap-3">
                                    <h6 className="tw-text-xs tw-opacity-50">
                                        Manage settings
                                    </h6>
                                    {myLinks.dropDownNav.map(
                                        ({ to, textContent }, index) => {
                                            return (
                                                <LinkDropDown
                                                    to={to}
                                                    textContent={textContent}
                                                    key={index}
                                                />
                                            );
                                        }
                                    )}
                                </div>
                                <Link
                                    href="/logout"
                                    className={`tw-border-0 tw-p-2 hover:tw-bg-slate-400  tw-text-right`}
                                    as="button"
                                    method="post"
                                >
                                    Logout
                                </Link>

                                <span className="tw-block tw-w-full tw-text-right tw-text-xs tw-font-thin tw-italic tw-text-slate-100 tw-opacity-50 tw-capitalize">
                                    <p>{full_name}.</p>
                                    <p>
                                        {role}, {current_department}.
                                    </p>
                                </span>
                            </Popover.Panel>
                        </Transition>
                    </>
                )}
            </Popover>
        </>
    );
}

export default DropDown;