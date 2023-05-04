import Logo from "@/Components/Logo";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Head, Link } from "@inertiajs/react";
import { useState } from "react";

function Login() {
    const [passwordVisibility, setPasswordVisibility] = useState<
        "show" | "hide"
    >("hide");

    function togglePasswordVisibility(
        evt: React.MouseEvent<HTMLInputElement, MouseEvent>
    ) {
        const el = evt.target as HTMLInputElement;
        if (el.checked) {
            setPasswordVisibility("show");
            return;
        }
        setPasswordVisibility("hide");
    }

    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Login" />
            <form className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2">
                <Logo className="tw-w-full tw-text-center" />
                <h1 className="tw-capitalize tw-text-xl tw-font-bold">Login</h1>
                <FormInputsLayout labelText={"email"} htmlFor="email">
                    <input type="email" id="email" />
                </FormInputsLayout>
                <FormInputsLayout labelText={"password"} htmlFor="password">
                    <input
                        type={`${
                            passwordVisibility === "show" ? "text" : "password"
                        }`}
                        id="password"
                    />
                    <div className="tw-mt-2 tw-flex tw-justify-between">
                        <span className="tw-flex tw-items-center tw-w-fit tw-gap-2">
                            <input
                                type="checkbox"
                                className="tw-p-2"
                                onClick={togglePasswordVisibility}
                            />
                            <p>Show password.</p>
                        </span>
                        <Link
                            href="/forgot/password"
                            className="hover:tw-underline tw-w-fit tw-cursor-pointer hover:tw-underline-offset-8"
                            method="get"
                            as="fragment"
                        >
                            Forgot password?
                        </Link>
                    </div>
                </FormInputsLayout>
                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4">
                    <Link
                        as="button"
                        className="primaryBtn"
                        href={"/login"}
                        method="post"
                    >
                        Login
                    </Link>
                </div>
            </form>
        </div>
    );
}

export default Login;
