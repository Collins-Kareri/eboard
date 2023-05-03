import { PropsWithChildren } from "react";

interface SectionLayoutProps extends PropsWithChildren {
    title: string;
    description: string;
}

function SectionLayout({ title, description, children }: SectionLayoutProps) {
    return (
        <section className="tw-flex tw-gap-8 tw-items-start tw-justify-center tw-flex-col md:tw-flex-row">
            <span className="tw-inline-block tw-w-full md:tw-w-1/5">
                <h1 className="tw-text-lg tw-font-bold">{title}.</h1>
                <p>{description}.</p>
            </span>

            <div className="tw-bg-slate-100 tw-shadow-md tw-shadow-slate-900  tw-rounded-md tw-px-4 tw-py-4 tw-flex tw-gap-8 tw-items-start tw-justify-center tw-flex-col tw-relative tw-w-full md:tw-w-4/5">
                {children}
            </div>
        </section>
    );
}

export default SectionLayout;
