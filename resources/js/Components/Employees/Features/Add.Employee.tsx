import DialogBox from "@/Components/Tasks/Partials/DialogBox";
import { useState } from "react";

function AddEmployee() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <span>
            <button
                className="tw-bg-slate-400 tw-px-4 tw-py-2 tw-border tw-border-slate-400 tw-rounded-md tw-capitalize hover:tw-shadow-md hover:tw-shadow-slate-100"
                onClick={() => setIsOpen(true)}
            >
                add employee
            </button>
            <DialogBox
                isOpen={isOpen}
                setIsOpen={setIsOpen}
                title={"add employee"}
            >
                <section>to be implemented</section>
            </DialogBox>
        </span>
    );
}

export default AddEmployee;
