export default function convertToUTC(date: Date) {
    const userDate = new Date(date);
    return userDate.toUTCString();
}
