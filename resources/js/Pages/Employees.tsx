import { Head, Link } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import EmployeesList from "@/Components/Employees/EmployeesList";
import { User } from "@/types";
import { PaginatedProps } from "@/Components/Pagination/Pagination";
import { FilterContextProvider } from "@/Context/Filters.Context";

export interface EmployeesPageProps extends PaginatedProps {
    data: User[];
}

export default function Employees({
    employees,
}: {
    employees: EmployeesPageProps;
}) {
    return (
        <RootLayout>
            <Head title="Employees" />
            <FilterContextProvider>
                <EmployeesList employees={employees} />
            </FilterContextProvider>
        </RootLayout>
    );
}
