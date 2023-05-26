import { useFilters } from "@/Context/Filters.Context";
import { FilterProps } from "@/types";
import { IconProp } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Link } from "@inertiajs/react";

interface PaginationButtonProps {
    url: string;
    disabled: boolean;
    icon: IconProp;
}

export default function PaginationButton({
    url,
    disabled,
    icon,
}: PaginationButtonProps) {
    const { parsedFilters } = useFilters();

    return (
        <Link
            as="button"
            data={
                Object.keys(parsedFilters).length > 0
                    ? { ...parsedFilters }
                    : {}
            }
            href={url}
            disabled={disabled}
            preserveScroll={true}
            className="tertiaryBtn"
            preserveState={true}
        >
            <FontAwesomeIcon icon={icon} />
        </Link>
    );
}
