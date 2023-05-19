import OnboardUserLayout from "@/Layouts/OnboardUser.layout";
import { Head } from "@inertiajs/react";

function UserCreate({ email }: { email: string }) {
    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Register" />
            <OnboardUserLayout route={route("user.store")} email={email} />
        </div>
    );
}

export default UserCreate;
