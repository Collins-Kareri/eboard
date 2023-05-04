import DialogBox from "@/Components/Tasks/Partials/DialogBox";
import { useState } from "react";

function AddEmployee() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <span>
            <button className="primaryBtn" onClick={() => setIsOpen(true)}>
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
