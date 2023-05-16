import Logo from "@/Components/Logo";
import handleTyping from "@/Handlers/handleTyping";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { faEnvelopeCircleCheck } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useForm, Head, Link } from "@inertiajs/react";

function PasswordResetSent() {
    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Email sent" />
            <section className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-flex-col tw-gap-4 tw-border tw-border-slate-400 tw-rounded-md tw-shadow-md tw-shadow-slate-400">
                <FontAwesomeIcon
                    icon={faEnvelopeCircleCheck}
                    size="lg"
                    className="tw-p-4 tw-bg-slate-100 tw-rounded-full tw-text-emerald-700"
                />
                <p className="tw-text-center">
                    Please visit your mail inbox to find the instructions.
                </p>
                <Link href="/login" as="button" className="primaryBtn">
                    back to login
                </Link>
            </section>
        </div>
    );
}

function ForgotPassword({ status }: { status?: string }) {
    const { data, setData, errors, clearErrors, processing, post } = useForm({
        email: "",
    });

    function requestReset(
        evt: React.MouseEvent<HTMLButtonElement, MouseEvent>
    ) {
        evt.preventDefault();
        post(route("password.request.email"));
    }

    return (
        <>
            {status ? (
                <PasswordResetSent />
            ) : (
                <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
                    <Head title="Forgot password" />
                    <form className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2">
                        <Logo className="tw-w-full tw-text-center" />
                        {status && (
                            <span className="tw-text-green-800 tw-w-full tw-text-center tw-inline-block">
                                {status}
                            </span>
                        )}
                        <p className="tw-text-base tw-opacity-80">
                            <b className="tw-text-lg tw-font-semibold tw-opacity-100">
                                Forgot password?
                            </b>{" "}
                            No worries. Just enter the email used to register
                            and we will email you a reset link.
                        </p>
                        <FormInputsLayout
                            labelText="email"
                            htmlFor="email"
                            errors={errors.email}
                        >
                            <input
                                type="email"
                                id="email"
                                value={data.email}
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

                        <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4 tw-gap-2 tw-items-center">
                            <Link
                                href="/login"
                                method="get"
                                as="button"
                                type="button"
                                className="secondaryBtn"
                                disabled={processing}
                            >
                                back to login
                            </Link>
                            <button
                                className="primaryBtn"
                                disabled={processing}
                                onClick={requestReset}
                            >
                                Reset password
                            </button>
                        </div>
                    </form>
                </div>
            )}
        </>
    );
}

export default ForgotPassword;
