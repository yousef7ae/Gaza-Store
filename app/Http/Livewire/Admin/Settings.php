<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $logo, $logoTemp, $qr, $qrTemp, $site_name, $description, $address, $email, $mobile, $phone, $url_twitter, $url_facebook, $url_instagram, $url_whatsapp, $url_map, $active;

    public function mount()
    {

        $this->logo = ($setting = Setting::where('name', "logo")->first()) ? $setting->value : '';
        $this->logo = ($setting = Setting::where('name', "qr")->first()) ? $setting->value : '';
        $this->site_name = ($setting = Setting::where('name', "site_name")->first()) ? $setting->value : '';
        $this->description = ($setting = Setting::where('name', "description")->first()) ? $setting->value : '';
        $this->address = ($setting = Setting::where('name', "address")->first()) ? $setting->value : '';
        $this->email = ($setting = Setting::where('name', "email")->first()) ? $setting->value : '';
        $this->mobile = ($setting = Setting::where('name', "mobile")->first()) ? $setting->value : '';
        $this->phone = ($setting = Setting::where('name', "phone")->first()) ? $setting->value : '';
        $this->url_twitter = ($setting = Setting::where('name', "url_twitter")->first()) ? $setting->value : '';
        $this->url_facebook = ($setting = Setting::where('name', "url_facebook")->first()) ? $setting->value : '';
        $this->url_instagram = ($setting = Setting::where('name', "url_instagram")->first()) ? $setting->value : '';
        $this->url_whatsapp = ($setting = Setting::where('name', "url_whatsapp")->first()) ? $setting->value : '';
        $this->url_map = ($setting = Setting::where('name', "url_map")->first()) ? $setting->value : '';
        $this->active = ($setting = Setting::where('name', "active")->first()) ? $setting->value : '';
        $this->points_customer = ($setting = Setting::where('name', "points_customer")->first()) ? $setting->value : '';
        $this->points_delivery = ($setting = Setting::where('name', "points_delivery")->first()) ? $setting->value : '';
        $this->points_merchant = ($setting = Setting::where('name', "points_merchant")->first()) ? $setting->value : '';

    }


    public function update()
    {
        $array = $this->validate([
            'site_name' => 'required',
            'description' => '',
            'address' => '',
            'email' => '',
            'mobile' => '',
            'phone' => '',
            'url_twitter' => '',
            'url_facebook' => '',
            'url_instagram' => '',
            'url_whatsapp' => '',
            'url_map' => '',
            'qr' => '',
            'active' => '',
            'points_customer'=>'',
            'points_delivery'=>'',
            'points_merchant'=>'',
        ]);

        foreach ($array as $key => $value) {
            if ($key != "logo") {
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $value]
                );
            }
        }

        foreach ($array as $key => $value) {
            if ($key != "qr") {
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $value]
                );
            }
        }

        if ($this->logoTemp) {
            $array = $this->validate([
                'logoTemp' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);
            Setting::updateOrCreate(
                ['name' => 'logo'],
                ['value' => $this->logoTemp ? $this->logoTemp->store('logos') : ""]
            );
        }

        if ($this->qrTemp) {
            $array = $this->validate([
                'qrTemp' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);
            Setting::updateOrCreate(
                ['name' => 'qr'],
                ['value' => $this->qrTemp ? $this->qrTemp->store('qr') : ""]
            );
        }

        $this->emit('success', __('Settings successfully Added.'));

    }


    public function render()
    {
        return view('livewire.admin.settings')->layout('livewire.admin.app');
    }
}
