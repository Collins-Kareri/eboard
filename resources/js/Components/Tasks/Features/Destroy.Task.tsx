import Icon from "@/Components/Icon";
import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import { Dialog } from "@headlessui/react";
import { Link } from "@inertiajs/react";
import { useState } from "react";
import DialogBox from "@/Components/Tasks/Partials/DialogBox";

function DestroyTask({ id }: { id: string }) {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <span>
            <Icon icon={faTrashAlt} onClick={() => setIsOpen(true)} />

            <DialogBox
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                title={"delete task"}
            >
                <Dialog.Description>
                    This will permanently delete this task. Are you sure you
                    want to delete this task?
                </Dialog.Description>

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
                        method="delete"
                        type="button"
                        className="primaryBtn tw-border-red-400 tw-bg-red-400"
                    >
                        delete
                    </Link>
                </section>
            </DialogBox>
        </span>
    );
}

export default DestroyTask;
