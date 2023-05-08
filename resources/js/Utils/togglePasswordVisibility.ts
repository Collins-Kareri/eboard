export default function togglePasswordVisibility(
    passwordVisibility: "show" | "hide",
    setPasswordVisibility: React.Dispatch<React.SetStateAction<"show" | "hide">>
) {
    if (passwordVisibility === "show") {
        setPasswordVisibility("hide");
    } else {
        setPasswordVisibility("show");
    }
}
