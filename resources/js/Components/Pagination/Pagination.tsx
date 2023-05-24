import { useFilters } from "@/Context/Filters.Context";
import {
    faAngleDoubleLeft,
    faAngleDoubleRight,
    faAngleLeft,
    faAngleRight,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Link } from "@inertiajs/react";
import { generateUrl } from "@/Components/Employees/Features/Filter";
import PaginationButton from "./PaginationButton";

export interface PaginatedProps {
    current_page: number;
    first_page_url: string;
    last_page_url: string;
    last_page: number;
    next_page_url: null | string;
    prev_page_url: null | string;
    total: number;
    path: string;
}

export default function Pagination({
    current_page,
    last_page,
    last_page_url,
    next_page_url,
    first_page_url,
    prev_page_url,
}: PaginatedProps) {
    function next() {
        if (current_page === last_page) {
            return last_page_url;
        }

        return next_page_url as string;
    }

    function prev() {
        if (current_page === 1) {
            return first_page_url;
        }
        return prev_page_url as string;
    }

    return (
        <div className="tw-flex tw-gap-2 tw-items-center tw-my-8 tw-justify-center">
            <PaginationButton
                url={first_page_url}
                disabled={current_page === 1}
                icon={faAngleDoubleLeft}
            />
            <PaginationButton
                url={prev() as string}
                disabled={!prev_page_url}
                icon={faAngleLeft}
            />
            <section className="tw-flex tw-gap-2 tw-items-center tw-mx-4">
                <span className="tw-text-xl tw-bg-slate-400/30 tw-py-1 tw-px-4 tw-rounded-lg">
                    {current_page}
                </span>
                of
                <span>{last_page}</span>
            </section>
            <PaginationButton
                url={next() as string}
                disabled={!next_page_url}
                icon={faAngleRight}
            />
            <PaginationButton
                url={last_page_url}
                disabled={current_page === last_page}
                icon={faAngleDoubleRight}
            />
        </div>
    );
}
