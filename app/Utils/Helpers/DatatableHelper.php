<?php

use Carbon\Carbon;
use App\Utils\Enums\CustomerAccounts;

if (!function_exists('editDateTimeColumn')) {
    function editDateTimeColumn($date, $dateFormat = 'Y-m-d', $timeFormat = 'H:i:s', $withBr = true, $order = 'TD')
    {
        if ($date < 1)
            return '-';

        $date = new Carbon($date);
        switch ($order) {
            case 'TD':
                return "<span>" . $date->format($timeFormat) . "</span> " . ($withBr ? '<br>' : "") . " <span class='text-primary fw-bold'>" . $date->format($dateFormat) . "</span>";
                break;

            case 'DT':
                return "<span class='text-primary fw-bold'>" . $date->format($dateFormat) . "</span> " . ($withBr ? '<br>' : "") . " <span>" . $date->format($timeFormat) . "</span>";
                break;
        }
    }
}

if (!function_exists('editPaymentColumn')) {
    function editPaymentColumn($amount, $decimals = 0, $symbol = '$')
    {
        if ($amount < 1)
            return '-';

        return $symbol . ' ' . number_format($amount, $decimals);
    }
}

if (!function_exists('editTitleColumn')) {
    function editTitleColumn($string)
    {
        if (is_null($string)) {
            return '-';
        } else if (is_string($string)) {
            return Str::of($string)->replace('_', ' ')->title();
        } else if ($string instanceof CustomerAccounts) {
            return Str::of($string->value)->replace('_', ' ')->title();
        }
    }
}

if (!function_exists('editTimeColumn')) {
    function editTimeColumn($date)
    {
        $date = new Carbon($date);

        return "<span>" . $date->format('H:i:s') . "</span>";
    }
}

if (!function_exists('editDateColumn')) {
    function editDateColumn($date, $format = 'Y-m-d')
    {
        if ($date < 1)
            return '-';

        $date = new Carbon($date);

        return "<span class='text-primary fw-bold'>" . $date->format($format) . "</span>";
    }
}

if (!function_exists('editImageColumn')) {
    function editImageColumn($image, $name = '', $width = 100)
    {
        return "<img style='border: 1px dashed #eee;border-radius: 10px' src='" . $image . "' alt='" . $name . "' width='" . $width . "'>";
    }
}

if (!function_exists('editStatusColumn')) {
    function editStatusColumn($status)
    {
        $badge = '';
        switch ($status) {
            case 'yes':
            case true:
                $badge = "<span class='badge bg-success bg-glow me-1'>Yes</span>";
                break;

            case 'no':
            case false:
                $badge = "<span class='badge bg-danger bg-glow me-1'>No</span>";
                break;

            case 'active':
                $badge = "<span class='badge bg-success bg-glow me-1'>Active</span>";
                break;

            case 'inactive':
                $badge = "<span class='badge bg-danger bg-glow me-1'>Inactive</span>";
                break;

            case 'objected':
                $badge = "<span class='badge bg-warning bg-glow me-1'>Objected</span>";
                break;

            default:
                $badge = "<span class='badge bg-primary bg-glow me-1'>" . $status . "</span>";
                break;
        }
        return $badge;
    }
}

if (!function_exists('editBadgeColumn')) {
    function editBadgeColumn($value)
    {
        return "<span class='badge rounded-pill bg-label-primary me-1'>" . $value . "</span>";
    }
}
