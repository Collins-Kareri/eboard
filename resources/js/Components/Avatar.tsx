import { PageProps } from "@/types";
import { usePage } from "@inertiajs/react";

export interface AvatarComponentProps {
    avatar_url?: string;
    size: "sm" | "md" | "lg" | "xl";
}

function Avatar({ avatar_url, size }: AvatarComponentProps) {
    const containerSize: { sm: string; md: string; lg: string; xl: string } = {
            sm: "tw-w-10 tw-h-10",
            md: "tw-w-12 tw-h-12",
            lg: "tw-w-14 tw-h-14",
            xl: "tw-w-20 tw-h-20",
        },
        avatarUrl =
            avatar_url ?? usePage<PageProps>().props.auth.user.avatar_url;

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
