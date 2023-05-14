import getUrl from "@/Utils/getUrl";
import { Link, usePage } from "@inertiajs/react";
import { LinkProps } from "@/Components/Nav/Links";

function LinkDropDown({ to, textContent }: LinkProps) {
    const { url } = usePage(),
        currentUrl = getUrl(route(to)),
        active = currentUrl === url;

    return (
        <Link
            href={route(to)}
            className={`tw-p-2 hover:tw-bg-slate-400 tw-rounded-md tw-capitalize ${
                active ? "tw-bg-slate-400" : ""
            }`}
        >
            {textContent}
        </Link>
    );
}

export default LinkDropDown;
