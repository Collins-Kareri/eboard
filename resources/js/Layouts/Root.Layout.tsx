import Nav from "@/Components/Nav/Nav";
import { PendingInvitesContextProvider } from "@/Context/PendingDepartmentInvites.Context";
import React from "react";

function RootLayout({ children }: React.PropsWithChildren) {
    return (
        <>
            <Nav />
            <main className="tw-p-6 tw-flex tw-flex-col tw-gap-6">
                <PendingInvitesContextProvider>
                    {children}
                </PendingInvitesContextProvider>
            </main>
        </>
    );
}

export default RootLayout;
