<?php

namespace Enraiged\Users\Observers;

use Enraiged\Users\Models\InternetAddress;
use Enraiged\Users\Notifications\InternetAddressLogin;

class IpAddressObserver
{
    /**
     *  Handle the InternetAddress created event.
     *
     *  @param  \App\Auth\Models\InternetAddress  $address
     *  @return void
     */
    public function created(InternetAddress $address)
    {
        if (config('enraiged.notifications.internet_address_login')) {
            $address->user->notify(new InternetAddressLogin($address));
        }
    }
}
