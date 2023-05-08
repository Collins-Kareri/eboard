import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import ProfileSectionLayout from "@/Layouts/ProfileSection.Layout";
import { useState } from "react";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import { Link, useForm } from "@inertiajs/react";

function UpdatePassword() {
    const [passwordVisibility, setPasswordVisibility] = useState<
            "show" | "hide"
        >("hide"),
        { data, setData, reset, put, processing } = useForm({
            current_password: "",
            password: "",
            password_confirmation: "",
        });

    function updatePassword(
        evt: React.MouseEvent<HTMLButtonElement, MouseEvent>
    ) {
        evt.preventDefault();

        put(route("password.update"), {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    }

    return (
        <ProfileSectionLayout
            title={"Security"}
            description={"Change your password"}
        >
            <form className="tw-w-full tw-flex tw-flex-col tw-gap-8">
                <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                    <FormInputsLayout
                        labelText={"current password"}
                        htmlFor="current_password"
                    >
                        <input
                            type={
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }
                            id="current_password"
                            autoComplete="current-password"
                            value={data.current_password}
                            onChange={(e) =>
                                setData("current_password", e.target.value)
                            }
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"new password"}
                        htmlFor="new_password"
                    >
                        <input
                            type={
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }
                            id="new_password"
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"confirm new password"}
                        htmlFor="confirm_new_password"
                    >
                        <input
                            type={
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }
                            id="confirm_new_password"
                            autoComplete="new-password"
                            value={data.password_confirmation}
                            onChange={(e) =>
                                setData("password_confirmation", e.target.value)
                            }
                        />
                    </FormInputsLayout>

                    <span className="tw-flex tw-items-center tw-w-fit tw-gap-2">
                        <input
                            type="checkbox"
                            className="tw-p-2"
                            onChange={() =>
                                togglePasswordVisibility(
                                    passwordVisibility,
                                    setPasswordVisibility
                                )
                            }
                        />
                        <p>Show password.</p>
                    </span>
                </div>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                    <button
                        className="primaryBtn"
                        disabled={processing}
                        onClick={updatePassword}
                    >
                        save changes
                    </button>
                </div>
            </form>
        </ProfileSectionLayout>
    );
}

export default UpdatePassword;
