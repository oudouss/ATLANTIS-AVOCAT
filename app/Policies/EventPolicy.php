<?php

namespace App\Policies;

use App\User;
use App\Event;
use TCG\Voyager\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {

        $roleSup = Role::where('name', 'Admin')->firstorfail();

        if ($user->role_id === $roleSup->id && ($ability === 'delete'  || $ability === 'read' || $ability === 'edit' )) {
            return true;
        }


    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function browse(User $user)
    {
        return true;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function read(User $user, Event $event)
    {

        if ($user->id === $event->user_id || in_array($event->id, $user->sharedevents->pluck('id')->toArray())) {
            return true;
        }

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function add(User $user)
    {
        return true;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function edit(User $user, Event $event)
    {

        $roleSup = Role::where('name', 'Avocat')->firstorfail();

        if ($user->id == $event->user_id || ($user->role_id == $roleSup->id && in_array($event->id, $user->sharedevents->pluck('id')->toArray()))) {
            return true;
        }

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {

        $roleSup = Role::where('name', 'Avocat')->firstorfail();

        if ( $user->id === $event->user_id || ( $user->role_id === $roleSup->id && in_array( $event->id, $user->sharedevents->pluck('id')->toArray() ) ) ) {
            return true;
        }

    }

}
