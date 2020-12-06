=== Drive Folder Embeder ===
Contributors: azumbro
Tags: google drive, folder embed
Requires at least: 4.6
Tested up to: 5.5
Stable tag: 1.1.0
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
A Wordpress plugin that dynamically creates a table with file names and links for a shared Google Drive folder.

== Installation ==
- Option 1: Download the plugin zip directly from the Wordpress plugin repository here (https://wordpress.org/plugins/drive-folder-embeder/). You can then upload the zip file to the "plugins" directory of your Wordpress installation and activate it from the plugin menu.
- Option 2: Select "Add New" from under "Plugins" on the left sidebar of the Wordpress admin dashboard and then search for "Drive Folder Embeder" in the search field.
- Following installation, the plugin must be activated from the "Plugins" page on the Wordpress admin dashboard.

== Usage ==
- All plugin functionality is accessed through shortcodes in the format "[DriveFolderEmbeder]". Shortcode options are outlined below.
    - FolderID (required): The ID of the shared Google Drive folder from which to pull files.
        - To get your folder ID:
            - Share the folder in Google Drive with a public shared link (see the "Anyone with a link to the folder" section of https://support.google.com/drive/answer/7166529).
            - Your folder ID is part of the shared link created above above (link is in the format https://drive.google.com/drive/folders/[ID HERE]?usp=sharing).
    - Sort: How to sort the file table. All sorting is done based on file names. 
        - Options: "ASC", "ASC_Natural", "DESC", "DESC_Natural"
        - If "Sort" is not specified, the "DESC" option is used (default in Google Drive).
    - ShowHeader: Whether or not to show a table header specifying column names.
        - Options: "True" or "False".
        - If "ShowHeaders" is not specified, defaults to "True".
    - TableCSSClass: Allows for a CSS class name to be entered to define table style.
        - Can contain one or more class names separated by a space.
        - No class is set for the table if this value is not provided.
- Shortcode examples:
    - Basic table generation: ```[DriveFolderEmbeder FolderID="123456789"]```
    - Table generation with "Sort", "ShowHeader", and "TableCSSClass" specified: ```[DriveFolderEmbeder FolderID="123456789" Sort="DESC_Natural" ShowHeader="False" TableCSSClass="some-class-name"]```
