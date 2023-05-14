import Avatar from "@/Components/Avatar";
import Icon from "@/Components/Icon";
import FormInputsLayout from "@/Layouts/FormInputs.Layout";
import SettingSectionLayout from "@/Layouts/SettingSection.Layout";
import avatarIsPlaceholder from "@/Utils/avatarIsPlaceholder";
import { PageProps } from "@/types";
import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import { router, useForm, usePage } from "@inertiajs/react";
import { useRef, useState } from "react";
import handleTyping from "@/Handlers/handleTyping";

export default function EditProfileInformation({}) {
    const { full_name, email, avatar_url, avatar, phone_number } =
            usePage<PageProps>().props.auth.user,
        { data, setData, processing, post, errors, clearErrors } = useForm({
            _method: "patch",
            full_name: full_name,
            email: email,
            avatar: avatar,
            phone_number: phone_number,
        }),
        photoInputRef = useRef<null | HTMLInputElement>(null),
        [newAvatarPreview, setNewAvatarPreview] = useState<string | undefined>(
            undefined
        );

    function updateInformation() {
        post(route("profile.update"), {
            preserveScroll: true,
            errorBag: "updateProfileInformation",
        });
    }

    function selectNewPhoto() {
        if (photoInputRef.current) {
            photoInputRef.current.click();
        }
    }

    function updateAvatar(evt: React.ChangeEvent<HTMLInputElement>) {
        const selectedAvatar = evt.target.files![0];

        setNewAvatarPreview(URL.createObjectURL(selectedAvatar));

        setData("avatar", selectedAvatar);
    }

    function destroyAvatar() {
        if (newAvatarPreview) {
            setNewAvatarPreview(undefined);
            if (photoInputRef.current) {
                photoInputRef.current.value = "";
            }
            clearErrors("avatar");
            return;
        }

        //send a delete request to backend.
        router.delete(route("avatar.destroy"), {
            preserveScroll: true,
        });
    }

    return (
        <SettingSectionLayout
            title={"Profile information"}
            description={"Edit your profile information and avatar"}
        >
            <form className="tw-w-full tw-h-fit tw-flex tw-flex-col tw-gap-8">
                <input
                    type="file"
                    accept="image/*"
                    className="tw-hidden"
                    ref={photoInputRef}
                    onChange={updateAvatar}
                    id="avatar"
                />
                <div className="tw-flex tw-gap-2 tw-items-start tw-justify-center tw-flex-col">
                    <Avatar avatar_url={newAvatarPreview} size="xl" />
                    <section className="tw-flex tw-h-fit tw-justify-center tw-items-center tw-gap-2">
                        <button
                            className="secondaryBtn"
                            type="button"
                            onClick={selectNewPhoto}
                        >
                            select new photo
                        </button>
                        {!avatarIsPlaceholder(avatar_url) ||
                        newAvatarPreview ? (
                            <Icon
                                icon={faTrashAlt}
                                size="lg"
                                className="tertiaryBtn tw-px-4 tw-py-2"
                                title="delete avatar"
                                onClick={destroyAvatar}
                            />
                        ) : (
                            <></>
                        )}
                    </section>
                    {errors.avatar ? (
                        <span className="tw-text-red-400 tw-font-light tw-w-full tw-inline-block tw-flex-1">
                            {errors.avatar}
                        </span>
                    ) : (
                        <></>
                    )}
                </div>

                <FormInputsLayout
                    labelText={"full name"}
                    htmlFor="full_name"
                    errors={errors.full_name}
                >
                    <input
                        type="text"
                        id="full_name"
                        value={data.full_name}
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
                        }
                        required
                    />
                </FormInputsLayout>

                <FormInputsLayout
                    labelText={"email"}
                    htmlFor="email"
                    errors={errors.email}
                >
                    <input
                        type="email"
                        id="email"
                        value={data.email}
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
                        }
                        required
                    />
                </FormInputsLayout>

                <FormInputsLayout
                    labelText={"phone number"}
                    htmlFor="phone_number"
                    errors={errors.phone_number}
                >
                    <input
                        type="tel"
                        id="phone_number"
                        value={data.phone_number}
                        onChange={(e) =>
                            handleTyping(e, data, errors, clearErrors, setData)
                        }
                        required
                    />
                </FormInputsLayout>

                <div className="tw-w-full tw-border-t tw-border-slate-50 tw-flex tw-justify-end tw-py-4">
                    <button
                        className="primaryBtn"
                        type="button"
                        disabled={processing}
                        onClick={updateInformation}
                    >
                        save changes
                    </button>
                </div>
            </form>
        </SettingSectionLayout>
    );
}
