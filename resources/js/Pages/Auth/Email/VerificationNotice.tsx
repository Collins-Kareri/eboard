import Logo from "@/Components/Logo";
import { faEnvelopeCircleCheck } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Head, Link, useForm } from "@inertiajs/react";
import { FormEventHandler } from "react";

function VerificationNotice({
    email,
    status,
}: {
    email: string;
    status: string;
}) {
    const { post, processing } = useForm({});

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("verification.send"));
    };

    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Verify email" />
            <section className="tw-w-full tw-flex tw-flex-col tw-gap-6 tw-p-4 tw-bg-slate-100 tw-rounded-md tw-shadow-md tw-shadow-slate-900 tw-border-slate-100 tw-border-[1px] md:tw-w-1/2">
                <Logo className="tw-w-full tw-text-center" />
                <p>
                    Before continuing, could you verify your email address by
                    clicking on the link we just emailed to you? If you didn't
                    receive the email, we will gladly send you another.
                </p>
                {status === "verification-link-sent" && (
                    <div className="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600 dark:tw-text-green-400">
                        A new verification link has been sent to the email
                        address you provided during registration.
                    </div>
                )}

                <form onSubmit={submit}>
                    <div className="tw-flex tw-items-center tw-gap-4 tw-border-t tw-border-slate-100 tw-py-4">
                        <button className="primaryBtn" disabled={processing}>
                            Resend Verification Email
                        </button>

                        <Link
                            href={route("logout")}
                            method="post"
                            as="button"
                            className="secondaryBtn"
                        >
                            Log Out
                        </Link>
                    </div>
                </form>
            </section>
        </div>
    );
}

export default VerificationNotice;
