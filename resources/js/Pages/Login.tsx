import Logo from "@/Components/Logo";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { useState } from "react";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import handleTyping from "@/Handlers/handleTyping";

function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword: boolean;
}) {
    const [passwordVisibility, setPasswordVisibility] = useState<
            "show" | "hide"
        >("hide"),
        { data, setData, errors, processing, post, clearErrors } = useForm({
            email: "",
            password: "",
            remember: true,
        });

    function login(evt: React.FormEvent<HTMLFormElement>) {
        evt.preventDefault();
        post(route("login.store"), {
            onSuccess: () => clearErrors(),
        });
    }

    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Login" />
            <form
                className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2"
                onSubmit={login}
            >
                <Logo className="tw-w-full tw-text-center" />
                <h1 className="tw-capitalize tw-text-xl tw-font-bold">Login</h1>

                <FormInputsLayout
                    labelText={"email"}
                    htmlFor="email"
                    errors={errors.email}
                >
                    <input
                        type="email"
                        id="email"
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
                        }
                    />
                </FormInputsLayout>

                <FormInputsLayout
                    labelText={"password"}
                    htmlFor="password"
                    errors={errors.password}
                >
                    <section className="tw-flex tw-items-center tw-w-full tw-border tw-border-slate-950 tw-rounded-md focus-within:!tw-ring focus-within:!tw-ring-slate-950 tw-bg-slate-950">
                        <input
                            type={`${
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }`}
                            id="password"
                            className="!tw-bg-transparent !tw-border-none focus:tw-ring-0 tw-flex-1"
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                        />
                        <span
                            className="tw-px-2 tw-py-1 tw-h-full tw-block tw-cursor-pointer hover:tw-bg-slate-900 tw-mr-2 tw-rounded-md"
                            onClick={() =>
                                togglePasswordVisibility(
                                    passwordVisibility,
                                    setPasswordVisibility
                                )
                            }
                        >
                            {passwordVisibility === "hide" ? "show" : "hide"}
                        </span>
                    </section>

                    <div className="tw-mt-2 tw-flex tw-justify-between">
                        <span className="tw-flex tw-items-center tw-w-fit tw-gap-2">
                            <input
                                type="checkbox"
                                className="tw-p-2"
                                checked={data.remember}
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
                            <p>Remember me.</p>
                        </span>

                        {canResetPassword && (
                            <Link
                                href={route("password.request")}
                                className="hover:tw-underline tw-w-fit tw-cursor-pointer hover:tw-underline-offset-8"
                                method="get"
                            >
                                Forgot password?
                            </Link>
                        )}
                    </div>
                </FormInputsLayout>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4 tw-gap-2 tw-items-center">
                    <button className="primaryBtn" disabled={processing}>
                        Login
                    </button>
                </div>
            </form>
        </div>
    );
}

export default Login;
