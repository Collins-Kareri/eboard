import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import Avatar from "@/Components/Avatar";
import Icon from "@/Components/Icon";
import { faPencilAlt, faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import SectionLayout from "@/Layouts/Section.Layout";

export default function Profile({}) {
    return (
        <RootLayout>
            <Head title="Profile" />
            <SectionLayout
                title={"Profile"}
                description={"Edit your profile information"}
            >
                <div className="tw-flex tw-gap-2 tw-items-start tw-justify-center tw-flex-col">
                    <Avatar size="xl" />
                    <section className="tw-flex tw-h-fit tw-justify-center tw-items-center tw-gap-2">
                        <button className="tw-flex tw-items-center tw-border-[1px] tw-border-slate-100 tw-px-4 tw-py-2 tw-gap-2 tw-rounded-md tw-bg-slate-100 tw-shadow-sm hover:tw-shadow-slate-950 tw-ease-linear tw-duration-100 tw-transition-all">
                            <Icon
                                icon={faPencilAlt}
                                size="lg"
                                className="hover:tw-bg-transparent tw-p-0"
                            />
                            <span>select new photo</span>
                        </button>
                        <Icon
                            icon={faTrashAlt}
                            size="lg"
                            className="hover:tw-border-[1px] tw-border-slate-100 tw-px-4 tw-py-2 tw-gap-2 tw-rounded-md hover:tw-bg-slate-50 hover:tw-shadow-sm tw-shadow-slate-950 tw-ease-linear tw-duration-100 tw-transition-all"
                        />
                    </section>
                </div>

                <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                    <FormInputsLayout labelText={"name"} htmlFor="name">
                        <input
                            type="text"
                            id="name"
                            defaultValue={"John doe"}
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>
                    <FormInputsLayout labelText={"email"} htmlFor="email">
                        <input
                            type="email"
                            id="email"
                            defaultValue={"johnDoe@mail.com"}
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>
                </div>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                    <button className="tw-flex tw-items-center tw-border-[1px] tw-border-slate-400 tw-px-4 tw-py-2 tw-gap-2 tw-rounded-md tw-bg-slate-400 tw-shadow-md hover:tw-shadow-slate-900 tw-ease-linear tw-duration-100 tw-transition-all">
                        save changes
                    </button>
                </div>
            </SectionLayout>
            <SectionLayout
                title={"Security"}
                description={"Change your passwords"}
            >
                <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                    <FormInputsLayout
                        labelText={"current password"}
                        htmlFor="current_password"
                    >
                        <input
                            type="password"
                            id="current_password"
                            autoComplete="current-password"
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>
                    <FormInputsLayout
                        labelText={"new password"}
                        htmlFor="new_password"
                    >
                        <input
                            type="password"
                            id="new_password"
                            autoComplete="new-password"
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>
                    <FormInputsLayout
                        labelText={"confirm new password"}
                        htmlFor="confirm_new_password"
                    >
                        <input
                            type="password"
                            id="confirm_new_password"
                            autoComplete="new-password"
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>
                </div>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                    <button className="tw-flex tw-items-center tw-border-[1px] tw-border-slate-400 tw-px-4 tw-py-2 tw-gap-2 tw-rounded-md tw-bg-slate-400 tw-shadow-md hover:tw-shadow-slate-900 tw-ease-linear tw-duration-100 tw-transition-all">
                        save changes
                    </button>
                </div>
            </SectionLayout>
            <SectionLayout
                title={"Delete Account"}
                description={"Permanently delete your account"}
            >
                <p>
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted.
                </p>
                <button className="tw-flex tw-items-center tw-border-[1px] tw-border-red-400 tw-px-4 tw-py-2 tw-gap-2 tw-rounded-md tw-bg-red-400 tw-shadow-md hover:tw-shadow-slate-900 tw-ease-linear tw-duration-100 tw-transition-all">
                    delete account
                </button>
            </SectionLayout>
        </RootLayout>
    );
}
