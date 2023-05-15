import Logo from "@/Components/Logo";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Head, useForm } from "@inertiajs/react";
import { useState } from "react";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import handleTyping from "@/Handlers/handleTyping";

function Register({ email, role }: { email: string; role: boolean }) {
    const [passwordVisibility, setPasswordVisibility] = useState<
            "show" | "hide"
        >("hide"),
        { data, setData, errors, processing, post, clearErrors } = useForm({
            first_name: "",
            last_name: "",
            email: email,
            phone_number: "",
            job_title: "",
            address: "",
            password: "",
            role: role,
            remember: true,
        });

    function register(evt: React.FormEvent<HTMLFormElement>) {
        evt.preventDefault();
        post(route("register.store"), {
            onSuccess: () => clearErrors(),
        });
    }

    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Register" />
            <form
                className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2"
                onSubmit={register}
            >
                <Logo className="tw-w-full tw-text-center" />
                <h1 className="tw-capitalize tw-text-xl tw-font-bold">
                    Register
                </h1>

                <div className="tw-flex tw-items-center tw-gap-6">
                    <FormInputsLayout
                        labelText={"first name"}
                        htmlFor="first_name"
                        errors={errors.first_name}
                    >
                        <input
                            type="text"
                            id="first_name"
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                            value={data.first_name}
                        />
                    </FormInputsLayout>
                    <FormInputsLayout
                        labelText={"last name"}
                        htmlFor="last_name"
                        errors={errors.last_name}
                    >
                        <input
                            type="text"
                            id="last_name"
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                            value={data.last_name}
                        />
                    </FormInputsLayout>
                </div>

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
                        value={data.email}
                    />
                </FormInputsLayout>

                <div className="tw-flex tw-items-center tw-gap-6">
                    <FormInputsLayout
                        labelText={"phone number"}
                        htmlFor="phone_number"
                        errors={errors.phone_number}
                    >
                        <input
                            type="tel"
                            id="phone_number"
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                            value={data.phone_number}
                        />
                    </FormInputsLayout>
                    <FormInputsLayout
                        labelText={"job title"}
                        htmlFor="job_title"
                        errors={errors.job_title}
                    >
                        <input
                            type="text"
                            id="job_title"
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                            value={data.job_title}
                        />
                    </FormInputsLayout>
                </div>

                <FormInputsLayout
                    labelText={"password"}
                    htmlFor="password"
                    errors={errors.password}
                >
                    <section className="tw-flex tw-items-center tw-w-full tw-border tw-border-slate-950 tw-rounded-md tw-bg-slate-950">
                        <input
                            type={`${
                                passwordVisibility === "show"
                                    ? "text"
                                    : "password"
                            }`}
                            id="password"
                            name="password"
                            className="!tw-bg-transparent !tw-border-none tw-flex-1 focus:tw-ring-0"
                            onChange={(e) =>
                                handleTyping(
                                    e,
                                    data,
                                    errors,
                                    clearErrors,
                                    setData
                                )
                            }
                            value={data.password}
                            autoComplete="new-password"
                            required
                            placeholder="password"
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
                </FormInputsLayout>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4 tw-gap-2 tw-items-center">
                    <button className="primaryBtn" disabled={processing}>
                        Register
                    </button>
                </div>
            </form>
        </div>
    );
}

export default Register;
