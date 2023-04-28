export interface AvatarComponentProps {
    avatarUrl: string;
    size: "sm" | "md" | "lg";
}

function Avatar({
    avatarUrl,
    size,
}: {
    avatarUrl: string;
    size: "sm" | "md" | "lg";
}) {
    const containerSize: { sm: string; md: string; lg: string } = {
        sm: "tw-w-10 tw-h-10",
        md: "tw-w-12 tw-h-12",
        lg: "tw-w-14 tw-h-14",
    };

    return (
        <span className={`tw-block ${containerSize[size]} tw-cursor-pointer`}>
            <img
                className="tw-relative tw-w-full tw-h-full tw-rounded-full"
                src={`${avatarUrl}`}
                alt="user avatar"
            />
        </span>
    );
}

export default Avatar;
