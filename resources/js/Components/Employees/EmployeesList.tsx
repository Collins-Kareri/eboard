import { faTable, faTableList } from "@fortawesome/free-solid-svg-icons";
import Icon from "@/Components/Icon";
import { useState } from "react";
import EmployeesTable from "@/Components/Employees/Partials/EmployeesTable";
import EmployeesCard from "@/Components/Employees/Partials/EmployeesCard";
import Filter from "@/Components/Employees/Features/Filter";
import AddEmployee from "@/Components/Employees/Features/Add.Employee";
import { User } from "@/types";
import { EmployeesPageProps } from "@/Pages/Employees";
import Pagination from "@/Components/Pagination/Pagination";

export interface EmployeesProps {
    employees: User[];
}

function EmployeesList({ employees }: { employees: EmployeesPageProps }) {
    const [activeView, setActiveView] = useState<"table view" | "card view">(
        "table view"
    );

    return (
        <div className="tw-relative">
            <section className="tw-flex tw-w-full tw-justify-between tw-items-center tw-my-8">
                <span className="tw-flex tw-h-fit tw-w-fit tw-gap-2">
                    <Icon
                        icon={faTableList}
                        size="lg"
                        title="table view"
                        className={`${
                            activeView === "table view" ? "tw-bg-slate-400" : ""
                        }`}
                        onClick={() => setActiveView("table view")}
                    />
                    <Icon
                        icon={faTable}
                        size="lg"
                        title="card view"
                        className={`${
                            activeView === "card view" ? "tw-bg-slate-400" : ""
                        }`}
                        onClick={() => setActiveView("card view")}
                    />
                    <Filter />
                </span>
                <AddEmployee />
            </section>
            {activeView === "table view" ? (
                <EmployeesTable employees={employees.data} />
            ) : (
                <></>
            )}
            {activeView === "card view" ? (
                <EmployeesCard employees={employees.data} />
            ) : (
                <></>
            )}
            <Pagination
                current_page={employees.current_page}
                first_page_url={employees.first_page_url}
                last_page_url={employees.last_page_url}
                last_page={employees.last_page}
                next_page_url={employees.next_page_url}
                prev_page_url={employees.prev_page_url}
                total={employees.total}
                path={employees.path}
            />
        </div>
    );
}

export default EmployeesList;
