interface LinkProps {
    to: string;
    textContent: string;
}

const myLinks: LinkProps[] = [
    {
        to: "/",
        textContent: "home",
    },
    {
        to: "/tasks",
        textContent: "tasks",
    },
    {
        to: "/employees",
        textContent: "employees",
    },
];

export default myLinks;
