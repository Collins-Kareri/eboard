import DialogBox, {
    DialogBoxProps,
} from "@/Components/Tasks/Partials/DialogBox";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import togglePasswordVisibility from "@/Utils/togglePasswordVisibility";
import { useForm, usePage } from "@inertiajs/react";
import { useState } from "react";
import { PageProps } from "@/types";

export default function DestroyConfirmation({
    isOpen,
    setIsOpen,
}: Omit<DialogBoxProps, "title">) {
    const { owns_department } = usePage<PageProps>().props.auth.user,
        {
            data,
            setData,
            errors,
            clearErrors,
            delete: destroy,
            processing,
        } = useForm({
            password: "",
            owns_department: owns_department,
        }),
        [passwordVisibility, setPasswordVisibility] = useState<"show" | "hide">(
            "hide"
        );

    function handleTyping(e: React.ChangeEvent<HTMLInputElement>) {
        const id = e.target.id as keyof typeof data;

        if (errors[id]) {
            clearErrors(id);
        }

        setData(id, e.target.value);
    }

    function handleSubmit(evt: React.FormEvent<HTMLFormElement>) {
        evt.preventDefault();
        destroy(route("profile.destroy"), {
            preserveScroll: true,
            errorBag: "deleteAccount",
        });
    }

    return (
        <DialogBox
            isOpen={isOpen}
            setIsOpen={setIsOpen}
            title={"Delete account confirmation"}
        >
            <form
                className="tw-flex tw-flex-col tw-gap-4 tw-my-2"
                onSubmit={handleSubmit}
            >
                <p>We require your password to continue.</p>
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
                            onChange={handleTyping}
                            value={data.password}
                            className="!tw-bg-transparent !tw-border-none focus:tw-ring-0 tw-flex-1"
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
                <section className="tw-flex tw-items-center tw-gap-4 tw-mt-6">
                    <button
                        type="button"
                        className="secondaryBtn"
                        onClick={() => setIsOpen(false)}
                    >
                        cancel
                    </button>
                    <button
                        className="primaryBtn"
                        disabled={processing || owns_department}
                    >
                        continue
                    </button>
                </section>
            </form>
        </DialogBox>
    );
}
