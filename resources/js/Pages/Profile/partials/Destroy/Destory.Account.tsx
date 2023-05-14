import SettingSectionLayout from "@/Layouts/SettingSection.Layout";
import { useState } from "react";
import DestroyConfirmation from "@/Pages/Profile/partials/Destroy/Destory.Confirmation";
import { PageProps } from "@/types";
import { usePage } from "@inertiajs/react";

function DestroyAccount() {
    const [isOpen, setIsOpen] = useState(false),
        { role } = usePage<PageProps>().props.auth.user;

    return (
        <SettingSectionLayout
            title={"Delete Account"}
            description={"Permanently delete your account"}
        >
            {role === "manager" ? (
                <span className="tw-font-bold tw-text-red-600">
                    NOTE: <br /> Delete account operation is not available to
                    managers. A manager's account can only be resigned to new
                    manager.
                </span>
            ) : (
                <>
                    <p>
                        Once your account is deleted, all of its resources and
                        data will be permanently deleted.
                    </p>
                    <button
                        className={`tw-border-red-400 tw-bg-red-400`}
                        onClick={() => setIsOpen(true)}
                    >
                        delete account
                    </button>
                    <DestroyConfirmation
                        isOpen={isOpen}
                        setIsOpen={setIsOpen}
                    />
                </>
            )}
        </SettingSectionLayout>
    );
}

export default DestroyAccount;
