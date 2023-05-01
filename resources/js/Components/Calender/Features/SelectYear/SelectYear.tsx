import { faCaretDown } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Listbox } from "@headlessui/react";
import { useEffect, useState } from "react";
import { handleScroll } from "@/Components/Calender/Features/SelectYear/Handlers";

export interface SelectYearProps {
    yearsRange: number[];
    setYearsRange: React.Dispatch<React.SetStateAction<number[]>>;
    currentYear: number;
    setCurrentYear: React.Dispatch<React.SetStateAction<number>>;
}

function SelectYear({
    yearsRange,
    setYearsRange,
    currentYear,
    setCurrentYear,
}: SelectYearProps) {
    const [selectedYear, setSelectedYear] = useState(
        yearsRange[yearsRange.indexOf(currentYear)]
    );

    function selectYear(index: number) {
        setSelectedYear(yearsRange[index]);
        setCurrentYear(yearsRange[index]);
    }

    useEffect(() => {
        setSelectedYear(currentYear);
    }, [currentYear]);

    return (
        <div className="tw-relative">
            <Listbox value={selectedYear} onChange={selectYear}>
                {({ open }) => (
                    <>
                        <Listbox.Button
                            className={`tw-text-md tw-font-bold tw-flex tw-gap-2 tw-h-fit tw-items-center tw-px-2 tw-py-1 ${
                                open
                                    ? "tw-shadow-sm tw-rounded-md tw-shadow-slate-400 tw-bg-slate-100 "
                                    : ""
                            }`}
                        >
                            {selectedYear}
                            <span className="tw-cursor-pointer tw-px-4 tw-py-[2px] tw-rounded-full tw-bg-slate-400 tw-text-base">
                                <FontAwesomeIcon icon={faCaretDown} />
                            </span>
                        </Listbox.Button>

                        <Listbox.Options
                            className={
                                "tw-absolute tw-top-10 tw-bg-slate-400 tw-w-full tw-z-20 tw-py-4 tw-px-2 tw-rounded-lg tw-flex tw-flex-col tw-gap-1 tw-h-64 tw-overflow-x-hidden tw-overflow-y-auto"
                            }
                            onScroll={(evt) =>
                                handleScroll(evt, {
                                    yearsRange: yearsRange,
                                    setYearsRange: setYearsRange,
                                    currentYear: currentYear,
                                })
                            }
                        >
                            {yearsRange.map((year, index) => (
                                <Listbox.Option value={index} key={index}>
                                    {({ active, selected }) => (
                                        <>
                                            <li
                                                className={`tw-p-1 tw-rounded-lg tw-text-center tw-cursor-pointer hover:tw-bg-slate-800
                            ${selectedYear === year ? "tw-bg-slate-800" : ""} `}
                                            >
                                                {year}
                                            </li>
                                        </>
                                    )}
                                </Listbox.Option>
                            ))}
                        </Listbox.Options>
                    </>
                )}
            </Listbox>
        </div>
    );
}

export default SelectYear;
