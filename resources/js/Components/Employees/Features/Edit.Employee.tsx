import { Fragment, useState } from "react";
import Icon from "@/Components/Icon";
import {
    faAngleLeft,
    faPencilAlt,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";
import { EmployeesProps } from "@/Components/Employees/EmployeesList";
import Avatar from "@/Components/Avatar";
import { Transition, Dialog } from "@headlessui/react";

function EditEmployees({ employee }: { employee: EmployeesProps }) {
    const [data, setData] = useState();

    return (
        <section className="tw-flex tw-flex-col tw-gap-6">
            to be implemented
        </section>
    );
}

export default EditEmployees;
