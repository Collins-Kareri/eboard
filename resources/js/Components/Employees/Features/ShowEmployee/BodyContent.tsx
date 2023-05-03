import Avatar from "@/Components/Avatar";
import { EmployeesProps } from "@/Components/Employees/EmployeesList";
import Icon from "@/Components/Icon";
import { faPencilAlt } from "@fortawesome/free-solid-svg-icons";
import DestroyEmployee from "@/Components/Employees/Features/Destroy.Employee";
import EmployeeDetails from "@/Components/Employees/Features/ShowEmployee/EmployeeDetails";

function BodyContent({
    employee,
    setFeatureState,
}: {
    employee: EmployeesProps;
    setFeatureState: React.Dispatch<React.SetStateAction<"show" | "edit">>;
}) {
    return (
        <section className="tw-flex tw-flex-col tw-gap-6">
            <div className="tw-bg-slate-100 tw-shadow-md tw-shadow-slate-900  tw-rounded-md tw-px-4 tw-py-4 tw-flex tw-gap-1 tw-justify-between">
                <section className="tw-flex tw-flex-col tw-justify-center tw-items-center tw-gap-2">
                    <Avatar size={"lg"} />
                    <span>{employee.name}</span>
                </section>

                <section className="tw-flex tw-gap-2">
                    <Icon
                        icon={faPencilAlt}
                        title="edit employee"
                        className="tw-p-4"
                        onClick={() => setFeatureState("edit")}
                    />
                    <DestroyEmployee id={employee.id} />
                </section>
            </div>

            <div className="tw-bg-slate-100 tw-shadow-md tw-shadow-slate-900 tw-rounded-md tw-px-4 tw-py-4 tw-flex tw-gap-2 tw-justify-between">
                <EmployeeDetails employee={employee} />
            </div>
        </section>
    );
}

export default BodyContent;
