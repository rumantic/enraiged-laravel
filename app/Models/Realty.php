<?php

namespace App\Models;

use Enraiged\Support\Database\Traits\UserTracking;
use Enraiged\Users\Models\Attributes\AllowImpersonation;
use Enraiged\Users\Models\Attributes\AllowNameChange;
use Enraiged\Users\Models\Attributes\HasContext;
use Enraiged\Users\Models\Attributes\MustAgreeToTerms;
use Enraiged\Users\Models\Scopes\Deleted;
use Enraiged\Users\Models\Scopes\NotDeleted;
use Enraiged\Users\Models\Scopes\Reportable;
use Enraiged\Users\Models\Traits\IsProtected;
use Enraiged\Users\Models\Traits\ManagesPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Realty extends Model
{
    use Reportable;

    protected $table = 'realty';


}
