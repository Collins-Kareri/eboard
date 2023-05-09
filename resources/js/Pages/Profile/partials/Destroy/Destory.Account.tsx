import ProfileSectionLayout from "@/Layouts/ProfileSection.Layout";
import { useState } from "react";
import DestroyConfirmation from "@/Pages/Profile/partials/Destroy/Destory.Confirmation";

function DestroyAccount() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <ProfileSectionLayout
            title={"Delete Account"}
            description={"Permanently delete your account"}
        >
            <p>
                Once your account is deleted, all of its resources and data will
                be permanently deleted.
            </p>
            <button
                className={`tw-border-red-400 tw-bg-red-400`}
                onClick={() => setIsOpen(true)}
            >
                delete account
            </button>
            <DestroyConfirmation isOpen={isOpen} setIsOpen={setIsOpen} />
        </ProfileSectionLayout>
    );
}

export default DestroyAccount;
