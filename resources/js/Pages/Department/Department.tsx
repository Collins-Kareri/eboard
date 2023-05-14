import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import DepartmentInvite from "@/Pages/Department/Features/DepartmentInvite";

export default function Department() {
    return (
        <RootLayout>
            <Head title="Department" />
            <DepartmentInvite />
        </RootLayout>
    );
}
