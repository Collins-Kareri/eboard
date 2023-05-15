export default function convertToUTC(date: Date) {
    const userDate = new Date(date);
    return Date.UTC(
        userDate.getFullYear(),
        userDate.getMonth(),
        userDate.getDay(),
        userDate.getHours(),
        userDate.getSeconds(),
        userDate.getMilliseconds()
    );
}
