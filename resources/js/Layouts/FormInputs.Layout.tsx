import React, { LabelHTMLAttributes } from "react";

interface FormInputsLayoutProps
    extends React.PropsWithChildren<LabelHTMLAttributes<HTMLLabelElement>> {
    labelText: string;
}

function FormInputsLayout({
    labelText,
    children,
    className,
    ...rest
}: FormInputsLayoutProps) {
    return (
        <div className="tw-flex tw-flex-col tw-relative tw-w-full">
            <label className={`tw-capitalize`} {...rest}>
                {labelText}
            </label>
            {children}
        </div>
    );
}

export default FormInputsLayout;
