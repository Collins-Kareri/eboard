// import { Link } from "@inertiajs/react";
import Logo from "@/Components/Logo";
import myLinks from "@/Components/Nav/Links";
import NavLink from "@/Components/Nav/NavLink";
import Search from "@/Components/Nav/Features/Search.Nav";
import Notification from "@/Components/Nav/Features/Notification.Nav";
import Profile from "@/Components/Nav/Features/Profile.Nav";

function Nav() {
    return (
        <nav className="tw-px-4 tw-py-2 tw-flex tw-flex-row tw-items-center tw-h-fit tw-justify-between tw-border-b tw-border-slate-100 tw-sticky tw-top-0 tw-bg-slate-50 tw-z-20">
            <div className="tw-flex tw-flex-row tw-h-fit tw-gap-4">
                <Logo />
                {myLinks.map(({ textContent, to }, index) => {
                    return (
                        <NavLink
                            to={`${to}`}
                            textContent={`${textContent}`}
                            key={index}
                        />
                    );
                })}
            </div>

            <div className="tw-flex tw-items-center tw-gap-2">
                <Search />
                <Notification />
                <Profile size={"sm"} />
            </div>
        </nav>
    );
}

export default Nav;
