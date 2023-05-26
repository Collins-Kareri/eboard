import { FilterProps } from "@/types";
import {
    faAngleDown,
    faAngleUp,
    faCheckCircle,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Transition } from "@headlessui/react";
import { useState } from "react";

interface FilterGroupProps {
    items: string[];
    title: keyof FilterProps;
    defaultState: "opened" | "closed";
    setCurrentFilters: (filters: FilterProps) => void;
    currentFilters: FilterProps;
}

export default function FilterGroup({
    items,
    title,
    defaultState = "closed",
    setCurrentFilters: setItems,
    currentFilters,
}: FilterGroupProps) {
    const [isOpen, setIsOpen] = useState(defaultState === "opened");

    function toggleState(currentState: boolean) {
        return !currentState;
    }

    /**
     * Based on the title we toggle the values of the key that title reps
     * @param filter the value to be added or removed
     * @returns void
     */
    function toggleFilter(filter: string) {
        let newValue = currentFilters;
        if (currentFilters[title].includes(filter)) {
            newValue[title] = currentFilters[title].filter(
                (item) => item !== filter
            );
            setItems({ ...newValue });
            return;
        }

        newValue[title] = [...newValue[title], filter];
        setItems({ ...newValue });
    }

    return (
        <section className="tw-flex tw-flex-col">
            <div
                className={`tw-flex tw-justify-between tw-items-center tw-w-full tw-relative tw-capitalize tw-font-semibold ${
                    !isOpen && "tw-border-b"
                } tw-p-4 tw-cursor-pointer hover:tw-bg-slate-950/30 tw-rounded-t-md ${
                    isOpen && "tw-bg-slate-950/40"
                }`}
                onClick={() => setIsOpen(toggleState(isOpen))}
            >
                <h1>{title}</h1>
                <FontAwesomeIcon icon={isOpen ? faAngleDown : faAngleUp} />
            </div>
            <Transition
                show={isOpen}
                enter="transition-opacity duration-75"
                enterFrom="opacity-0"
                enterTo="opacity-100"
                leave="transition-opacity duration-150"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
            >
                <div className="tw-flex tw-gap-4 tw-p-5 tw-bg-slate-950/20 tw-rounded-b-md tw-relative tw-w-full tw-flex-wrap">
                    {items.map((item, index) => {
                        return (
                            <button
                                key={index}
                                className={`tw-flex tw-items-center tw-gap-1 tw-border tw-rounded-full tw-w-fit tw-px-4 tw-py-2 tw-h-fit tw-whitespace-nowrap tw-bg-slate-950/30 tw-cursor-pointer ${
                                    currentFilters[title].includes(item) &&
                                    "tw-border-blue-400/80"
                                }`}
                                onClick={() => toggleFilter(item)}
                            >
                                <p>{item}</p>
                                {currentFilters[title].includes(item) && (
                                    <FontAwesomeIcon
                                        icon={faCheckCircle}
                                        className="tw-text-blue-400/80"
                                    />
                                )}
                            </button>
                        );
                    })}
                </div>
            </Transition>
        </section>
    );
}
