import { Link, Head } from "@inertiajs/react";
// import { PageProps } from "@/types";
import RootLayout from "@/Layouts/Root";

export default function Welcome({}) {
    return (
        <RootLayout>
            <Head title="Home" />
        </RootLayout>
    );
}
