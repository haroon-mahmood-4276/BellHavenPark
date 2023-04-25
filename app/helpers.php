<?php

use App\Models\{Permission, RolesPermission, Setting};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

if (!function_exists('permission_check')) {
    function permission_check($permission_slug)
    {
        return (new RolesPermission())->where('haven_role_id', auth()->user()->haven_role_id)->where('haven_permission_id', (new Permission())->where('slug', $permission_slug)->first()->id)->first();
        return cache()->remember('permissions.' . $permission_slug, 600, function () use ($permission_slug) {
            return (new RolesPermission())->where('haven_role_id', auth()->user()->haven_role_id)->where('haven_permission_id', (new Permission())->where('slug', $permission_slug)->first()->id)->first();
        });
    }
}

if (!function_exists('filter_strip_tags')) {

    function filter_strip_tags($field): string
    {
        return trim(strip_tags($field));
    }
}

if (!function_exists('encode_html_entities')) {

    function encode_html_entities($field): string
    {
        return trim(htmlentities($field));
    }
}

if (!function_exists('decode_html_entities')) {

    function decode_html_entities($field): string
    {
        return trim(html_entity_decode($field));
    }
}

if (!function_exists('encryptParams')) {
    function encryptParams($params): array|string
    {
        if (is_array($params)) {
            $data = [];
            foreach ($params as $item) {
                $data[] = Crypt::encryptString($item);
            }
            return $data;
        }
        return Crypt::encryptString($params);
    }
}

if (!function_exists('decryptParams')) {
    function decryptParams($params): array|string
    {
        if (is_array($params)) {
            $data = [];
            foreach ($params as $item) {
                $data[] = Crypt::decryptString($item);
            }
            return $data;
        }
        return Crypt::decryptString($params);
    }
}

if (!function_exists('getSettings')) {
    function getSettings($key)
    {
        //		return cache()->remember( 'settings.' . $key, 600, function () use ( $key ) {
        //			return ( new Setting() )->getByKey( $key )->value ?? 'Not Found';
        //		} );
        $setting = (new Setting())->getByKey($key);
        return $setting->value ?? 'Not Found';
    }
}

if (!function_exists('base64ToImage')) {
    function base64ToImage($image): string
    {
        ini_set('memory_limit', '256M');
        $filename = 'TelK7BnW63IAN6zuTTwJkqZeuM0YI5aNc7aFqOyz.jpg';
        if (!empty($image)) {
            $dir = $_SERVER['DOCUMENT_ROOT'] . config('app.asset_url') . DIRECTORY_SEPARATOR . 'public_assets/admin/sites_images';
            $image_parts = explode(";base64,", $image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = uniqid() . '.' . $image_type;
            $file = $dir . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($file, $image_base64);
        }
        return $filename;
    }
}

if (!function_exists('makeImageThumbs')) {
    function makeImageThumbs($request, $key = ""): string
    {
        $publicPath = public_path('public_assets/admin/sites_images') . DIRECTORY_SEPARATOR;
        if (!is_string($request)) {
            if (is_array($request)) {
                $image = $request[$key];
            } else {
                $image = $request->file($key);
            }
            $imageHashedName = $image->hashName();
        } else {
            $image = $publicPath . $request;
        }

        $imgExplodedName = explode(".", $imageHashedName);

        $img = Image::make($image)->backup();

        $img->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio()->upsize();
        })->save($publicPath . $imgExplodedName[0] . '-thumbs1000.' . $imgExplodedName[1])->reset();

        $img->resize(600, null, function ($constraint) {
            $constraint->aspectRatio()->upsize();
        })->save($publicPath . $imgExplodedName[0] . '.' . $imgExplodedName[1])->reset();

        $img->resize(350, null, function ($constraint) {
            $constraint->aspectRatio()->upsize();
        })->save($publicPath . $imgExplodedName[0] . '-thumbs350.' . $imgExplodedName[1])->reset();

        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio()->upsize();
        })->save($publicPath . $imgExplodedName[0] . '-thumbs200.' . $imgExplodedName[1])->reset();

        $img->destroy();

        return $imgExplodedName[0] . '.' . $imgExplodedName[1];
    }
}

if (!function_exists('deleteImageThumbs')) {
    function deleteImageThumbs($imgName): string
    {
        if (File::exists(public_path('files/images') . "/" . $imgName)) {
            $imageExplodedName = explode(".", $imgName);
            File::delete([
                public_path('files/images') . "/" . $imageExplodedName[0] . "." . $imageExplodedName[1],
                public_path('files/images') . "/" . $imageExplodedName[0] . "-thumbs1000." . $imageExplodedName[1],
                public_path('files/images') . "/" . $imageExplodedName[0] . "-thumbs350." . $imageExplodedName[1],
                public_path('files/images') . "/" . $imageExplodedName[0] . "-thumbs200." . $imageExplodedName[1],
            ]);

            return true;
        }
        return false;
    }
}

if (!function_exists('getImageByName')) {
    function getImageByName($imgName): array
    {
        $img = "";
        $imgThumb = "";
        $publicServerPath = public_path('public_assets/admin/sites_images') . DIRECTORY_SEPARATOR;
        $publicLinkPath = asset('public_assets/admin/sites_images') . DIRECTORY_SEPARATOR;

        $imageExplodedName = explode('.', (!is_null($imgName) && !empty($imgName) ? $imgName : 'TelK7BnW63IAN6zuTTwJkqZeuM0YI5aNc7aFqOyz.jpg'));

        if (File::exists($publicServerPath . ($imageExplodedName[0] . "-thumbs200." . $imageExplodedName[1]))) {
            $img = $publicLinkPath . $imageExplodedName[0] . "-thumbs1000." . $imageExplodedName[1];
            $imgThumb = $publicLinkPath . $imageExplodedName[0] . "-thumbs200." . $imageExplodedName[1];
        } else if (File::exists($publicServerPath . ($imageExplodedName[0] . "." . $imageExplodedName[1]))) {
            $img = $publicLinkPath . $imageExplodedName[0] . "." . $imageExplodedName[1];
            $imgThumb = $publicLinkPath . $imageExplodedName[0] . "." . $imageExplodedName[1];
        } else {
            $img = $publicLinkPath . "do_not_delete/do_not_delete.png";
            $imgThumb = $publicLinkPath . "do_not_delete/do_not_delete.png";
        }

        return [$img, $imgThumb];
    }
}


if (!function_exists('editDateColumn')) {
    function editDateColumn($date)
    {
        $date = new Carbon($date);

        return "<span>" . $date->format('H:i:s') . "</span> <br> <span class='text-primary fw-bold'>" . $date->format('Y-m-d') . "</span>";
    }
}

if (!function_exists('editBooleanColumn')) {
    function editBooleanColumn($boolean)
    {
        if ($boolean) {
            return "<span class='badge rounded-pill badge-light-success me-1'>" . __('lang.commons.yes') . "</span>";
        } else {
            return "<span class='badge rounded-pill badge-light-danger me-1'>" . __('lang.commons.no') . "</span>";
        }
    }
}

if (!function_exists('editBadgeColumn')) {
    function editBadgeColumn($value)
    {
        return "<span class='badge rounded-pill badge-light-primary me-1'>" . $value . "</span>";
    }
}
