import Avatar from "@/Components/Avatar";
import { EmployeesProps } from "@/Components/Employees/EmployeesList";
import ShowEmployee from "@/Components/Employees/Features/ShowEmployee/Show.Employee";

function EmployeesCard({ employees }: EmployeesProps) {
    return (
        <section
            className="tw-grid tw-w-full tw-grid-cols-1 tw-gap-6
        md:tw-grid-cols-3 tw-justify-items-center"
        >
            <>
                {employees.map((employee) => {
                    return (
                        <section
                            key={employee.id}
                            className="md:tw-w-80 tw-w-full tw-h-fit
                                    tw-border tw-border-slate-100
                                    tw-bg-slate-100 tw-rounded-md tw-shadow-sm
                                    tw-shadow-slate-100 tw-flex
                                    tw-justify-center tw-items-center tw-flex-col
                                    tw-p-4 tw-gap-4 tw-relative"
                        >
                            <span className="tw-absolute tw-top-4 tw-right-2">
                                <ShowEmployee employee={employee} />
                            </span>
                            <Avatar
                                avatar_url={employee.avatar_url}
                                size={"xl"}
                            />
                            <section
                                className="tw-flex tw-flex-col
                            tw-justify-center tw-h-fit tw-w-full tw-items-center
                            tw-text-base"
                            >
                                <p>
                                    <b className="tw-capitalize">name:</b>{" "}
                                    {employee.full_name}
                                </p>
                                <p>
                                    <b className="tw-capitalize">email: </b>
                                    {employee.email}
                                </p>
                                <p>
                                    <b className="tw-capitalize">tel no:</b>{" "}
                                    {employee.phone_number}
                                </p>
                            </section>
                            <section
                                className="tw-flex tw-justify-between tw-w-full
                                tw-border-t tw-border-slate-100 tw-py-4
                                tw-flex-col tw-text-sm tw-items-start tw-opacity-50"
                            >
                                <p>
                                    <b className="tw-capitalize">department:</b>{" "}
                                    {employee.current_department}
                                </p>
                                {/* <p>
                                    <b className="tw-capitalize">manager:</b>
                                    {employee}
                                </p> */}
                            </section>
                        </section>
                    );
                })}
            </>
        </section>
    );
}

export default EmployeesCard;
