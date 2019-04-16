#!/bin/bash

#   MVC Plugin Boilerplate Generator - Generates the base plugin out of `MVC Plugin Boilerplate for WordPress`
#    Copyright (C) <2019>  <Sumit P>

#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    any later version.

#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.

#    You should have received a copy of the GNU General Public License
#    along with this program.  If not, see <https://www.gnu.org/licenses/gpl-3.0.html>.

take_consent_to_execute_script(){
    echo '           MVC Plugin Boilerplate Generator -  Copyright (C) <2019>  <Sumit P>   ';
    echo '           This program is licensed under GPLv3 & comes with ABSOLUTELY NO WARRANTY;'
    echo '           Detalied copy of GNU General Public License can be found here: https://www.gnu.org/licenses/gpl-3.0.html'
    echo ''
    read -p 'Do you accept the license terms? [y/n]:' AGREE_TO_PROCEED
    if [ -z "$AGREE_TO_PROCEED" ] || [ "$AGREE_TO_PROCEED" != "y" ] ; then
        echo 'Execution Aborted!'
        exit 1
    fi
    echo ''
}

set_defaults_for_script(){
    GIT_REPO_DIR='mvc-plugin-boilerplate-for-wordpress'
    GENERATED_PLUGIN_DIR='generated-plugin'
    BOILERPLATE_PLUGIN_NAME='MVC WordPress Plugin Boilerplate'
    PLUGIN_NAME="Plugin Name"
}

create_dir(){

    # Generate Final Plugin Directory
    if [ -d "$1" ]; then
        echo -e "\033[0;31m Directory $1 exists already in the current folder. Script can not continue if this directory is present! \033[39m"
        exit 1
    fi

    mkdir -p $1

    if [ $? -ne 0 ]; then
        echo -e "\033[0;31m Could not create directory $1! \033[39m"
        exit 1
    fi

}

download_original_plugin(){
    echo 'Downloading vanilla boilerplate from Git'
    git clone --single-branch --branch dev https://github.com/sumitpore/mvc-plugin-boilerplate-for-wordpress.git $GIT_REPO_DIR > /dev/null 2>&1
    echo 'Boilerplate Download Complete'
}

bring_plugin_outside(){
    mv $GIT_REPO_DIR/plugin-name $GENERATED_PLUGIN_DIR/
}

delete_git_repo_dir(){
    rm -rf $GIT_REPO_DIR
}

switch_to_generated_plugin_dir(){
    cd $GENERATED_PLUGIN_DIR
}

set_plugin_slug(){
    echo -n -e "What is your plugin slug? [Plugin slug will be used to replace occurrances of \033[0;33m 'plugin-name' \033[39m in file names & text in files ]: "
    read PLUGIN_SLUG
    if [ -z "$PLUGIN_SLUG" ]; then
        set_plugin_slug
    fi
}

replace_text_in_files(){

    if [ "$1" == "plugin-name" ]; then
        REPLACEMENT_TEXT=$PLUGIN_SLUG
    else
        echo -n -e "Replacement Text for \033[0;33m $1 \033[39m : "
        read REPLACEMENT_TEXT
    fi

    if [[ ! -z "$REPLACEMENT_TEXT" ]]; then
        find . -type f -exec sed -i -e 's/'"$1"'/'"$REPLACEMENT_TEXT"'/g' {} +

        # If we are replacing `Plugin Name`, then we have to revert the replacement 
        # done in Plugin File header. Otherwise, WP won't be able to recognize the
        # plugin
        if [ "$1" == "Plugin Name" ]; then
            sed -i -e 's/'"$REPLACEMENT_TEXT:"'/'"$1:"'/g' plugin-name/plugin-name.php

            # Set Plugin Name
            sed -i -e 's/'"$BOILERPLATE_PLUGIN_NAME"'/'"$REPLACEMENT_TEXT"'/g' plugin-name/plugin-name.php

            # Set Plugin Name variable
            PLUGIN_NAME=$REPLACEMENT_TEXT
        fi

        # Save replacement being done for Plugin_Name class in a variable, it will be used while renaming files too
        if [ "$1" == "Plugin_Name" ]; then
            REPLACEMENT_FOR_PLUGIN_NAME_CLASS=$REPLACEMENT_TEXT
        fi
    fi
}

rename_plugin_folder(){
    mv 'plugin-name' $PLUGIN_SLUG
}

rename_files(){
    if [ ! -z "$2" ]; then
        # Rename Files inside a folder
        find . -type f -name "*$1*" | while read FILE ; do
            newfile="$(echo ${FILE} |sed -e 's/'"$1"'/'"$2"'/')" ;
            mv "${FILE}" "${newfile}" ;
        done 
    fi
}

take_consent_to_execute_script
set_defaults_for_script
create_dir $GENERATED_PLUGIN_DIR
create_dir $GIT_REPO_DIR
download_original_plugin
bring_plugin_outside
delete_git_repo_dir
switch_to_generated_plugin_dir

echo ''

set_plugin_slug
replace_text_in_files 'plugin-name'
replace_text_in_files 'Plugin Name'
replace_text_in_files 'plugin_name'
replace_text_in_files 'Plugin_Name'
replace_text_in_files 'PLUGIN_NAME_'
rename_plugin_folder
rename_files 'plugin-name' $PLUGIN_SLUG
rename_files 'Plugin_Name' $REPLACEMENT_FOR_PLUGIN_NAME_CLASS

echo ''
echo -e "\033[0;32mPlugin $PLUGIN_NAME is generated successfully inside $GENERATED_PLUGIN_DIR! \033[39m"
echo '';
echo -e "\033[0;32mHappy Coding! \033[39m"