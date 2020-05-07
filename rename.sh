#!/bin/bash

find . -type f -name 'idealo_csv*' | while read FILE ; do
    newfile="$(echo ${FILE} |sed -e 's/\idealo_csv/click2buy/')" ;
    mv "${FILE}" "${newfile}" ;
done
