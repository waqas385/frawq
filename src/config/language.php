<?php

class Language{
    // Note key should be unique in all language arrays;
    public static $lang = array(
        'en' => array(
            'name' => 'Name',
            'father_name' => 'Father Name',
            'cnic' => 'CNIC',
            'ward_number' => 'Ward Number',
            'vote_number' => 'Vote Number',
            'house_number' => 'House Number',
            'block_number' => 'Block Number',
            'pooling_station' => 'Pooling Station',
            'address' => 'Address',
            'add_voter' => 'Add Voter',
            'list_all_voters' => 'List All Voters',
            'print' => 'Print',
            'login' => 'Login',
            'logout' => 'Logout',
            'sign_in' => 'Sign in',
            'action' => 'Action'
        ),
        'ur' => array(
            'name' => 'نام',
            'father_name' => 'والد کا نام',
            'cnic' => 'شناختی کارڈ نمبر',
            'ward_number' => 'وارڈ نمبر',
            'vote_number' => 'ووٹ نمبر ',
            'house_number' => 'گھر کا نمبر',
            'block_number' => 'بلاک نمبر',
            'pooling_station' => 'گرہ بندی اسٹیشن',
            'address' => 'پته',
            'add_voter' => 'ووٹر اضافہ',
            'list_all_voters' => 'تمام ووٹروں کی فہرست',
            'print' => 'پرنٹ',
            'login' => 'لاگ ان',
            'logout' => 'لاگ آوٹ',
            'sign_in' => 'سائن ان کریں',
            'action' => 'Action'
        )
    );
    
    public static function get($arrName){
        return isset(self::$lang[$arrName]) ? self::$lang[$arrName] : "";
    }
    
}