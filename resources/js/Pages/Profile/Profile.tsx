import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import EditProfileInformation from "@/Pages/Profile/partials/Update.ProfileInformation";
import UpdatePassword from "@/Pages/Profile/partials/Update.Password";
import DestroyAccount from "@/Pages/Profile/partials/Destroy/Destory.Account";

export default function Profile() {
    return (
        <RootLayout>
            <Head title="Profile" />
            <EditProfileInformation />
            <UpdatePassword />
            <DestroyAccount />
        </RootLayout>
    );
}
