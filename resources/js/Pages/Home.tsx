import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import TasksList from "@/Components/Tasks/TasksList";

export default function Home({}) {
    return (
        <RootLayout>
            <Head title="Home" />
            <TasksList />
        </RootLayout>
    );
}
