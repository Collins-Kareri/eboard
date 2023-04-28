import { Link, usePage } from "@inertiajs/react";

function NavLink({ to, textContent }: { to: string; textContent: string }) {
    const { url } = usePage();

    return (
        <Link
            className={`tw-capitalize tw-leading-5 tw-pt-2 tw-px-1 ${
                url === to ? "tw-border-b-2" : ""
            } tw-border-slate-400 hover:tw-border-b-2`}
            href={`${to}`}
        >
            {textContent}
        </Link>
    );
}

export default NavLink;
