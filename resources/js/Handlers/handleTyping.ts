import convertToUTC from "@/Utils/convertToUTC";

export interface DataType {
    [key: string]: string | null | File | number | boolean | Date | unknown;
}

export interface ErrorType {
    [key: string]: string | undefined;
}

export default function handleTyping<clearErrorsType>(
    e: React.ChangeEvent<HTMLInputElement>,
    data: DataType,
    errors: ErrorType,
    clearErrors: (...fields: clearErrorsType[]) => void,
    setData: (id: keyof DataType, value: string) => void
) {
    const id = e.target.id as keyof typeof data;
    let value = e.target.value;

    if (errors[id]) {
        clearErrors(id as clearErrorsType);
    }

    if (e.target.type === "date") {
        value = `${convertToUTC(value as unknown as Date)}`;
    }

    setData(id, value);
}
