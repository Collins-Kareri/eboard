export default function getTotalLengthOfObjectValues<T>(obj: T) {
    let results = 0;

    for (let val in obj) {
        results += (obj[val] as [] | string).length;
    }

    return results;
}
