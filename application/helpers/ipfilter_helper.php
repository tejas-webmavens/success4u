<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('ipfilter'))
{
    /**
     * Filter IP addresses by given blacklist
     * 
     * @author  Barna Szalai <b.sz@devartpro.com>
     * @license http://opensource.org/licenses/MIT MIT Licence
     * @param   string  $ip  ip address
     * @return  boolean     
     */
    function ipfilter($ip)
    {
        $CI =& get_instance();
        // load config file
        $CI->load->config('ipfilter');
        // get the filtered IP addresses
        $ips = $CI->config->item('filtered_ips');
        // check if passed IP is in the filter list
        for($i = 0, $count = count($ips); $i < $count; $i++) 
        {
            $result = preg_replace("/\\./", "\\\\.", $ips[$i]);

            $result = preg_replace("/\\*/", "[.\\\\d]+", $result);

            if(preg_match("/^".$result."$/", $ip))  
            {	 
                // return TRUE if blocked    	
               	return TRUE;
            }
        }   
        // retrun FALSE if allow 
        return FALSE;
    }
}