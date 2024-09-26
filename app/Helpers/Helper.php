<?php
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Auth;

    /* flash message */
    if (!function_exists('flash')) {
        function flash()
        {
            $toastr = app('App\Helpers\Toastr');
            return new $toastr;
        }
    }

    /* get site info */
    // if (!function_exists('getSiteInfo')) {
        // function getSiteInfo()
        // {
        //     $data = [
        //         'site_name'       => '',
        //         'logo'            => '',
        //         'favicon'         => '',
        //         'copyright'       => '',
        //         'mobile'          => '',
        //         'email'           => '',
        //         'whatsapp'        => '',
        //         'skype'           => '',
        //         'location'        => '',
        //         'facebook'        => '',
        //         'twitter'         => '',
        //         'instagram'       => '',
        //         'linkedin'        => '',
        //         'youtube'         => '',
        //         'placeholder'     => '',
        //     ];

        //     $siteInfo = DB::table('settings')->whereNotIn('meta_key')->get();
        //     if (!empty($siteInfo)) {
        //         foreach ($siteInfo as $row) {
        //             $data[$row->meta_key] = $row->meta_value;
        //         }
        //     }
        //     return (object)$data;
        // }
    // }

    if (!function_exists('getAdminInfo')) {
        function getAdminInfo()
        {
            return Auth::guard('admin')->user();
        }
    }

    if (!function_exists('getClientInfo')) {
        function getClientInfo()
        {
            return Auth::guard('client')->user();
        }
    }

    // Function to generate unique Code
    if (!function_exists('generateUniqueCode')) {
        function generateUniqueCode() {
            do {
                // Generate a random alphanumeric string of length 8
                $code = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);

                // Check if the code already exists in the database
                $urlCodeExists = DB::table('url_shorters')->where('short_url', $code)->exists();
            } while ($urlCodeExists);

            return $code;
        }
    }

    if (!function_exists('strFilter')) {
        function strFilter($text = '')
        {
            if (!empty($text)) {
                $text = trim($text);
                if (mb_detect_encoding($text) == 'UTF-8') {
                    $text = str_replace('_', ' ', $text);
                } else {
                    $text = ucwords(str_replace('_', ' ', $text));
                }
                return $text;
            }
            return 'N/A';
        }
    }

    if (!function_exists('strClean')) {
        function strClean($text = '')
        {
            if (!empty($text)) {
                $text = trim($text);
                if (mb_detect_encoding($text) == 'UTF-8') {
                    $text = str_replace(' ', '', $text);
                } else {
                    $text = ucwords(str_replace(' ', '', $text));
                }
                return preg_replace('/[^A-Za-z0-9\-]/', '', $text);
            }
        }
    }

    if (!function_exists('strSlug')) {
        function strSlug($text = '')
        {
            if (!empty($text)) {
                $text = trim($text);
                if (mb_detect_encoding($text) == 'UTF-8') {
                    $text = str_replace(' ', '-', $text);
                } else {
                    $text = str_replace(' ', '-', strtolower($text));
                }
                return str_replace('&', 'and', $text);
            }
        }
    }

    if (!function_exists('strLimit')) {
        function strLimit($text, $count, $prefix = "")
        {
            $text        = str_replace("  ", " ", strip_tags($text));
            $string      = explode(" ", $text);
            $stringCount = count($string) - 1;
            $wordCount   = $count - 1;
            $trimed      = "";
            $count       = ($stringCount > $wordCount) ? $wordCount : $stringCount;
            for ($i = 0; $i <= $count; $i++) {
                $trimed .= $string[$i];
                if ($i < $count) {
                    $trimed .= " ";
                }
            }
            if ($stringCount > $wordCount) {
                $trimed .= $prefix;
            }
            $trimed = trim($trimed);
            return $trimed;
        }
    }

    if (!function_exists('uploadFile')) {
        function uploadFile($sourcePath = null, $uploadPath = '', $prefix = null)
        {
            if (!empty($sourcePath) && !empty($uploadPath)) {
                if (!is_dir(public_path($uploadPath))) mkdir(public_path($uploadPath), 0755, true);
                $fileInfo = $sourcePath->getClientOriginalName();
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $filename = (!empty($prefix) ? $prefix . '-' : '') . date('ymd') . rand(100000, 999999) . '.' . $extension;
                $sourcePath->move(public_path($uploadPath), $filename);
                return $uploadPath . '/' . $filename;
            }
            return false;
        }
    }

    if (!function_exists('uploadImage')) {
        function uploadImage($sourcePath = null, $uploadPath = '', $maxWidth = 0, $maxHeight = 0, $quality = 100, $prefix = null)
        {
            if (!empty($sourcePath) && !empty($uploadPath)) {
                if (!is_dir(public_path($uploadPath))) mkdir(public_path($uploadPath), 0755, true);
                $mimeType = $sourcePath->getMimeType();
                list($imgWidth, $imgHeight) = getimagesize($sourcePath);
                $fileName = (!empty($prefix) ? $prefix . '-' : '') . date('ymd') . rand(100000, 999999) . '.webp';
                if ($mimeType == 'image/jpeg') {
                    $sourceImage = imagecreatefromjpeg($sourcePath);
                } elseif ($mimeType == 'image/png') {
                    $sourceImage = imagecreatefrompng($sourcePath);
                } elseif ($mimeType == 'image/webp') {
                    $sourceImage = imagecreatefromwebp($sourcePath);
                } elseif ($mimeType == 'image/gif') {
                    $sourceImage = imagecreatefromgif($sourcePath);
                } else {
                    return false;
                }
                imagepalettetotruecolor($sourceImage);
                if (!empty($maxWidth) && !empty($maxHeight)) {
                    if ($imgWidth > $imgHeight) {
                        if ($imgWidth > $maxWidth) {
                            $newWidth  = $maxWidth;
                            $newHeight = ($imgHeight / $imgWidth) * $maxWidth;
                        } else {
                            $newWidth  = $imgWidth;
                            $newHeight = $imgHeight;
                        }
                    } else {
                        if ($imgHeight > $maxHeight) {
                            $newHeight = $maxHeight;
                            $newWidth  = ($imgWidth / $imgHeight) * $maxHeight;
                        } else {
                            $newWidth  = $imgWidth;
                            $newHeight = $imgHeight;
                        }
                    }
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $imgWidth, $imgHeight);
                    $sourceImage = $newImage;
                    $newImage = imagecreatetruecolor($maxWidth, $maxHeight);
                    $x = ($newWidth - $maxWidth) / 2;
                    $y = ($newHeight - $maxHeight) / 2;
                    imagecopyresampled($newImage, $sourceImage, 0, 0, $x, $y, $maxWidth, $maxHeight, $maxWidth, $maxHeight);
                    $sourceImage = $newImage;
                }
                $imageTo = public_path($uploadPath) . '/' . $fileName;
                $quality = (!empty($quality) ? $quality : 100);
                // Convert the image to WebP format
                if ($sourceImage !== false && imagewebp($sourceImage, $imageTo, $quality)) {
                    imagedestroy($sourceImage);
                    return $uploadPath . '/' . $fileName;
                }
            }
            return false;
        }
    }

    if (!function_exists('inWordEn')) {
        function inWordEn($num = false) {
            $num    = str_replace(array(',', ' '), '' , trim($num));
            if(! $num) { return false; }
            $num    = (int) $num;
            $words  = [];
            $list1  = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen' ];
            $list2  = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred'];
            $list3  = ['', 'thousand', 'million', 'billion', 'trillion' ];
            $num_length = strlen($num);
            $levels     = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num        = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            for ($i = 0; $i < count($num_levels); $i++) {
                $levels--;
                $hundreds   = (int) ($num_levels[$i] / 100);
                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
                $tens       = (int) ($num_levels[$i] % 100);
                $singles    = '';

                if ( $tens < 20 ) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
                } else {
                    $tens    = (int)($tens / 10);
                    $tens    = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_levels[$i] % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
            }
            //end for loop
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }
            return implode(' ', $words);
        }
    }
