import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import handleTyping, { DataType, ErrorType } from "@/Handlers/handleTyping";
import { useEffect, useRef, useState } from "react";
import { Listbox } from "@headlessui/react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faAngleDown } from "@fortawesome/free-solid-svg-icons";
import toPlural from "@/Utils/toPlural";

export default function ContractDetails<clearErrorsType>({
    data,
    errors,
    clearErrors,
    setData,
}: {
    data: DataType;
    errors: ErrorType;
    clearErrors: (...fields: clearErrorsType[]) => void;
    setData: (id: keyof DataType, value: string) => void;
}) {
    const timeMeasures: string[] = ["day", "week", "month", "year"],
        [timeMeasure, setTimeMeasure] = useState(timeMeasures[0]),
        contractPeriodInputRef = useRef(null);

    function changeTimeMeasure(e: React.ChangeEvent<HTMLInputElement>) {
        const value = e.target.value;
        setData("contract_period", `${value} ${timeMeasure}`);
    }

    function convertDate(strUtc: string) {
        if (strUtc) {
            const date = new Date(strUtc);
            const userTimeZone =
                Intl.DateTimeFormat().resolvedOptions().timeZone;
            return date
                .toLocaleString(undefined, {
                    year: "numeric",
                    month: "numeric",
                    day: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    second: "numeric",
                    timeZone: userTimeZone,
                })
                .split(",")[0]
                .split("/")
                .reverse()
                .join("-");
        }

        return "";
    }

    useEffect(() => {
        const timeMeasureFormatRegex = /^\d+ \bday|week|month|year\b$/;

        if (
            timeMeasureFormatRegex.test(
                data.contract_period as unknown as string
            )
        ) {
            const [count] = (data.contract_period as unknown as string).split(
                " "
            );
            setData("contract_period", `${count} ${timeMeasure}`);
        }

        return;
    }, [timeMeasure]);

    return (
        <div className="tw-flex tw-flex-col tw-gap-6">
            <FormInputsLayout
                labelText={"start time"}
                htmlFor="start_time"
                errors={errors.start_time}
            >
                <input
                    type="date"
                    id="start_time"
                    value={convertDate(data.start_time as string)}
                    onChange={(e) =>
                        handleTyping(e, data, errors, clearErrors, setData)
                    }
                />
            </FormInputsLayout>

            <FormInputsLayout
                labelText={"contract period"}
                htmlFor="contract_period"
                errors={errors.contract_period}
            >
                <section className="tw-flex tw-bg-slate-950 tw-border tw-border-slate-900 tw-rounded-md">
                    <input
                        type="number"
                        id="contract_period"
                        onChange={changeTimeMeasure}
                        ref={contractPeriodInputRef}
                        className="tw-flex-1 !tw-bg-transparent tw-border-none focus:tw-ring-0"
                    />
                    <Listbox value={timeMeasure} onChange={setTimeMeasure}>
                        <Listbox.Button
                            className={
                                "tw-border-none tw-flex tw-items-center tw-gap-2 hover:tw-bg-slate-700"
                            }
                        >
                            <span>
                                {contractPeriodInputRef &&
                                contractPeriodInputRef.current
                                    ? toPlural(
                                          timeMeasure,
                                          (
                                              contractPeriodInputRef.current as unknown as HTMLInputElement
                                          ).value as unknown as number
                                      )
                                    : timeMeasure}
                            </span>
                            <FontAwesomeIcon icon={faAngleDown} />
                        </Listbox.Button>
                        <Listbox.Options
                            className={
                                "tw-absolute tw-bg-slate-900 tw-top-[70px] tw-right-0 tw-w-full tw-rounded tw-flex tw-flex-col tw-gap-2 tw-z-10 tw-p-3 tw-px-4 tw-capitalize"
                            }
                        >
                            {timeMeasures.map((measure, index) => {
                                return (
                                    <Listbox.Option
                                        key={index}
                                        value={measure}
                                        className={
                                            "hover:tw-bg-slate-400 tw-py-2 tw-px-2 tw-cursor-pointer tw-rounded-md"
                                        }
                                    >
                                        {measure}
                                    </Listbox.Option>
                                );
                            })}
                        </Listbox.Options>
                    </Listbox>
                </section>
            </FormInputsLayout>
        </div>
    );
}
