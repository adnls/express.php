#!/bin/bash
MY_MESSAGE=$1
git add . && git commit -m $MY_MESSAGE && git push origin master