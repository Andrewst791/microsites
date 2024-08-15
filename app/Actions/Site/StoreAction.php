<?php
namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreAction
{
    public function execute(array $data) : Site
    {
        $site                       = new Site();
        $site->slug                 = Str::slug($data['name'], '-');
        $site->name                 = $data['name'];
        $site->logo                 = $data['logo'];
        $site->document_type        = $data['document_type'];
        $site->site_type            = $data['site_type'];
        $site->document             = $data['document'];
        $site->category_id          = $data['category_id'];
        $site->currency_id          = $data['currency_id'];
        $site->fields               = $data['fields'];
        $site->user_id              = Auth::user()->id;
        $site->payment_expiration   = $data['payment_expiration'];
        $site->save();
        return $site;
    }
}
