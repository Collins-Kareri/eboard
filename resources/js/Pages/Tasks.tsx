import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import Tasks from "@/Components/Tasks/TasksList";
import Calender from "@/Components/Calender/Calender";

export default function Welcome({}) {
    return (
        <RootLayout>
            <Head title="Tasks" />
            <Calender />
            <Tasks />
        </RootLayout>
    );
}
