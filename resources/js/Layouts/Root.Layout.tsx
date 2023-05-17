import Nav from "@/Components/Nav/Nav";
import { PendingInvitesProvider } from "@/Context/PendingDepartmentInvites";
import React from "react";

function RootLayout({ children }: React.PropsWithChildren) {
    return (
        <>
            <Nav />
            <main className="tw-p-6 tw-flex tw-flex-col tw-gap-6">
                <PendingInvitesProvider>{children}</PendingInvitesProvider>
            </main>
        </>
    );
}

export default RootLayout;
