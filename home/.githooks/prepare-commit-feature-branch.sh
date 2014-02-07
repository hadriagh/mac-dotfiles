#!/bin/sh
 
BRANCH_NAME=$(git branch 2>/dev/null | grep -e ^* | tr -d ' *')
if [ -n "$BRANCH_NAME" ] && [ "$BRANCH_NAME" != "master" ]; then
echo "$BRANCH_NAME  $(cat $1)" > $1
fi