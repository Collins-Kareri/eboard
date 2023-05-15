export default function toPlural(str: string, count: number) {
    if (count > 1) {
        return `${str}s`;
    }
    return str;
}
