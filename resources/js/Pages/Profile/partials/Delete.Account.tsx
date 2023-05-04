import ProfileSectionLayout from "@/Layouts/ProfileSection.Layout";
import { Link } from "@inertiajs/react";

function DeleteAccount() {
    return (
        <ProfileSectionLayout
            title={"Delete Account"}
            description={"Permanently delete your account"}
        >
            <p>
                Once your account is deleted, all of its resources and data will
                be permanently deleted.
            </p>
            <Link
                href="/profile/delete"
                className={`tw-border-red-400 tw-bg-red-400`}
                as="button"
                method="delete"
            >
                delete account
            </Link>
        </ProfileSectionLayout>
    );
}

export default DeleteAccount;
