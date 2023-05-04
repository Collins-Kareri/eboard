import { useEffect, useRef, useState } from "react";
import EditTask from "@/Components/Tasks/Features/Edit.Task";
import DestroyTask from "@/Components/Tasks/Features/Destroy.Task";

export interface TaskProps {
    title: string;
    description: string;
    start_at: string;
    end_at: string;
    completed: boolean;
    id: string;
}

function Task({
    title,
    description,
    start_at,
    end_at,
    completed,
    id,
}: TaskProps) {
    const completedRef = useRef(null);
    const [status, setStatus] = useState<boolean>(completed);

    function toggleStatus() {
        setStatus(!status);
    }

    useEffect(() => {
        if (completedRef.current) {
            if (status) {
                (completedRef.current as HTMLInputElement).checked = status;
            }
        }
    }, [status]);

    return (
        <div className="tw-p-6 tw-bg-slate-800 tw-rounded-md">
            <section className="tw-flex tw-items-center tw-justify-between tw-h-fit">
                <input
                    type="checkbox"
                    ref={completedRef}
                    className="tw-cursor-pointer"
                    onClick={toggleStatus}
                />
                <span className="tw-flex tw-gap-2">
                    <EditTask id={id} />
                    <DestroyTask id={id} />
                </span>
            </section>
            <section
                className={`tw-flex tw-flex-col tw-gap-4 tw-mt-4 ${
                    status ? "tw-line-through" : ""
                }`}
            >
                <h1 className="tw-capitalize tw-font-bold">{title}</h1>
                <p className="tw-text-sm tw-opacity-75">{description}</p>
                <span className="tw-w-full tw-flex tw-h-fit tw-justify-start tw-gap-2 tw-items-center tw-text-sm tw-opacity-50 tw-capitalize">
                    <p>start: {start_at}</p>
                    <p>-</p>
                    <p>end: {end_at}</p>
                </span>
            </section>
        </div>
    );
}

export default Task;
