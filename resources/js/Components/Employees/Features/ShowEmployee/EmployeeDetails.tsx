import { User } from "@/types";

function EmployeeDetails({ employee }: { employee: User }) {
    return (
        <section className="tw-grid tw-grid-cols-2 tw-relative tw-w-full tw-gap-y-1">
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">employee id:</b>
                <p>{employee.employeeID}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">name:</b>
                <p>{employee.full_name}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">email:</b>
                <p>{employee.email}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">phone:</b>
                <p>{employee.phone_number}</p>
            </span>
            <span className="tw-flex tw-gap-2">
                <b className="tw-capitalize">department:</b>
                <p>{employee.current_department}</p>
            </span>
        </section>
    );
}

export default EmployeeDetails;
