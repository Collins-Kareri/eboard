import Logo from "@/Components/Logo";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Head, useForm } from "@inertiajs/react";
import { ComponentPropsWithoutRef, useState } from "react";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import handleTyping from "@/Handlers/handleTyping";

interface OnboardUserLayoutProps {
    email: string;
    route: string;
}

function OnboardUserLayout({ email, route }: OnboardUserLayoutProps) {
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
        });

    function register(evt: React.FormEvent<HTMLFormElement>) {
        evt.preventDefault();
        post(route, {
            onSuccess: () => clearErrors(),
        });
    }

    return (
        <form
            className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2"
            onSubmit={register}
        >
            <Logo className="tw-w-full tw-text-center" />
            <h1 className="tw-capitalize tw-text-xl tw-font-bold">Register</h1>

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
                            handleTyping(e, data, errors, clearErrors, setData)
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
                            handleTyping(e, data, errors, clearErrors, setData)
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
                            handleTyping(e, data, errors, clearErrors, setData)
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
                            handleTyping(e, data, errors, clearErrors, setData)
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
                <input
                    type={`${
                        passwordVisibility === "show" ? "text" : "password"
                    }`}
                    id="password"
                    name="password"
                    onChange={(e) =>
                        handleTyping(e, data, errors, clearErrors, setData)
                    }
                    value={data.password}
                    autoComplete="new-password"
                    required
                    placeholder="password"
                />

                <span className="tw-flex tw-items-center tw-w-fit tw-gap-2 tw-mt-2">
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
            </FormInputsLayout>

            <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4 tw-gap-2 tw-items-center">
                <button className="primaryBtn" disabled={processing}>
                    Register
                </button>
            </div>
        </form>
    );
}

export default OnboardUserLayout;
