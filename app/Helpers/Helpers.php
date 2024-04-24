<?php

namespace App\Helpers;

class Helpers
{
    
    /**
     * Function to compare the similarity of two strings using the leveshtein algorithm
     * 
     * @param String the first string
     * @param String the second string
     * 
     * @return Integer with the percetage of similarity of the two strings
     */
    public static function calculate_string_similarity($string_one, $string_two) 
    {
        // calculate levenshtein distance between the two strings
        $distance = levenshtein($string_one, $string_two);
    
        // calculate maximum lenght of the two strings s
        $max_lenght = max(strlen($string_one), strlen($string_two));
    
        // calculate the level of similarity as a percentage
        $similarity = (1 - $distance / $max_lenght) * 100;
    
        return $similarity;
    }


    /**
     * Function to make an flat an array
     * 
     * @param Array with the data array
     * 
     * @return Array with the flat array
     */
    public static function flatten_array($array_data) {
        $new_array = array();
        array_walk_recursive($array_data, function ($value, $key) use (&$new_array) {
            if ( !is_array($value) ) {
                $new_array[] = $value;
            }
        });
        return $new_array;
    }


}