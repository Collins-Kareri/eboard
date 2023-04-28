import {
    FontAwesomeIconProps,
    FontAwesomeIcon,
} from "@fortawesome/react-fontawesome";

function Icon({ className, ...rest }: FontAwesomeIconProps) {
    return (
        <FontAwesomeIcon
            className={`tw-p-2 hover:tw-bg-slate-400 tw-rounded-md tw-cursor-pointer ${className}`}
            {...rest}
        />
    );
}

export default Icon;
