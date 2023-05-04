import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import EditProfileInformation from "@/Pages/Profile/partials/Edit.ProfileInformation";
import UpdatePassword from "@/Pages/Profile/partials/Update.Password";
import DeleteAccount from "@/Pages/Profile/partials/Delete.Account";

export default function Profile({}) {
    return (
        <RootLayout>
            <Head title="Profile" />
            <EditProfileInformation />
            <UpdatePassword />
            <DeleteAccount />
        </RootLayout>
    );
}
