<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeederCustom extends Seeder

{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('site.title');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'ATLANTIS',
            ])->update();
        }

        $setting = $this->findSetting('site.description');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'Cabinet Avocat | Bienvenue.',
            ])->update();
        }

        $setting = $this->findSetting('site.logo');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'settings\August2020\QvvuRcQFlisx2mms250j.png',
            ])->update();
        }

        $setting = $this->findSetting('admin.bg_image');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'settings\September2020\Z5Upg8aSnK7yi63P4UYW.png',
            ])->update();
        }

        $setting = $this->findSetting('admin.title');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'ATLANTIS',
            ])->update();
        }

        $setting = $this->findSetting('admin.description');
        if ($setting->exists) {
            $setting->fill([
                'value'        => 'Cabinet Avocat | Bienvenue.',
            ])->update();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrCreate(['key' => $key]);
    }
}

