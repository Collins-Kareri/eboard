import Avatar from "@/Components/Avatar";
import Icon from "@/Components/Icon";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import ProfileSectionLayout from "@/Layouts/ProfileSection.Layout";
import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";

export default function EditProfileInformation() {
    return (
        <ProfileSectionLayout
            title={"Profile information"}
            description={"Edit your profile information and avatar"}
        >
            <div className="tw-flex tw-gap-2 tw-items-start tw-justify-center tw-flex-col">
                <Avatar size="xl" />
                <section className="tw-flex tw-h-fit tw-justify-center tw-items-center tw-gap-2">
                    <button className="secondaryBtn">select new photo</button>
                    <Icon
                        icon={faTrashAlt}
                        size="lg"
                        className="tertiaryBtn tw-px-4 tw-py-2"
                        title="delete avatar"
                    />
                </section>
            </div>

            <div className="tw-w-full tw-flex tw-gap-4 tw-flex-col">
                <FormInputsLayout labelText={"name"} htmlFor="name">
                    <input type="text" id="name" defaultValue={"John doe"} />
                </FormInputsLayout>
                <FormInputsLayout labelText={"email"} htmlFor="email">
                    <input
                        type="email"
                        id="email"
                        defaultValue={"johnDoe@mail.com"}
                    />
                </FormInputsLayout>
            </div>

            <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                <button className="primaryBtn">save changes</button>
            </div>
        </ProfileSectionLayout>
    );
}
