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


    /**
     * Function to ignore a duplicate elements of an array
     * 
     * @param Array associative with the elements to compare
     * @param String key to check if it is duplicate element
     * @param Integer with the value to check the similarity using the self::calculate_string_similarity function
     * 
     * @return Array without similar values 
     */
    public static function ignore_array_duplicate_elements($array, $key, $umbral) {
        // array to store the unique elements
        $result = array();
        
        // foreach element of the elements asiciative array
        foreach ($array as $i => $value) {
            $is_similar = false;
            
            // compares the actual value with the result value
            foreach ($result as $j => $res_value) {
                if (self::calculate_string_similarity($array[$i][$key], $result[$j][$key]) == $umbral) {
                    $is_similar = true;
                    break;
                }
            }
            
            // if it is not similar, add to the result array
            if ( !$is_similar ) {
                $result[] = $value;
            }
        }
        
        return $result;
    }

}