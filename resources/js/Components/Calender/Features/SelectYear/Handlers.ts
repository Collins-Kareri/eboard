import { SelectYearProps } from "@/Components/Calender/Features/SelectYear/SelectYear";
import generateYears from "@/Utils/generateYears";

export const handleScroll = (
    evt: React.UIEvent<HTMLUListElement, UIEvent>,
    props: Omit<SelectYearProps, "setCurrentYear">
) => {
    const container = evt.target as HTMLUListElement,
        { scrollTop, clientHeight, scrollHeight } = container;

    if (scrollTop === 0) {
        props.setYearsRange(generateYears(props.yearsRange[0] - 10));
    }

    if (scrollTop + clientHeight === scrollHeight) {
        let len = props.yearsRange.length,
            finalYear = len > 0 ? props.yearsRange[len - 1] : props.currentYear;
        props.setYearsRange(generateYears(finalYear));
    }
};
