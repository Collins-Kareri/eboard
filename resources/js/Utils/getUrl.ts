export default function getUrl(url: string) {
    const BASE_URL = window.location.protocol + "//" + window.location.host,
        result = url.replace(BASE_URL, "");
    return result.length > 0 ? result : "/";
}
