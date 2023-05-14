import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import SettingSectionLayout from "@/Layouts/SettingSection.Layout";
import { useState } from "react";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import { useForm } from "@inertiajs/react";
import handleTyping from "@/Handlers/handleTyping";

function UpdatePassword() {
    const [passwordVisibility, setPasswordVisibility] = useState<
            "show" | "hide"
        >("hide"),
        { data, setData, reset, put, processing, errors, clearErrors } =
            useForm({
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
            errorBag: "updatePassword",
        });
    }

    return (
        <SettingSectionLayout
            title={"Security"}
            description={"Change your password"}
        >
            <form className="tw-w-full tw-flex tw-flex-col tw-gap-8">
                <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                    <FormInputsLayout
                        labelText={"current password"}
                        htmlFor="current_password"
                        errors={errors.current_password}
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
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"new password"}
                        htmlFor="password"
                        errors={errors.password}
                    >
                        <input
                            type={
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }
                            id="password"
                            autoComplete="new-password"
                            value={data.password}
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"confirm new password"}
                        htmlFor="password_confirmation"
                        errors={errors.password_confirmation}
                    >
                        <input
                            type={
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }
                            id="password_confirmation"
                            autoComplete="new-password"
                            value={data.password_confirmation}
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
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
        </SettingSectionLayout>
    );
}

export default UpdatePassword;
