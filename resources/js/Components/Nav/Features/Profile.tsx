import Avatar, { AvatarComponentProps } from "@/Components/Avatar";
import { faAngleDown } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Popover } from "@headlessui/react";
import { Link, usePage } from "@inertiajs/react";

function Profile({ avatarUrl, size }: AvatarComponentProps) {
    const { url } = usePage();

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
                                <Avatar avatarUrl={avatarUrl} size={size} />
                                <FontAwesomeIcon
                                    className="tw-cursor-pointer"
                                    icon={faAngleDown}
                                />
                            </div>
                        </Popover.Button>

                        <Popover.Panel
                            className={
                                "tw-absolute tw-top-[73px] tw-left-0 md:tw-right-4 tw-w-full md:tw-w-1/2 tw-flex tw-justify-end tw-bg-slate-200 tw-p-4 tw-shadow-md tw-shadow-slate-100 tw-flex-col tw-gap-2"
                            }
                        >
                            <div className="tw-border-b tw-border-slate-100 tw-rounded-md tw-w-full tw-text-right tw-flex tw-h-fit tw-flex-col tw-pb-2 tw-gap-1">
                                <h6 className="tw-text-xs tw-font-extralight">
                                    Manage settings
                                </h6>
                                <Link
                                    href="/profile"
                                    className={`tw-p-2 hover:tw-bg-slate-400 tw-rounded-md ${
                                        url === "/profile"
                                            ? "tw-bg-slate-400"
                                            : ""
                                    }`}
                                >
                                    Profile
                                </Link>
                            </div>
                            <Link
                                href="/logout"
                                className={`tw-p-2 hover:tw-bg-slate-400 tw-rounded-md tw-text-right`}
                                as="button"
                                method="post"
                            >
                                Logout
                            </Link>
                        </Popover.Panel>
                    </>
                )}
            </Popover>
        </>
    );
}

export default Profile;
