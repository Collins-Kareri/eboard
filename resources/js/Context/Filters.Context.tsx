import React, { createContext, useContext, useState } from "react";

interface FilterContextProps {
    filters: string[];
    setFilters: (filters: string[]) => void;
    parsedFilters: string;
}

interface FilterContextComponentProps {
    children: React.ReactNode;
}

const FiltersContext = createContext<FilterContextProps>({
    filters: [],
    setFilters: () => {
        return;
    },
    parsedFilters: "",
});

export const FilterContextProvider = ({
    children,
}: FilterContextComponentProps) => {
    const [currentFilters, setCurrentFilters] = useState<string[]>([]);

    const setFilters = (filters: string[]) => {
        setCurrentFilters(filters);
    };

    return (
        <FiltersContext.Provider
            value={{
                filters: currentFilters,
                parsedFilters: currentFilters.join(","),
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
