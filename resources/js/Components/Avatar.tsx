export interface AvatarComponentProps {
    avatarUrl?: string;
    size: "sm" | "md" | "lg" | "xl";
}

function Avatar({
    avatarUrl = "https://ui-avatars.com/api/?name=jd&color=#060406&background=#DFF3E4",
    size,
}: AvatarComponentProps) {
    const containerSize: { sm: string; md: string; lg: string; xl: string } = {
        sm: "tw-w-10 tw-h-10",
        md: "tw-w-12 tw-h-12",
        lg: "tw-w-14 tw-h-14",
        xl: "tw-w-20 tw-h-20",
    };

    return (
        <span
            className={`tw-block ${containerSize[size]} tw-cursor-pointer tw-w-`}
        >
            <img
                className="tw-relative tw-w-full tw-h-full tw-rounded-full"
                src={`${avatarUrl}`}
                alt="user avatar"
            />
        </span>
    );
}

export default Avatar;
