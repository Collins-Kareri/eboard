import Icon from "@/Components/Icon";
import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import { Dialog } from "@headlessui/react";
import { Link } from "@inertiajs/react";
import { useState } from "react";
import DialogBox from "@/Components/Tasks/Partials/DialogBox";

function DestroyEmployee({ id }: { id: number }) {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <span>
            <Icon
                icon={faTrashAlt}
                onClick={() => setIsOpen(true)}
                className="tw-p-4"
            />

            <DialogBox
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                title={"delete employee"}
            >
                <Dialog.Description>
                    This will permanently delete this employee. Are you sure you
                    want to delete this employee?
                </Dialog.Description>

                <section className="tw-flex tw-items-center tw-gap-4 tw-mt-6">
                    <button
                        type="button"
                        className="tw-px-6 tw-py-2 tw-rounded-md tw-border-slate-900 tw-border hover:tw-bg-slate-300 tw-capitalize"
                        onClick={() => setIsOpen(false)}
                    >
                        cancel
                    </button>
                    <Link
                        href={`/task/${id}`}
                        as="button"
                        method="delete"
                        type="button"
                        className="tw-px-6 tw-py-2 tw-bg-red-400  tw-rounded-md tw-border tw-border-red-400 tw-capitalize"
                    >
                        delete
                    </Link>
                </section>
            </DialogBox>
        </span>
    );
}

export default DestroyEmployee;
