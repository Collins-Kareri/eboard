<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class DepartmentInviteSent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    // contract_start_date')->nullable();
    //         $table->timestamp('contract_end_date')->nullable();
    //         $table->enum('role', array_column(UserRole::cases(), 'value'));
    //         $table->string('department_name'

    /**
    *@param User $user
    *@param string $email
    *@param string $department_name
    *@param string $role
    *@param string $contract_start_date
    *@param string $contract_end_date
 */

    /**
    *   Create a new event instance.
    *   @param User $user
    *   @param string $email
    *   @param string $department_name
    *   @param string $role
    *   @param string $startDate
    *   @param string $contractPeriod
     */
    public function __construct(
        public User $user,
        public string $email,
        public string $department_name,
        public string $role,
        public $startDate=null,
        public $contractPeriod=null
    ) {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
