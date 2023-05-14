interface DataType {
    [key: string]: string | null | File | number | boolean;
}

interface ErrorType {
    [key: string]: string | undefined;
}

export default function handleTyping<clearErrorsType>(
    e: React.ChangeEvent<HTMLInputElement>,
    data: DataType,
    errors: ErrorType,
    clearErrors: (...fields: clearErrorsType[]) => void,
    setData: (id: keyof typeof data, value: string) => void
) {
    const id = e.target.id as keyof typeof data;

    if (errors[id]) {
        clearErrors(id as clearErrorsType);
    }

    setData(id, e.target.value);
}
