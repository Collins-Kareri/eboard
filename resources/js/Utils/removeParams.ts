/**
 * Removes params from url.
 * @param params params to remove just provide the key
 * @param url url to remove the param key
 * @returns url pathname with removed query params
 */
export default function removeParams(params: string[], url: string) {
    const [pathname, searchParams] = url.split("?");
    const urlParams = new URLSearchParams(searchParams);
    for (let param of params) {
        urlParams.delete(param);
    }
    return `${pathname}?${urlParams.toString()}`;
}
