<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Tejuino\Adminbase\Files;

class Location extends Model
{

    use SoftDeletes;

    protected $table = 'location';

    /************************ ATTRIBUTES ************************/

    public function getImageAttribute($value)
    {
        return Files::getUrl($value, 'locations/');
    }

    /************************* Methods  ************************/

    public static function getAll()
    {
        $locations = static::where('publish_status', 'Publicado')->where('status', 'active')->
            orderBy('publish_date', 'desc')->paginate(4);

        return $locations;

    }

    public static function getById($id)
    {
        return static::where('id', $id)->where('publish_status', 'Publicado')->where('status', 'active')->first();
    }


    /************************* Triggers  ************************/

    public function updatePublishStatus()
    {
        $publishStatus = 'Programado';

        if ($this->status != 'Activo')
        {
            $publishStatus = 'Inactivo';
        }
        else
        {
            if (!$this->article || !$this->overview)
            {
                $publishStatus = 'Pendiente';
            }
            else
            {
                if ($this->programmed)
                {
                    // Validate dates
                    /*if (Datetime::isPublishDatetime($this->publish_date))
                    {
                        $publishStatus = 'Publicado';
                    }*/
                }
                else
                {
                    $publishStatus = 'Publicado';
                }
            }
        }

        $this->publish_status = $publishStatus;

        return $this->publish_status;
    }

}