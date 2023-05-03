import {
    faFilter,
    faTable,
    faTableList,
} from "@fortawesome/free-solid-svg-icons";
import Icon from "@/Components/Icon";
import { useEffect, useState } from "react";
import EmployeesTable from "@/Components/Employees/Partials/EmployeesTable";
import EmployeesCard from "@/Components/Employees/Partials/EmployeesCard";
import Filter from "@/Components/Employees/Features/Filter";

export interface EmployeesProps {
    id: number;
    name: string;
    username: string;
    email: string;
    address: {
        street: string;
        suite: string;
        city: string;
        zipcode: string;
        geo: {
            lat: string;
            lng: string;
        };
    };
    phone: string;
    website: string;
    company: {
        name: string;
        catchPhrase: string;
        bs: string;
    };
}

function EmployeesList() {
    const [activeView, setActiveView] = useState<"table view" | "card view">(
            "table view"
        ),
        [employees, setEmployees] = useState<[] | EmployeesProps[]>([]);

    function showEmployees() {
        fetch("https://jsonplaceholder.typicode.com/users")
            .then((res) => res.json())
            .then((parsedRes) => setEmployees(parsedRes))
            .catch((err) => alert(err));
    }

    useEffect(() => {
        showEmployees();
    }, []);

    return (
        <div className="tw-relative">
            <section className="tw-flex tw-w-full tw-justify-between tw-items-center tw-mb-8">
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
                <button className="tw-bg-slate-400 tw-px-4 tw-py-2 tw-border tw-border-slate-400 tw-rounded-md tw-capitalize hover:tw-shadow-md hover:tw-shadow-slate-100">
                    add employee
                </button>
            </section>
            {activeView === "table view" ? (
                <EmployeesTable employees={employees} />
            ) : (
                <></>
            )}
            {activeView === "card view" ? (
                <EmployeesCard employees={employees} />
            ) : (
                <></>
            )}
        </div>
    );
}

export default EmployeesList;
