<?php

namespace App\Services;


use App\Models\Setting;

class SettingService
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }


    public function getOne()
    {
        return $this->setting->first() ?? new $this->setting;
    }

    public function update($id, $data)
    {
        $setting = $this->setting->findOrFail($id);

        return $setting->fill($data)->save();
    }
}
