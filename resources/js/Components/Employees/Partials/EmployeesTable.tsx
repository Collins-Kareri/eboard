import { EmployeesProps } from "@/Components/Employees/EmployeesList";
import {
    faEnvelope,
    faMapPin,
    faPhoneAlt,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import ShowEmployee from "@/Components/Employees/Features/ShowEmployee/Show.Employee";

function EmployeesTable({ employees }: { employees: EmployeesProps[] | [] }) {
    return (
        <section className="tw-w-full tw-h-[500px] tw-overflow-auto tw-mt-8">
            <table className="tw-w-absolute tw-w-full tw-table-auto tw-caption-top tw-mx-auto tw-border-collapse tw-border tw-border-slate-400 tw-rounded-lg tw-top-0 tw-left-0">
                <caption className="tw-text-xl tw-font-bold tw-px-8">
                    Employees
                </caption>
                <thead className="tw-sticky -tw-top-1 tw-z-10">
                    <tr className="tw-uppercase tw-font-bold tw-text-center">
                        <th className="tw-border tw-border-slate-400 tw-bg-slate-800 tw-px-3 tw-py-2">
                            name
                        </th>
                        <th className="tw-border tw-border-slate-400 tw-bg-slate-800 tw-px-3 tw-py-2">
                            contacts
                        </th>
                        <th className="tw-border tw-border-slate-400 tw-bg-slate-800 tw-px-3 tw-py-2">
                            department
                        </th>
                        <th className="tw-bg-slate-800 tw-px-3 tw-py-2 tw-text-right">
                            manager
                        </th>
                        <th className="tw-px-3 tw-py-2 tw-bg-slate-800"></th>
                    </tr>
                </thead>
                <tbody>
                    {employees.map((employee) => {
                        return (
                            <tr key={employee.id} className="tw-text-center">
                                <td className="tw-border tw-border-slate-400 tw-bg-slate-950 tw-px-3 tw-py-1 tw-whitespace-nowrap tw-w-auto">
                                    {employee.name}
                                </td>
                                <td className="tw-border tw-border-slate-400 tw-bg-slate-950 tw-px-3 tw-py-1 tw-whitespace-nowrap tw-w-auto">
                                    <div className="tw-flex tw-flex-col tw-gap-1 tw-w-fit tw-h-fit tw-justify-center">
                                        <p className="tw-flex tw-items-center tw-h-fit tw-gap-2 tw-w-fit tw-justify-center">
                                            <FontAwesomeIcon
                                                icon={faPhoneAlt}
                                            />
                                            <span>{employee.phone}</span>
                                        </p>
                                        <p className="tw-flex tw-items-center tw-h-fit tw-gap-2 tw-w-fit tw-justify-center">
                                            <FontAwesomeIcon
                                                icon={faEnvelope}
                                            />
                                            <span>{employee.email}</span>
                                        </p>
                                        <p className="tw-flex tw-items-center tw-h-fit tw-gap-2 tw-w-fit tw-justify-center">
                                            <FontAwesomeIcon icon={faMapPin} />
                                            {`${employee.address.street}, ${employee.address.city}`}
                                        </p>
                                    </div>
                                </td>
                                <td className="tw-border tw-border-slate-400 tw-bg-slate-950 tw-px-3 tw-py-1 tw-whitespace-nowrap tw-w-auto">
                                    {employee.company.name}
                                </td>
                                <td className="tw-border tw-border-slate-400 tw-bg-slate-950 tw-px-3 tw-py-1 tw-whitespace-nowrap tw-w-auto tw-border-r-0 tw-text-right">
                                    {employee.username}
                                </td>
                                <td className="tw-bg-slate-950 tw-px-3 tw-py-1 tw-border tw-border-slate-400 tw-border-r-0 tw-border-l-0 tw-text-left">
                                    <ShowEmployee employee={employee} />
                                </td>
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        </section>
    );
}

export default EmployeesTable;
