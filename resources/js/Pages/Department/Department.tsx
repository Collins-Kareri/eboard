import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import DepartmentInvite from "@/Pages/Department/Features/DepartmentInvite";
import { PendingInvitesProvider } from "@/Context/PendingDepartmentInvites";
import PendingInvites from "@/Pages/Department/Features/PendingInvites";
import CreateDepartment from "./Features/CreateDepartment";

export default function Department() {
    return (
        <RootLayout>
            <Head title="Department" />
            {/* <PendingInvites /> */}
            <CreateDepartment />
            <DepartmentInvite />
        </RootLayout>
    );
}
