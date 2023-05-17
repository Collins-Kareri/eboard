import { useDepartmentInvites } from "@/Context/PendingDepartmentInvites";
import SettingSectionLayout from "@/Layouts/SettingSection.Layout";

function PendingInvites() {
    const { pendingInvites } = useDepartmentInvites();

    return (
        <div>
            <SettingSectionLayout
                title={"Pending invites"}
                description={"Look at the invites already sent"}
            >
                <span>
                    You have{" "}
                    <b className="tw-uppercase">{pendingInvites} invites</b>{" "}
                    still not accepted.
                </span>
            </SettingSectionLayout>
        </div>
    );
}

export default PendingInvites;
