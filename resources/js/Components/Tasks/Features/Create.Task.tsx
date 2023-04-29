import DialogBox from "@/Components/Tasks/Partials/DialogBox";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Link } from "@inertiajs/react";
import { useState } from "react";

function CreateTask() {
    const [isOpen, setIsOpen] = useState(true),
        [data, setData] = useState([]);
    return (
        <div>
            <button
                className="tw-bg-slate-400 tw-py-2 tw-px-6 tw-rounded-md"
                onClick={() => setIsOpen(true)}
            >
                Create task
            </button>

            <DialogBox
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                title={"create task"}
            >
                <form className="tw-flex tw-flex-col tw-gap-4 tw-w-full">
                    <FormInputsLayout labelText={"title"} htmlFor="task_title">
                        <input
                            type="text"
                            placeholder="Task title"
                            autoFocus
                            id="task_title"
                            className="tw-rounded-md tw-bg-slate-950"
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"description"}
                        htmlFor="task_description"
                    >
                        <textarea
                            placeholder="Task description"
                            id="task_description"
                            className="tw-rounded-md tw-bg-slate-950"
                        ></textarea>
                    </FormInputsLayout>

                    <section className="tw-flex tw-justify-between tw-items-center tw-gap-6">
                        <FormInputsLayout
                            labelText={"start time:"}
                            htmlFor="start_time"
                        >
                            <input
                                type="time"
                                id="start_time"
                                className="tw-rounded-md tw-bg-slate-950 tw-w-fit"
                            />
                        </FormInputsLayout>
                        <FormInputsLayout
                            labelText={"end time:"}
                            htmlFor="end_time"
                        >
                            <input
                                type="time"
                                id="end_time"
                                className="tw-rounded-md tw-bg-slate-950 tw-w-fit"
                            />
                        </FormInputsLayout>
                        <FormInputsLayout
                            labelText={"deadline:"}
                            htmlFor="deadline"
                        >
                            <input
                                type="date"
                                id="deadline"
                                className="tw-rounded-md tw-bg-slate-950 tw-w-fit"
                            />
                        </FormInputsLayout>
                    </section>

                    <section className="tw-flex tw-items-center tw-gap-4 tw-mt-6">
                        <button
                            type="button"
                            className="tw-px-6 tw-py-2 tw-rounded-md tw-border-slate-900 tw-border hover:tw-bg-slate-300"
                            onClick={() => setIsOpen(false)}
                        >
                            cancel
                        </button>
                        <Link
                            href={`/task`}
                            as="button"
                            method="post"
                            type="button"
                            data={{ data: data }}
                            className="tw-px-6 tw-py-2 tw-bg-slate-400  tw-rounded-md tw-border tw-border-slate-400"
                        >
                            edit
                        </Link>
                    </section>
                </form>
            </DialogBox>
        </div>
    );
}

export default CreateTask;
