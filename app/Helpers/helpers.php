<?php

use App\Models\Category;
use App\Models\Entity;
use App\Models\Media;
use App\Models\MediaImage;
use App\Models\Role;
use App\Models\Tag;

if (!function_exists('getCategoryArr')) {
    function getCategoryArr()
    {
        $data = Category::orderBy('id', 'desc')->get();
        // dd($data);
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}

if (!function_exists('getTagArr')) {
    function getTagArr()
    {
        $data = Tag::orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}

function getCountries()
{
    return array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
}
if (!function_exists('getRoleArr')) {
    function getRoleArr()
    {
        $data   = Role::orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title;
        }
        return $result;
    }
}

if (!function_exists('getOtherRoleArr')) {
    function getOtherRoleArr()
    {
        $data   = Role::whereNotIn('id', [1,2,4,5,6,7,8,12])->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->title;
        }
        return $result;
    }
}

if (!function_exists('getPeopleArr')) {
    function getPeopleArr()
    {
        $data   = Entity::orderBy('name', 'desc')->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}
if (!function_exists('getMediaArr')) {
    function getMediaArr()
    {
        $data   = Media::orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}

if (!function_exists('getdistMediaArr')) {

    function getdistMediaArr($media_img_id)
    {
        $ex_mediaId     = [];
        $mediaImages    = MediaImage::select('media_images.media_id')->where('id', '!=', $media_img_id)->get();
        foreach ($mediaImages as $mages) {
            $ex_mediaId[] = $mages->media_id;
        }
        $data = Media::leftjoin('media_images', 'media_images.media_id', 'media.id')
            ->whereNotIn('media.id', $ex_mediaId)
            ->select('media.id', 'media.name')
            ->orderBy('media.id', 'desc')
            ->get();
        $result = [];
        foreach ($data as $list) {
            $result[$list->id] = $list->name;
        }
        return $result;
    }
}
if (!function_exists('getEntities')) {
    function getEntities()
    {
        return Entity::select('id', 'name')->orderBy('id', 'desc')->get();
    }
}
if (!function_exists('getMediaTypes')) {
    function getMediaTypes()
    {
        $result = [
            'movie'     => 'Movie',
            'song'      => 'Song',
            'webfilm'   => 'Web Film',
            'webseries' => 'Web Series',
            'telefilm'  => 'Telefilm',
            'drama'     => 'Drama',
        ];
        return $result;
    }
}
if (!function_exists('getCountryorigin')) {
    function getCountryorigin()
    {
        $result = [
            'bangladesh' => 'Bangladesh',
            'india'      => 'India'
        ];
        return $result;
    }
}
if (!function_exists('getGender')) {
    function getGender()
    {
        $result = [
            'male'   => 'Male',
            'female' => 'Female'
        ];
        return $result;
    }
}
if (!function_exists('getlanguage')) {
    function getlanguage()
    {
        $result = [
            'bangla'    => 'Bangla',
            'english'   => 'English',
            'Hindi'     => 'Hindi',

        ];
        return $result;
    }
}
