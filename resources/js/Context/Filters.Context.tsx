import React, { createContext, useContext, useState } from "react";
import { FilterProps } from "@/types";

type ParsedFiltersProps = {
    [K in keyof FilterProps]?: string;
};

interface FilterContextProps {
    filters: FilterProps;
    setFilters: (filters: FilterProps) => void;
    parsedFilters: ParsedFiltersProps;
}

interface FilterContextComponentProps {
    children: React.ReactNode;
}

const FiltersContext = createContext<FilterContextProps>({
    filters: {
        department: [],
        role: [],
    },
    setFilters: () => {
        return;
    },
    parsedFilters: {},
});

function parseFilters(filters: FilterProps) {
    let results: ParsedFiltersProps = {};

    for (let key in filters) {
        if (filters[key as keyof FilterProps].length > 0) {
            results[key as keyof ParsedFiltersProps] =
                filters[key as keyof FilterProps].join(",");
        }
    }

    return results;
}

export const FilterContextProvider = ({
    children,
}: FilterContextComponentProps) => {
    const [currentFilters, setCurrentFilters] = useState<FilterProps>({
        department: [],
        role: [],
    });

    const setFilters = (filters: FilterProps) => {
        setCurrentFilters(filters);
    };

    return (
        <FiltersContext.Provider
            value={{
                filters: currentFilters,
                parsedFilters: parseFilters(currentFilters),
                setFilters,
            }}
        >
            {children}
        </FiltersContext.Provider>
    );
};

export const useFilters = () => {
    return useContext(FiltersContext);
};
