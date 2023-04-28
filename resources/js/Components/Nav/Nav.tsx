// import { Link } from "@inertiajs/react";
import Logo from "@/Components/Logo";
import myLinks from "@/Components/Nav/Links";
import NavLink from "@/Components/Nav/NavLink";
import Search from "@/Components/Nav/Features/Search";
import Notification from "@/Components/Nav/Features/Notification";
import Profile from "@/Components/Nav/Features/Profile";

function Nav() {
    return (
        <>
            <nav className="tw-px-4 tw-py-2 tw-flex tw-flex-row tw-items-center tw-h-fit tw-justify-between tw-border-b tw-border-slate-100">
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
                    <Profile
                        avatarUrl={
                            "https://ui-avatars.com/api/?name=jd&color=#060406&background=#DFF3E4"
                        }
                        size={"sm"}
                    />
                </div>
            </nav>
        </>
    );
}

export default Nav;
