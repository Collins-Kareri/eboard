import { SetStateAction, useEffect, useState } from "react";
import Days from "@/Components/Calender/Days";
import SelectMonth from "@/Components/Calender/Features/SelectMonth";
import SelectYear from "@/Components/Calender/Features/SelectYear/SelectYear";
import generateYears from "@/Utils/generateYears";
import isObjectEmpty from "@/Utils/isObjectEmpty";

interface CalenderProps {
    daysAbbr: [] | string[];
    monthNames: [] | string[];
}

export interface MonthDaysProps {
    day_number: number;
    within_month: boolean;
}

export interface YearProps {
    [key: string]: {
        dates: MonthDaysProps[];
    };
}

function Calender() {
    const TODAY = new Date(),
        [calender, setCalender] = useState<CalenderProps>({
            daysAbbr: [],
            monthNames: [],
        }),
        [currentYear, setCurrentYear] = useState(TODAY.getFullYear()),
        [monthNumber, setMonthNumber] = useState(TODAY.getMonth()),
        [monthDays, setMonthDays] = useState<YearProps | {}>({}),
        [yearsRange, setYearsRange] = useState(generateYears(currentYear));

    function getCalender() {
        if (calender.daysAbbr.length <= 0 || calender.monthNames.length <= 0) {
            fetch("/calender", { method: "get" })
                .then((res) => res.json())
                .then((parseRes) => setCalender(parseRes))
                .catch((err) => alert(err));
        }
        return;
    }

    function getMonthDays(year: number) {
        fetch(`/calender/${year}`)
            .then((res) => res.json())
            .then((parsedRes) => setMonthDays(parsedRes))
            .catch((err) => alert(err));
    }

    useEffect(() => {
        getCalender();
        getMonthDays(currentYear);
    }, [currentYear]);

    return (
        <div className="tw-flex tw-flex-col tw-gap-2 tw-w-full md:tw-w-fit tw-border tw-border-slate-100 tw-rounded-lg">
            <section className="tw-p-4 tw-h-fit tw-w-fit tw-flex tw-justify-center tw-flex-col tw-gap-4">
                <SelectYear
                    currentYear={currentYear}
                    yearsRange={yearsRange}
                    setYearsRange={setYearsRange}
                    setCurrentYear={setCurrentYear}
                />
                <SelectMonth
                    monthNames={calender.monthNames}
                    monthIndex={monthNumber}
                    setMonthNumber={setMonthNumber}
                />
            </section>
            <section className="tw-grid tw-grid-cols-7 tw-justify-items-center tw-w-full md:tw-w-fit tw-gap-2 tw-border-t tw-border-slate-100 tw-rounded-3xl tw-p-4">
                {calender.daysAbbr.map((day, index) => {
                    return (
                        <span
                            key={index}
                            className="tw-border tw-border-slate-100 tw-block tw-w-full tw-text-center tw-rounded-full tw-px-3"
                        >
                            {day}
                        </span>
                    );
                })}

                <Days
                    monthNames={calender.monthNames}
                    monthDays={monthDays}
                    monthNumber={monthNumber}
                    TODAY={TODAY}
                    setCurrentYear={setCurrentYear}
                    setMonthNumber={setMonthNumber}
                    currentYear={currentYear}
                />
            </section>
        </div>
    );
}

export default Calender;
