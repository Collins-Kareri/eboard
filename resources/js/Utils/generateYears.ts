function generateYears(start: number) {
    let results = [],
        maxLength = 10;

    while (results.length <= maxLength) {
        results.push(start + results.length);
    }

    return results;
}

export default generateYears;
