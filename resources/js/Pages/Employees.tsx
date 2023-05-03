import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import EmployeesList from "@/Components/Employees/EmployeesList";

export default function Employees({}) {
    return (
        <RootLayout>
            <Head title="Employees" />
            <EmployeesList />
        </RootLayout>
    );
}
