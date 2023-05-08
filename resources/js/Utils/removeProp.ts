export default function removeProp<
    T extends Record<string, unknown>,
    K extends keyof T
>(obj: T, key: K): Omit<T, K> {
    const newObj = { ...obj };
    delete newObj[key];
    return newObj;
}
