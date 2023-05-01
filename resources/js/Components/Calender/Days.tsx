import { YearProps, MonthDaysProps } from "@/Components/Calender/Calender";
import isObjectEmpty from "@/Utils/isObjectEmpty";
import { useState } from "react";

interface DaysProps {
    monthNames: string[] | [];
    monthDays: YearProps;
    monthNumber: number;
    TODAY: Date;
    setMonthNumber: React.Dispatch<React.SetStateAction<number>>;
    setCurrentYear: React.Dispatch<React.SetStateAction<number>>;
    currentYear: number;
}

function Days({
    monthNames,
    monthDays,
    monthNumber,
    TODAY,
    setMonthNumber,
    setCurrentYear,
    currentYear,
}: DaysProps) {
    const [currentDate, setCurrentDate] = useState(TODAY.getDate());

    function showMonthDays() {
        return (monthDays as YearProps)[
            monthNames[monthNumber] as keyof typeof monthDays
        ].dates as MonthDaysProps[];
    }

    function selectDate(
        day_number: number,
        within_month: boolean,
        dateIndex: number
    ) {
        const dates = showMonthDays(),
            firstInMonthDateIndex = dates.findIndex(
                ({ within_month }) => within_month
            ),
            lastDateInMonthIndex = dates.findLastIndex(
                ({ within_month }) => within_month
            );

        if (dateIndex < firstInMonthDateIndex) {
            if (monthNumber - 1 >= 0) {
                setMonthNumber(monthNumber - 1);
                setCurrentDate(day_number);
                return;
            } else {
                setCurrentYear(currentYear - 1);
                setMonthNumber(12 - 1);
                setCurrentDate(day_number);
                return;
            }
        }

        if (dateIndex > lastDateInMonthIndex) {
            if (monthNumber + 1 < 12) {
                setMonthNumber(monthNumber + 1);
                setCurrentDate(day_number);
                return;
            } else {
                setCurrentYear(currentYear + 1);
                setMonthNumber(0);
                setCurrentDate(day_number);
                return;
            }
        }

        setCurrentDate(day_number);
        return;
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
                            onClick={() =>
                                selectDate(day_number, within_month, index)
                            }
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
