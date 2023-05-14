import { useForm, usePage } from "@inertiajs/react";
import SettingSectionLayout from "@/Layouts/SettingSection.Layout";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { PageProps } from "@/types";
import RoleSelector from "@/Components/RoleSelector";
import handleTyping from "@/Handlers/handleTyping";

export default function DepartmentInvite({}) {
    const { role } = usePage<PageProps>().props.auth.user,
        { data, setData, errors, clearErrors, processing, post } = useForm<{
            email: string;
            role: "member" | "contractor";
        }>({
            email: "",
            role: "member",
        }),
        roles: ["member", "contractor"] = ["member", "contractor"];

    function invite(evt: React.FormEvent) {
        evt.preventDefault();
        post(route("department.invite"), {
            errorBag: "invite",
            onStart: () => clearErrors(),
        });
    }

    return (
        <SettingSectionLayout
            title={"Invite member"}
            description={
                "Add a new member to your department with the specified role"
            }
        >
            <form
                className="tw-w-full tw-h-fit tw-flex tw-flex-col tw-gap-6"
                onSubmit={invite}
            >
                <p className="tw-text-sm tw-font-light tw-opacity-60">
                    Please provide an email of the person you wish to become a
                    member of this department.
                </p>
                <FormInputsLayout
                    labelText={"email"}
                    htmlFor="email"
                    errors={errors.email}
                >
                    <input
                        type="email"
                        id="email"
                        value={data.email}
                        onChange={(e) =>
                            handleTyping<keyof typeof errors>(
                                e,
                                data,
                                errors,
                                clearErrors,
                                setData
                            )
                        }
                    />
                </FormInputsLayout>

                <div className="tw-flex tw-flex-col tw-gap-4">
                    <h1 className="tw-text-lg tw-capitalize">role</h1>
                    {errors.role ? (
                        <span className=" tw-text-red-500">{errors.role}</span>
                    ) : (
                        <></>
                    )}
                    <input type="hidden" value={data.role} id="role" />
                    <section className="tw-w-full tw-border tw-border-slate-100 tw-rounded-md">
                        {roles.map((role, index) => (
                            <RoleSelector
                                active={data.role === role}
                                value={role}
                                key={index}
                                onClick={() => setData("role", role)}
                                description={
                                    role === "member"
                                        ? "Able to carry out operations on their own account"
                                        : "Temporary access to your department"
                                }
                            />
                        ))}
                    </section>
                </div>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                    <button
                        className="primaryBtn"
                        disabled={processing || role === "member"}
                        type="button"
                        onClick={invite}
                    >
                        invite
                    </button>
                </div>
            </form>
        </SettingSectionLayout>
    );
}
