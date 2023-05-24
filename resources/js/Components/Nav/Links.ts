export interface LinkProps {
    to: string;
    textContent: string;
}

interface Links {
    nav: LinkProps[];
    dropDownNav: LinkProps[];
}

const myLinks: Links = {
    nav: [
        {
            to: "home",
            textContent: "home",
        },
        {
            to: "tasks",
            textContent: "tasks",
        },
        {
            to: "employees.index",
            textContent: "employees",
        },
    ],
    dropDownNav: [
        {
            to: "profile.edit",
            textContent: "profile",
        },
        {
            to: "department",
            textContent: "departments",
        },
    ],
};

export default myLinks;
