import OnboardUserLayout from "@/Layouts/OnboardUser.layout";
import { Head } from "@inertiajs/react";

function Register() {
    return (
        <div className="tw-p-6 tw-flex tw-justify-center tw-items-center tw-h-screen">
            <Head title="Register" />
            <OnboardUserLayout route={route("register.store")} email={""} />
        </div>
    );
}

export default Register;
