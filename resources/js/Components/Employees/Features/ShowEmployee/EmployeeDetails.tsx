import { EmployeesProps } from "@/Components/Employees/EmployeesList";

function EmployeeDetails({ employee }: { employee: EmployeesProps }) {
    return (
        <section className="tw-grid tw-grid-cols-2 tw-relative tw-w-full tw-gap-y-1">
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">id:</b>
                <p>{employee.id}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">name:</b>
                <p>{employee.name}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">email:</b>
                <p>{employee.email}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">location:</b>
                <p>
                    {employee.address.street}, {employee.address.city}
                </p>
            </span>

            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">phone:</b>
                <p>{employee.phone}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">manager:</b>
                <p>{employee.username}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">department:</b>
                <p>{employee.company.name}</p>
            </span>
        </section>
    );
}

export default EmployeeDetails;
