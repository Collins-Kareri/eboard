import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import TasksList from "@/Components/Tasks/TasksList";
import Calender from "@/Components/Calender/Calender";

export default function Tasks({}) {
    return (
        <RootLayout>
            <Head title="Tasks" />
            <Calender />
            <TasksList />
        </RootLayout>
    );
}
