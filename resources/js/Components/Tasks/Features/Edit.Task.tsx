import { useState } from "react";
import Icon from "@/Components/Icon";
import { faPencilAlt } from "@fortawesome/free-solid-svg-icons";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import { Link } from "@inertiajs/react";
import DialogBox from "@/Components/Tasks/Partials/DialogBox";

function EditTask({ id }: { id: string }) {
    const [isOpen, setIsOpen] = useState(false);

    const [data, setData] = useState();

    return (
        <span>
            <Icon icon={faPencilAlt} onClick={() => setIsOpen(true)} />
            <DialogBox
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                title={"edit task"}
            >
                <form className="tw-flex tw-flex-col tw-gap-4 tw-w-full">
                    <FormInputsLayout labelText={"title"} htmlFor="task_title">
                        <input
                            type="text"
                            placeholder="Task title"
                            autoFocus
                            id="task_title"
                        />
                    </FormInputsLayout>

                    <FormInputsLayout
                        labelText={"description"}
                        htmlFor="task_description"
                    >
                        <textarea
                            placeholder="Task description"
                            id="task_description"
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
                                className="tw-w-fit"
                            />
                        </FormInputsLayout>
                        <FormInputsLayout
                            labelText={"end time:"}
                            htmlFor="end_time"
                        >
                            <input
                                type="time"
                                id="end_time"
                                className="tw-w-fit"
                            />
                        </FormInputsLayout>
                        <FormInputsLayout
                            labelText={"deadline:"}
                            htmlFor="deadline"
                        >
                            <input
                                type="date"
                                id="deadline"
                                className="tw-w-fit"
                            />
                        </FormInputsLayout>
                    </section>

                    <section className="tw-flex tw-items-center tw-gap-4 tw-mt-6">
                        <button
                            type="button"
                            className="secondaryBtn"
                            onClick={() => setIsOpen(false)}
                        >
                            cancel
                        </button>
                        <Link
                            href={`/task/${id}`}
                            as="button"
                            method="patch"
                            type="button"
                            data={{ data: data }}
                            className="primaryBtn"
                        >
                            edit
                        </Link>
                    </section>
                </form>
            </DialogBox>
        </span>
    );
}

export default EditTask;
