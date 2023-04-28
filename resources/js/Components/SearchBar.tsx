import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";

function SearchBar() {
    return (
        <div className="tw-border tw-border-slate-800 tw-flex tw-items-center tw-rounded-lg tw-border-solid tw-mt-2 tw-bg-slate-50 tw-w-11/12">
            <FontAwesomeIcon
                icon={faMagnifyingGlass}
                className="tw-border-none tw-p-2"
            />
            <input
                type="text"
                placeholder="Search employees"
                className="tw-outline-none tw-border-none tw-pl-0 tw-rounded-r-lg tw-bg-transparent tw-flex-1 tw-py-3"
            />
        </div>
    );
}

export default SearchBar;
