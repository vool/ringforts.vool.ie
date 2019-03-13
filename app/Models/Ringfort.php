<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ringfort extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id',
        'classcode',
        'classdesc',
        'smrs',
        'tland_names',
        'org_lat',
        'org_long',
        'new_lat',
        'new_long',
        'link'
    ];

    protected $appends = [
        'lat',
        'long',
        'amended',
        'latlng'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
                <div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
                  '.$this->restore_button.'
                  '.$this->delete_permanently_button.'
                </div>';
        }

        return '
        <div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
          '.$this->show_button.'
          '.$this->edit_button.'

          <div class="btn-group btn-group-sm" role="group">
            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              '.__('labels.general.more').'
            </button>
            <div class="dropdown-menu" aria-labelledby="userActions">
              '.$this->clear_session_button.'
              '.$this->login_as_button.'
              '.$this->change_password_button.'
              '.$this->status_button.'
              '.$this->confirmed_button.'
              '.$this->delete_button.'
            </div>
          </div>
        </div>';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.ringfort.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.ringfort.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return decimal
     */
    public function getLatAttribute()
    {
        return $this->new_lat ?: $this->org_lat;
    }

    /**
     * @return decimal
     */
    public function getLongAttribute()
    {
        return $this->new_long ?: $this->org_long;
    }

    /**
     * @return bool
     */
    public function getAmendedAttribute()
    {
        return $this->new_long && $this->new_lat ? true: false;
    }

    /**
     * @return array
     */
    public function getLatlngAttribute()
    {
        return [$this->lat, $this->long];
    }


    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return $this->regected;
    }

    //Scopes


    /**
     * @return bool
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', '=', 1);
    }

    /**
     * @return bool
     */
    public function scopePending($query)
    {
        return $query->where('status', '=', 0);
    }

    /**
     * @return bool
     */
    public function scopeRejected($query)
    {
        return $query->where('status', '=', -1);
    }


    /**
    * @return string
    */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case -1:
            return  '<span class="badge badge-danger">rejected</span>';
            break;

            case 0:
            return  '<span class="badge badge-info">Pending</span>';
            break;

            case 1:
            return '<span class="badge badge-success">confirmed</span>';
            break;

        }
    }
}
