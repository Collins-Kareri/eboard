import Nav from "@/Components/Nav/Nav";
import React from "react";

function RootLayout({ children }: React.PropsWithChildren) {
    return (
        <>
            <Nav />
            <main className="tw-p-6">{children}</main>
        </>
    );
}

export default RootLayout;
