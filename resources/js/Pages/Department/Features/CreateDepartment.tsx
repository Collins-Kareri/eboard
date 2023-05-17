import handleTyping from "@/Handlers/handleTyping";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import SettingSectionLayout from "@/Layouts/SettingSection.Layout";
import { useForm } from "@inertiajs/react";

function CreateDepartment() {
    const { data, setData, errors, clearErrors, processing, post, reset } =
        useForm({
            department_name: "",
            manager_email: "",
        });

    function createDepartment() {
        post(route("department.store"), {
            onSuccess: () => reset(),
        });
    }

    return (
        <SettingSectionLayout
            title={"Create department"}
            description={
                "Make a new department then assign a manager to it. The email provided will receive an invite to join the platform as a manager to specified department"
            }
        >
            <FormInputsLayout
                labelText={"department name"}
                htmlFor="department_name"
                errors={errors.department_name}
            >
                <input
                    type="text"
                    id="department_name"
                    value={data.department_name}
                    onChange={(e) =>
                        handleTyping(e, data, errors, clearErrors, setData)
                    }
                />
            </FormInputsLayout>
            <FormInputsLayout
                labelText={"manager email"}
                htmlFor="manager_email"
                errors={errors.manager_email}
            >
                <input
                    type="email"
                    id="manager_email"
                    value={data.manager_email}
                    onChange={(e) =>
                        handleTyping(e, data, errors, clearErrors, setData)
                    }
                />
            </FormInputsLayout>
            <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-start tw-py-4">
                <button
                    className="primaryBtn"
                    disabled={processing}
                    type="button"
                    onClick={createDepartment}
                >
                    create
                </button>
            </div>
        </SettingSectionLayout>
    );
}

export default CreateDepartment;
