import { faCaretDown } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Listbox } from "@headlessui/react";
import { useEffect, useState } from "react";

function SelectMonth({
    monthNames,
    monthIndex,
    setMonthNumber,
}: {
    monthNames: [] | string[];
    monthIndex: number;
    setMonthNumber: React.Dispatch<React.SetStateAction<number>>;
}) {
    const [selectedMonth, setSelectedMonth] = useState(monthIndex);

    function selectMonth(selectedMonthIndex: number) {
        setSelectedMonth(selectedMonthIndex);
        setMonthNumber(selectedMonthIndex);
        return;
    }

    useEffect(() => {
        setSelectedMonth(monthIndex);
    }, [monthIndex]);

    return (
        <div className="tw-relative">
            <Listbox value={selectedMonth} onChange={selectMonth}>
                {({ open }) => (
                    <>
                        <Listbox.Button
                            className={`tw-text-md tw-font-bold tw-flex tw-gap-2 tw-h-fit tw-items-center tw-px-2 tw-py-1 ${
                                open
                                    ? "tw-shadow-sm tw-rounded-md tw-shadow-slate-400 tw-bg-slate-100 "
                                    : ""
                            }`}
                        >
                            {monthNames[selectedMonth]}
                            <span className="tw-cursor-pointer tw-px-4 tw-py-[2px] tw-rounded-full tw-bg-slate-400 tw-text-base">
                                <FontAwesomeIcon icon={faCaretDown} />
                            </span>
                        </Listbox.Button>
                        <Listbox.Options
                            className={
                                "tw-absolute tw-top-10 tw-bg-slate-400 tw-w-fit tw-z-20 tw-py-4 tw-px-2 tw-rounded-lg tw-flex tw-flex-col tw-gap-1 tw-h-64 tw-overflow-x-hidden tw-overflow-y-auto"
                            }
                        >
                            {monthNames.map((monthName, index) => (
                                <Listbox.Option value={index} key={index}>
                                    {({ active, selected }) => (
                                        <li
                                            className={`tw-p-1 tw-rounded-lg tw-text-center tw-cursor-pointer hover:tw-bg-slate-800
                            ${active || selected ? "tw-bg-slate-800" : ""} `}
                                        >
                                            {monthName}
                                        </li>
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

export default SelectMonth;
