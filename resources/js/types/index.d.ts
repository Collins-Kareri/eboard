export interface User {
    id: number;
    email: string;
    email_verified_at: string;
    avatar_url: string;
    created_at: string;
    employeeID: string;
    full_name: string;
    job_title: string;
    current_department: string;
    role: "manager" | "member" | "contractor";
    phone_number: string;
    avatar: null | string | File;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
};

export interface FilterProps {
    department: string[];
    role: string[];
}
