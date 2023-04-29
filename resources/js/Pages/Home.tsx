import { Head } from "@inertiajs/react";
import RootLayout from "@/Layouts/Root.Layout";
import Tasks from "@/Components/Tasks/TasksList";

export default function Welcome({}) {
    return (
        <RootLayout>
            <Head title="Home" />
            <Tasks />
        </RootLayout>
    );
}
