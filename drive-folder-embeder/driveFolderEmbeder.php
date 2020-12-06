<?php
    /*
        Plugin Name: Drive Folder Embeder
        Plugin URI: https://github.com/azumbro/DriveFolderEmbeder
        Version: 1.0.0
        Description: A Wordpress plugin that dynamically creates a table with file names and links for a shared Google Drive folder.
        Author: azumbro
    */
    
    defined('ABSPATH') or die('No script kiddies please!');

    function driveFolderEmbeder($atts) {
        extract(shortcode_atts(array(
            "folderid" => "",
            "sort" => "DESC",
            "showheader" => "True",
            "tablecssclass" => ""
        ), $atts));
        $baseURL = "https://drive.google.com/embeddedfolderview?id=";
        $htmlStr = str_replace("script", "", (addslashes (file_get_contents($baseURL . $folderid))));
        $tableID = rand();
        return "
            <table id='driveFolderEmbeder-" . $tableID .  "' class='". $tablecssclass ."'>"
                . ($showheader == "True" ? "<thead><td>File Name</td><td></td></thead>" : "") .
                "<tbody></tbody>
            </table>
            <script>
                var sortMethod = '" . $sort . "';
                var sortFunctions = {
                    ASC: function(a, b) {
                        return b.name != a.name ? b.name < a.name ? -1 : 1 : 0
                    },
                    ASC_Natural: function(a, b) {
                        return a.name.localeCompare(b.name, undefined, {
                            numeric: true,
                            sensitivity: 'base'
                        });
                    },
                    DESC: function(a, b) {
                        console.log(a.name, b.name, a.name != b.name ? a.name < b.name ? -1 : 1 : 0)
                        return a.name != b.name ? a.name < b.name ? -1 : 1 : 0
                    },
                    DESC_Natural: function(a, b) {
                        return b.name.localeCompare(a.name, undefined, {
                            numeric: true,
                            sensitivity: 'base'
                        });
                    }
                };
                var sortFunction = sortFunctions[sortMethod];
                var parsedEntries = [];
                var html = jQuery.parseHTML( '". $htmlStr ."');
                var entries = jQuery(html).find('.flip-entry-info'); 
                jQuery.each(entries, function(index, value) { 
                    parsedEntries.push({ 
                        name: jQuery(value)[0].innerText,
                        url: jQuery(value).find('a').slice(0, 1).attr('href')
                    }); 
                }); 
                parsedEntries.sort(sortFunction);
                jQuery.each(parsedEntries, function(index, value) {
                    jQuery('#driveFolderEmbeder-" . $tableID .  " tbody').append('<tr><td>' + value.name + '</td><td><a href=\"' + value.url + '\" target=\"_blank\">View</a></td></tr>');
                });
            </script>
        ";
    }
    add_shortcode('DriveFolderEmbeder', 'driveFolderEmbeder');
?>