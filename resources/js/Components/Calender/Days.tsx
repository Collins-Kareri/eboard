import { YearProps, MonthDaysProps } from "@/Components/Calender/Calender";
import isObjectEmpty from "@/Utils/isObjectEmpty";
import { useState } from "react";

interface DaysProps {
    monthNames: string[] | [];
    monthDays: YearProps;
    monthNumber: number;
    TODAY: Date;
}

function Days({ monthNames, monthDays, monthNumber, TODAY }: DaysProps) {
    const [currentDate, setCurrentDate] = useState(TODAY.getDate());

    function showMonthDays() {
        return (monthDays as YearProps)[
            monthNames[monthNumber] as keyof typeof monthDays
        ].dates as MonthDaysProps[];
    }

    return (
        <>
            {monthNames.length > 0 && !isObjectEmpty(monthDays) ? (
                showMonthDays().map(({ day_number, within_month }, index) => {
                    return (
                        <span
                            key={index}
                            className={`tw-relative tw-z-10 hover:tw-cursor-pointer hover:tw-bg-slate-400 tw-w-8 tw-h-8 tw-flex tw-justify-center tw-items-center tw-rounded-full ${
                                !within_month ? "tw-opacity-30" : ""
                            } ${
                                currentDate === day_number && within_month
                                    ? "tw-bg-slate-400"
                                    : ""
                            }`}
                        >
                            {day_number}
                        </span>
                    );
                })
            ) : (
                <></>
            )}
        </>
    );
}

export default Days;
