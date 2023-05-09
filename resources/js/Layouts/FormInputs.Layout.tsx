import React, { LabelHTMLAttributes } from "react";

interface FormInputsLayoutProps
    extends React.PropsWithChildren<LabelHTMLAttributes<HTMLLabelElement>> {
    labelText: string;
    errors?: string;
}

function FormInputsLayout({
    labelText,
    children,
    className,
    errors,
    ...rest
}: FormInputsLayoutProps) {
    return (
        <div className="tw-flex tw-flex-col tw-relative tw-w-full">
            <label className={`tw-capitalize tw-mb-1 tw-font-bold`} {...rest}>
                {labelText}
            </label>
            {children}
            <span className="tw-text-red-400 tw-font-light">{errors}</span>
        </div>
    );
}

export default FormInputsLayout;
