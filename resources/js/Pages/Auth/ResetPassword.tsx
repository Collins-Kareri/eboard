import Logo from "@/Components/Logo";
import handleTyping from "@/Handlers/handleTyping";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import { Head, Link, useForm } from "@inertiajs/react";
import { useState } from "react";

function ResetPassword({ email, token }: { email: string; token: string }) {
    const [passwordVisibility, setPasswordVisibility] = useState<
            "show" | "hide"
        >("hide"),
        { data, setData, clearErrors, errors, processing, post } = useForm({
            password: "",
            password_confirmation: "",
            token: token,
            email: email,
        });

    function passwordReset(
        evt: React.MouseEvent<HTMLButtonElement, MouseEvent>
    ) {
        evt.preventDefault();
        post(route("password.store"));
    }

    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Reset password" />
            <form className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2">
                <input type="hidden" value={token} />
                <Logo className="tw-w-full tw-text-center" />
                <p className="tw-text-base tw-opacity-80">
                    Please enter a new password.
                </p>
                {errors.email || errors.token ? (
                    <span className="tw-text-red-400">
                        An error occurred while resetting your password.
                        <Link
                            href={route("password.request")}
                            className="tw-text-slate-50 tw-underline tw-underline-offset-8 tw-pl-1 tw-text-lg"
                        >
                            Click here
                        </Link>{" "}
                        to generate a new one.
                    </span>
                ) : (
                    <></>
                )}
                <FormInputsLayout
                    labelText="password"
                    htmlFor="password"
                    errors={errors.password}
                >
                    <input
                        type={
                            passwordVisibility === "show" ? "text" : "password"
                        }
                        id="password"
                        autoComplete="new-password"
                        value={data.password}
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
                        }
                    />
                </FormInputsLayout>
                <FormInputsLayout
                    labelText="confirm password"
                    htmlFor="password_confirmation"
                    errors={errors.password_confirmation}
                >
                    <input
                        type={
                            passwordVisibility === "show" ? "text" : "password"
                        }
                        id="password_confirmation"
                        autoComplete="new-password"
                        value={data.password_confirmation}
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
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

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4 tw-gap-2 tw-items-center">
                    <Link
                        href="/"
                        method="get"
                        as="button"
                        type="button"
                        className="secondaryBtn"
                        disabled={processing}
                    >
                        cancel
                    </Link>
                    <button
                        className="primaryBtn"
                        disabled={processing}
                        onClick={passwordReset}
                    >
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    );
}

export default ResetPassword;
