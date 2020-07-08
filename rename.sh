#!/bin/bash

find . -type f -name 'click2buy_csv*' | while read FILE ; do
    newfile="$(echo ${FILE} |sed -e 's/\click2buy_csv/click2buy_csv/')" ;
    mv "${FILE}" "${newfile}" ;
done
