import React, { createContext, useContext, useState } from "react";

interface PendingInvitesContextProps {
    pendingInvites: number;
    setPending: (inviteCount: number) => void;
}

interface InviteProps {
    children: React.ReactNode;
}

const PendingInvitesContext = createContext<PendingInvitesContextProps>({
    pendingInvites: 0,
    setPending: () => {
        return;
    },
});

export const PendingInvitesContextProvider = ({ children }: InviteProps) => {
    const [pendingInvites, setPendingInvites] = useState<number>(0);

    const setPending = (inviteCount: number) => {
        setPendingInvites(inviteCount);
    };

    return (
        <PendingInvitesContext.Provider value={{ pendingInvites, setPending }}>
            {children}
        </PendingInvitesContext.Provider>
    );
};

export const useDepartmentInvites = () => {
    return useContext(PendingInvitesContext);
};
