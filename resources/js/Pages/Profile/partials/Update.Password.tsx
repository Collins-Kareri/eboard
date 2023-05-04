import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import ProfileSectionLayout from "@/Layouts/ProfileSection.Layout";

function UpdatePassword() {
    return (
        <ProfileSectionLayout
            title={"Security"}
            description={"Change your password"}
        >
            <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                <FormInputsLayout
                    labelText={"current password"}
                    htmlFor="current_password"
                >
                    <input
                        type="password"
                        id="current_password"
                        autoComplete="current-password"
                    />
                </FormInputsLayout>
                <FormInputsLayout
                    labelText={"new password"}
                    htmlFor="new_password"
                >
                    <input
                        type="password"
                        id="new_password"
                        autoComplete="new-password"
                    />
                </FormInputsLayout>
                <FormInputsLayout
                    labelText={"confirm new password"}
                    htmlFor="confirm_new_password"
                >
                    <input
                        type="password"
                        id="confirm_new_password"
                        autoComplete="new-password"
                    />
                </FormInputsLayout>
            </div>

            <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                <button className="primaryBtn">save changes</button>
            </div>
        </ProfileSectionLayout>
    );
}

export default UpdatePassword;
