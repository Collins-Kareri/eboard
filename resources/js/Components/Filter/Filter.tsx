import Icon from "@/Components/Icon";
import FilterGroup from "@/Components/Filter/FilterGroup";
import { faFilter, faXmark } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Transition, Dialog } from "@headlessui/react";
import { useState, Fragment, useEffect } from "react";
import { useFilters } from "@/Context/Filters.Context";
import { router, usePage } from "@inertiajs/react";
import removeParams from "@/Utils/removeParams";
import getTotalLengthOfObjectValues from "@/Utils/getTotalLengthOfObjectValues";
import { FilterProps } from "@/types";

function Filter() {
    const [isOpen, setIsOpen] = useState(false),
        [availableFilters, setAvailableFilters] = useState<FilterProps>({
            department: [],
            role: [],
        }),
        { filters, parsedFilters, setFilters } = useFilters(),
        { url } = usePage();

    function getFilters() {
        fetch(route("filters"), {
            method: "GET",
        })
            .then((res) => res.json())
            .then((parsedRes) => setAvailableFilters(parsedRes));
    }

    function getFilteredData(url: string, data = {}) {
        router.get(url, data, {
            preserveState: true,
            preserveScroll: true,
            only: ["employees"],
        });
    }

    function cleanUpUrl(url: string, paramKeys: string[]) {
        let currentUrl = url.trim().toLowerCase();

        for (let key of paramKeys) {
            if (
                currentUrl.includes(key.toLowerCase()) &&
                filters[key as keyof FilterProps].length <= 0
            ) {
                currentUrl = removeParams([key], currentUrl);
            }
        }

        return currentUrl;
    }

    function applyFilters() {
        if (filters.role.length > 0 || filters.department.length > 0) {
            getFilteredData(
                cleanUpUrl(url, ["department", "role"]),
                parsedFilters
            );
        }
    }

    function clearAll() {
        setFilters({
            department: [],
            role: [],
        });
        getFilteredData(removeParams(Object.keys(filters), url));
    }

    useEffect(() => {
        getFilters();
        return;
    }, []);

    return (
        <>
            <button
                className="tertiaryBtn tw-flex tw-items-center tw-w-fit"
                onClick={() => setIsOpen(true)}
            >
                <FontAwesomeIcon icon={faFilter} size="lg" />
                <p>filters</p>
                <p className="tw-opacity-50 tw-h-fit">
                    ({getTotalLengthOfObjectValues(filters)})
                </p>
            </button>
            <Transition
                show={isOpen}
                enter="transition duration-100 ease-out"
                enterFrom="transform scale-95 opacity-0"
                enterTo="transform scale-100 opacity-100"
                leave="transition duration-75 ease-out"
                leaveFrom="transform scale-100 opacity-100"
                leaveTo="transform scale-95 opacity-0"
                as={Fragment}
            >
                <Dialog open={isOpen} onClose={() => setIsOpen(false)}>
                    {/* The backdrop, rendered as a fixed sibling to the panel container */}
                    <div
                        className="tw-fixed tw-inset-0 tw-bg-black/70 tw-z-20"
                        aria-hidden="true"
                    />

                    {/* Full-screen container to center the panel */}
                    <div className="tw-fixed tw-flex tw-z-30 tw-right-0 tw-top-0 lg:tw-w-1/2 tw-w-full tw-h-screen">
                        {/* The actual dialog panel  */}
                        <Dialog.Panel className="tw-mx-auto tw-bg-slate-200 tw-p-6 tw-rounded-lg tw-w-full tw-flex tw-flex-col tw-gap-6">
                            <Dialog.Title
                                className={`tw-flex tw-justify-between tw-items-center tw-w-full tw-relative tw-capitalize`}
                            >
                                <span className="tw-text-lg tw-font-bold">
                                    Filters
                                </span>
                                <Icon
                                    icon={faXmark}
                                    onClick={() => setIsOpen(false)}
                                />
                            </Dialog.Title>

                            <section className="tw-flex tw-items-center tw-gap-4">
                                <button
                                    className="primaryBtn !tw-w-fit"
                                    onClick={applyFilters}
                                >
                                    apply filters
                                </button>
                                <button
                                    className="secondaryBtn !tw-w-fit"
                                    onClick={clearAll}
                                >
                                    clear all (
                                    {getTotalLengthOfObjectValues(filters)})
                                </button>
                            </section>

                            <FilterGroup
                                items={availableFilters.department}
                                title={"department"}
                                defaultState={"opened"}
                                setCurrentFilters={setFilters}
                                currentFilters={filters}
                            />
                            <FilterGroup
                                items={availableFilters.role}
                                title={"role"}
                                defaultState={"closed"}
                                setCurrentFilters={setFilters}
                                currentFilters={filters}
                            />
                        </Dialog.Panel>
                    </div>
                </Dialog>
            </Transition>
        </>
    );
}

export default Filter;
