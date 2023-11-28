<?php

if (!function_exists('getDatePrefix')) {
    /**
     * @return string
     */
    function getDatePrefix(): string
    {
        $int = 0;
        $files = glob(database_path('migrations/*'));
        $today = date('Y_m_d_');
        foreach ($files as $file) {
            $file = basename($file);
            if (str_starts_with($file, $today)) {
                $int = (int) substr($file, 11, 6);
            }
        }

        $int = ceil($int / 10) * 10;

        return $today . str_pad($int + 10, 6, 0, STR_PAD_LEFT);
    }
}
