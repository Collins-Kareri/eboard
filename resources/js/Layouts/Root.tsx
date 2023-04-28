import Nav from "@/Components/Nav/Nav";
import React from "react";

function RootLayout({ children }: React.PropsWithChildren) {
    return (
        <>
            <Nav />
            {children}
        </>
    );
}

export default RootLayout;
