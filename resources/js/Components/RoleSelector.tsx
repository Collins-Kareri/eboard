import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCheckCircle } from "@fortawesome/free-solid-svg-icons";
import { ComponentPropsWithoutRef } from "react";

interface RoleSelectorProps extends ComponentPropsWithoutRef<"div"> {
    active: boolean;
    value: string;
    description: string;
}

export default function RoleSelector({
    active,
    value,
    className,
    description,
    ...rest
}: RoleSelectorProps) {
    return (
        <div
            className={`tw-flex tw-w-full tw-gap-2 tw-items-start tw-justify-start tw-opacity-50 ${
                active ? "tw-bg-slate-300 !tw-opacity-100" : ""
            } tw-py-4 tw-px-6 tw-h-fit tw-cursor-pointer hover:tw-bg-slate-200 ${className} tw-capitalize tw-flex-col`}
            {...rest}
        >
            <section className="tw-flex tw-items-center tw-gap-2">
                {active ? (
                    <FontAwesomeIcon
                        icon={faCheckCircle}
                        className="tw-text-green-400"
                    />
                ) : (
                    <></>
                )}
                <h1>{value}</h1>
            </section>

            <p className="!tw-opacity-50 tw-text-sm tw-normal-case">
                {description}.
            </p>
        </div>
    );
}
