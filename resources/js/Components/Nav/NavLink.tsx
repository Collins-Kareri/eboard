import { Link, usePage } from "@inertiajs/react";
import getUrl from "@/Utils/getUrl";
import { LinkProps } from "@/Components/Nav/Links";

function NavLink({ to, textContent }: LinkProps) {
    const { url } = usePage(),
        currentUrl = getUrl(route(to)),
        active =
            currentUrl === url ||
            url.startsWith("/" + textContent.toLocaleLowerCase());

    console.log(url);

    return (
        <Link
            className={`tw-capitalize tw-leading-5 tw-pt-2 tw-px-1 ${
                active ? "tw-border-b-2" : ""
            } tw-border-slate-400 hover:tw-border-b-2`}
            href={route(to)}
        >
            {textContent}
        </Link>
    );
}

export default NavLink;
