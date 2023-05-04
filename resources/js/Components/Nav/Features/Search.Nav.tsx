import { Popover, Transition } from "@headlessui/react";
import Icon from "@/Components/Icon";
import { faXmark, faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
import SearchBar from "@/Components/SearchBar";

function Search() {
    return (
        <Popover>
            {({ open }) => (
                <>
                    <Popover.Button
                        className={"tw-border-none tw-outline-none tw-p-0"}
                    >
                        <Icon
                            icon={open ? faXmark : faMagnifyingGlass}
                            size="lg"
                            className={`${open ? "tw-bg-slate-400" : ""}`}
                        />
                    </Popover.Button>
                    <Transition
                        show={open}
                        enter="transition duration-100 ease-out"
                        enterFrom="transform scale-95 opacity-0"
                        enterTo="transform scale-100 opacity-100"
                        leave="transition duration-75 ease-out"
                        leaveFrom="transform scale-100 opacity-100"
                        leaveTo="transform scale-95 opacity-0"
                    >
                        <Popover.Panel
                            className={
                                "tw-absolute tw-top-[73px] tw-left-0 tw-w-full tw-flex tw-justify-center tw-bg-slate-200 tw-py-4 tw-shadow-md tw-shadow-slate-100 tw-z-10"
                            }
                        >
                            <SearchBar />
                        </Popover.Panel>
                    </Transition>
                </>
            )}
        </Popover>
    );
}

export default Search;
